<?php

// api này không cần dang nhap
class Controller_import extends Application {

    public $param;
    public $database;
    public $category;

    function __construct() {
        $this->param = $this->getParam();
        $this->database = new Model\Database();
        $this->category = new Model\Category();
    }

    function index() {
        $this->database->Query("SELECT a.`id`,a.`parentid`,b.`name` FROM `bakcodt_category` as a ,`bakcodt_category_ln` as b WHERE a.id=b.id and `ln`='vn'");
        $re = $this->database->fetchAll();
        foreach ($re as $_cat) {
            $Cat["catID"] = $_cat["id"];
            $Cat["catName"] = $_cat["name"];
            $Cat["Note"] = "";
            $Cat["Lang"] = "vi";
            $Cat["parentCatID"] = $_cat["parentid"];
            $Cat["banner"] = "";
            $Cat["Public"] = 1;
            $Cat["Path"] = $this->database->bodautv($_cat["name"]);
            $Cat["Link"] = $this->database->bodautv($_cat["name"]);
            $Cat["Serial"] = 0;
            $this->category->AddCategory1($Cat);
        }
    }

    function sanpham() {
        $this->database->Query("SELECT a.id,a.catid,a.icon,b.name,b.priceSale,b.priceBuy,b.content,b.intro FROM `bakcodt_content` as a,`bakcodt_content_ln` as b WHERE a.id = b.id and a.catid>0 ORDER BY `a`.`id` ASC");
        $re = $this->database->fetchAll();
        if($re)
        foreach ($re as $_cat) {
             $sanPham["ID"] = $_cat["id"];
             $sanPham["Username"] = "admin";
             $sanPham["catID"] = $_cat["catid"];
             $sanPham["nameProduct"] = $_cat["name"];
             $sanPham["Alias"] = $this->database->bodautv($_cat["name"]);
             $sanPham["Price"] = $_cat["priceBuy"];
             $sanPham["oldPrice"] = $_cat["priceSale"];
             $sanPham["Summary"] = $_cat["intro"];
             $sanPham["Content"] = $_cat["content"];
             $sanPham["UrlHinh"] = $_cat["icon"];
             $sanPham["DateCreate"] = date("Y-m-y H:i:s");
             $sanPham["Number"] = 0;
             $sanPham["Note"] = "";
             $sanPham["BuyTimes"] = 0;
             $sanPham["Views"] = 0;
             $sanPham["isShow"] = 1;
             $sanPham["lang"] = "vi";
             $this->database->AddProducts($sanPham);
        }
    }

}

?>