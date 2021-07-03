<?php

namespace Module\duser\Controller;

class index extends \Controller_backend {

    public $infor;
    public $Breadcrumb;

    function __construct() {
        parent::__construct();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->Breadcrumb = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => "Quản Lý Tài Khoản",
            "link" => "/duser/index/index"
        ];

        $this->infor = new \Module\minfor\Model\infor();
        ob_start();
    }

    function index() {
        $this->Bread[] = [
            "title" => "Danh Sách Tài Khoản",
            "link" => "#"
        ];
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule();
    }

    function create() {
        if (isset($_POST["ThemAdmin"])) {
            try {
                $user = $_POST["user"];
                $Duser = new \Module\duser\Model\Duser();
                $random = md5(time() . rand(1000, 9999) . time());
                $random = substr($random, 0, 29);
                $user["Password"] = $Duser->CreatePassword($user["Password"], $random);
                $user["Random"] = $random;
                $Duser->ThemUser($user);
                new \Model\Error(["type" => "success", "content" => "Đã thêm tài khoản."]);
            } catch (\Exception $exc) {
                new \Model\Error(["type" => "danger", "content" => $exc->getMessage()]);
            }
        }

        $this->Bread[] = [
            "title" => "Thêm Tài Khoản",
            "link" => "#"
        ];

        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule();
    }

    public function delete() {
        $username = $this->getParam()[0];
        $Duser = new \Module\duser\Model\Duser();
        if ($username != 'admin') {
            $Duser->DeleteOnsubmit($username);
        }
        \lib\Common::ToUrl("/duser/index/index/");
    }

    public function detail() {
        $this->Bread[] = [
            "title" => "Thêm Tài Khoản",
            "link" => "#"
        ];
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule();
    }

    public function update() {
        $Duser = new \Module\duser\Model\Duser();
        $this->resetpassword();
        if (isset($_POST["SaveAdmin"])) {
            $userInfor = $_POST["user"];
            $_user = $Duser->GetByUsername($userInfor["Username"]);
            $_user["Name"] = $userInfor["Name"];
            $_user["Phone"] = $userInfor["Phone"];
            $_user["Email"] = $userInfor["Email"];
            $_user["Groups"] = $userInfor["Groups"];
            $_user["Address"] = $userInfor["Address"];
            $_user["Note"] = $userInfor["Note"];
            $Duser->UpdateInfor($_user);
        }

        $this->Bread[] = [
            "title" => "Sửa Tài Khoản",
            "link" => "#"
        ];
        $Username = $this->getParam()[0];
        $_user = $Duser->GetByUsername($Username);
        $data["User"] = $_user;
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule($data);
    }

    public function resetpassword() {

        try {
            if (isset($_POST["ResetPassword"])) {
                if ($_POST["Password"] == "") {
                    throw new \Exception("Không có mật khẩu.");
                }
                $curentUser = new \Module\duser\Model\Duser(\Module\duser\Model\Duser::CurentUsernameAdmin(FALSE));
                if ($curentUser->Groups == 0) {
                    $username = $_POST["Username"];
                    $Duser = new \Module\duser\Model\Duser();
                    $_user = $Duser->GetByUsername($username);
                    if ($_user) {
                        $_user["Password"] = $Duser->CreatePassword($_POST["Password"], $_user["Random"]);
                        $curentUser->UpdatePassword($_user);
                        new \Model\Error(["type" => "success", "content" => "Đã Cập Nhập Mật Khẩu"]);
                    } else {
                        throw new \Exception("Không có tài khoản này.");
                    }
                } else {
                    new \Model\Error(["type" => "danger", "content" => "Bạn Không Có Quyền"]);
                }
            }
        } catch (\Exception $exc) {
            new \Model\Error(["type" => "danger", "content" => $exc->getMessage()]);
        }
    }

    function __destruct() {
        $str = ob_get_clean();
        $filename = __DIR__ . "/../Lang/vi.ini";
        $a = parse_ini_file($filename);
        $a["AddLink"] = "#";
        $a["ViewLink"] = "#";
        foreach ($a as $k => $value) {
            $str = str_replace("__" . $k . "___", $value, $str);
        }
        echo $str;
    }

}

?>