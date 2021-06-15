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

        $_strParam = str_replace("?", "", $this->getParam()[0]);
        parse_str($_strParam, $params);

        $_GET["keyword"] = $params["keyword"];
        $_GET["pages"] = isset($params["pages"]) ? $params["pages"] : 1;

        Model_Seo::$Title = "__Title___";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__SEO_Keyword___";
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "danhmuc");
    }

}
?>

