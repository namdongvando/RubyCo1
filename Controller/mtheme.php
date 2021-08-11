<?php

class Controller_mtheme extends Controller_backend {

    public $menu;
    public $theme;
    public $Slide;

    function __construct() {
        $this->menu = new \Model\Menu();
        $this->Slide = new \Model\slide();
        parent::__construct();
        $this->Bread[] = [
            "title" => "Quản lý giao diện",
            "link" => "/mtheme/"
        ];
    }

    function index() {
        $_bre = new Model\Breadcrumb();
        $_bre->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "theme");
    }

    function deletemenu() {
        $this->menu->DeleteMenu($this->param[0]);
        lib\Common::ToUrl($_SERVER["HTTP_REFERER"]);
    }

    function thememenu() {
        if (isset($_POST["SaveMenu"])) {
            foreach ($_POST["IDMenu"] as $k => $value) {
                $menuedit = $this->menu->MenusById($value, FALSE);
                $menuedit["Name"] = $_POST["Name"][$k];
                $menuedit["Link"] = $_POST["Link"][$k];
                $menuedit["Parent"] = $_POST["Parent"][$k];
                $menuedit["OrderBy"] = $_POST["OrderBy"][$k];
                $menuedit["Groups"] = $_POST["Groups"][$k];
                $menuedit["UpdateDate"] = date("Y-m-d H:i:s");
                $this->menu->EditMenu($menuedit);
            }
        }


        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "theme");
    }

    function language() {

        if (isset($_POST["SaveLang"])) {
            $str = "";
            foreach ($_POST["Lang"] as $k => $value) {
                $str .= sprintf(" %s = %s \n ", $k, $value);
            }
            $lib = new \lib\io();
//             luu
            $lib->writeFile(__DIR__ . "/../theme/home/config/vi.ini", $str);
        }

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "theme");
    }

    function mhome() {

        if (isset($_POST["SaveConfigHome"])) {
            $content = $_POST["ConfigHome"];
            $lib = new \lib\io();
            $lib->writeFile(ROOT_DIR . "/theme/config/homeconfig.json", $content);
        }

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "theme");
    }

    function getThemes() {


        $a = $this->menu->AllTheme();
        $this->CreateApi($a);
    }

    function getMenuByTheme() {
        $a = $this->menu->MenuByTheme($this->param[0]);
        $this->CreateApi($a);
    }

    function getMenuByThemeAndGroup() {
        $a = $this->menu->MenuByGroupTheme($this->param[0], $this->param[1], FALSE);
        $this->CreateApi($a);
    }

    function createMenu4ThemeGroups() {
        $a["IDMenu"] = time();
        $a["Theme"] = $this->param[0];
        $a["Groups"] = $this->param[1];
        $a["Parent"] = 0;
        $a["OrderBy"] = 0;
        $a["createDate"] = date("Y-m-d H:i:s", time());
        $a["UpdateDate"] = date("Y-m-d H:i:s", time());
        $this->menu->AddMenu($a);
        $this->CreateApi($a);
    }

//    function GetSlidesByTheme() {
//        $a = $this->Slide->SlidesByTheme($this->param[0]);
//        $this->CreateApi($a);
//    }
}

?>