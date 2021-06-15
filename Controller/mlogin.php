<?php

class Controller_mlogin extends Application {

    function __construct() {
        $_SESSION["mlogin"] = isset($_SESSION["mlogin"]) ? $_SESSION["mlogin"] : 0;
        $_SESSION["LastTime"] = isset($_SESSION["LastTime"]) ? $_SESSION["LastTime"] : 0;

        $a = new Model_Adapter();
        if (isset($_SESSION[QuanTri])) {
            $a->_header("/backend");
        }
        Model_ViewTheme::set_viewthene("backend");
    }

    function index() {
        try {
            if (isset($_POST["dangnhap"])) {
                if ($_POST["Username"] == "") {
                    throw new \Exception("Chưa Nhập Tài Khoản.");
                }
                if ($_POST["Password"] == "") {
                    throw new \Exception("Chưa Nhập Mật Khẩu.");
                }
                // kiểm tra so lần đăng nhap
                if ($_SESSION["mlogin"] > 3) {
                    if (time() - $_SESSION["LastTime"] > 120) {
                        $_SESSION["mlogin"] = 1;
                        $_SESSION["LastTime"] = 0;
                    }
                    throw new \Exception("Bạn Đăng Nhập Sai Quá Nhiều. Chờ Sau 2 phút.");
                } else {
                    // nếu còn số lần đăng nhập thì thì kiển tra tiếp
                    $Admin = new \Model\Admin();
                    $_SESSION[QuanTri] = $Admin->CheckLogin($_POST["Username"], $_POST["Password"], FALSE);
// danh nhap không thanh công
                    if (!$_SESSION[QuanTri]) {
                        $_SESSION["mlogin"] ++;

                        if ($_SESSION["mlogin"] > 3)
                            $_SESSION["LastTime"] = time();

                        throw new \Exception("Tài Khoản / Mật Khẩu không Đúng");
                    } else {
                        // đăng nhập thành công
                        $_SESSION["mlogin"] = 0;
                        $_SESSION["LastTime"] = 0;
                    }
                }
                // cập nhật số lần cập nhật

                $Admin->_header("/backend/");
            }
        } catch (\Exception $exc) {
            new Model\Error(["type" => "danger", "content" => $exc->getMessage()]);
        }

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "login");
    }

}

?>