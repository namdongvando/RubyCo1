<?php

class Controller_timkiem extends Controller_index {

    public $param;
    public $ViewTheme;
    public $Pages;
    public $News;

    function __construct() {
        $this->param = $this->getParam();
        $this->Pages = new \Model\pages();
        $this->News = new \Model\news();
        parent::__construct();
    }

    function index() {
        $params = $_GET;
        $_GET["keyword"] = !empty($_GET["keyword"]) ? $_GET["keyword"] : "";
        $_GET["keyword"] = Model\CheckInput::ChekInput($params["keyword"]);
        $_GET["pages"] = isset($params["pages"]) ? intval($params["pages"]) : 1;
        Model_Seo::$Title = "__Title___";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__SEO_Keyword___";
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "danhmuc");
    }

}
?>

