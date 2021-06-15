<?php

namespace Module\duser\Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class aprofile extends \Controller_backend implements \Controller_IBackenController {

    function __construct() {
        parent::__construct();
        ob_start();
        $this->Bread[] = [
            "title" => "Thông tin tài khoản",
            "link" => "/mpage/"
        ];
    }

    function __destruct() {

    }

    function index() {
        $bread = new \Model\Breadcrumb();
        $bread->setBreadcrumb($this->Bread);
        $this->ViewThemeModule();
    }

    public function create() {

    }

    public function updateinfor() {
        try {
            if (isset($_POST["SaveInfor"])) {
                $DUser = new \Module\duser\Model\Duser();
                $CurentUser = \Module\duser\Model\Duser::CurentUsernameAdmin(true);
                $username = $CurentUser->UserInfor($CurentUser->Username, FALSE);
                if (!$username) {
                    throw new \Exception("Không Có username này");
                }
                $username["Name"] = $_POST["Name"];
                $username["Email"] = $_POST["Email"];
                $username["Phone"] = $_POST["Phone"];
                $username["Address"] = isset($_POST["Address"]) ? $_POST["Address"] : "";
                $username["Note"] = isset($_POST["Note"]) ? $_POST["Note"] : "";
                $username["Groups"] = isset($_POST["Groups"]) ? $_POST["Groups"] : 0;
                $username["Urlimages"] = isset($_POST["Urlimages"]) ? $_POST["Urlimages"] : "";
                $DUser->UpdateInfor($username);
                \Module\duser\Model\Duser::SetUsernameAdmin($username);
                new \Model\Error(["type" => "success", "content" => "Cập nhật thành công"]);
            }
        } catch (\Exception $exc) {

            new \Model\Error(["type" => "danger", "content" => $exc]);
        }
        \lib\Common::ToUrl($_SERVER["HTTP_REFERER"]);
    }

    public function updatepassword() {

        try {
            if (isset($_POST["SavePassword"])) {

                $DUser = new \Module\duser\Model\Duser();
                $CurentUser = \Module\duser\Model\Duser::CurentUsernameAdmin(true);
                $Password = $_POST["oldPassword"];
                $newPass = $_POST["newPassword"];
                $rePass = $_POST["rePassword"];

                if ($Password == "") {
                    throw new \Exception("Chưa Nhập Mật Khẩu.");
                }
                $user = $DUser->CheckLogin($CurentUser->Username, $Password, FALSE);
                if (!$user) {
                    throw new \Exception("Mật Khẩu Nhập Không Đúng.");
                }
                if ($newPass == "") {
                    throw new \Exception("Mật Khẩu Mới Chưa Nhập.");
                }
                if ($newPass != $rePass) {
                    throw new \Exception("Mật Khẩu Mới Không Khớp.");
                }
                $random = $CurentUser->Random;
                $user["Password"] = $DUser->CreatePassword($newPass, $random);
                $DUser->UpdatePassword($user);
                new \Model\Error(["type" => "success", "content" => "Cập nhật Mật Khẩu thành công"]);
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            new \Model\Error(["type" => "danger", "content" => $ex->getMessage()]);
        }
        \lib\Common::ToUrl($_SERVER["HTTP_REFERER"]);
    }

//    SavePassword

    public function delete() {

    }

    public function detail() {

    }

    public function update() {

    }

}

?>
