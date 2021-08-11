<?php

class Controller_mthuvien extends Controller_mpage {

    public $news;
    public $page;

    function __construct() {
        $this->news = new \Model\news();
        $this->page = new \Model\pages();
        parent::__construct();
        ob_start();
    }

    function index() {
        $path = "/public/img/";
        \Model\pathCkFinder::set($path);
        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "page");
    }

    function __destruct() {

        $str = ob_get_clean();
        $params = parse_ini_file(__DIR__ . '/../public/language/editnews.ini', true);
        $DSOption = $params;
        if ($DSOption)
            foreach ($DSOption as $k => $value) {
                $str = str_replace($k, $value, $str);
            }
        echo $str;
    }

}

?>