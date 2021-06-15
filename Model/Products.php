<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

class Products extends \Model\Database {

    public $ID;
    public $Username;
    public $catID;
    public $nameProduct;
    public $Alias;
    public $Price;
    public $oldPrice;
    public $Summary;
    public $Content;
    public $UrlHinh;
    public $DateCreate;
    public $Number;
    public $Note;
    public $BuyTimes;
    public $Views;
    public $isShow;
    public $lang;

    function __construct($product = null) {
        if ($product) {
            $this->ID = $product["ID"];
            $this->Username = $product["Username"];
            $this->catID = $product["catID"];
            $this->nameProduct = $product["nameProduct"];
            $this->Alias = $product["Alias"];
            $this->Price = $product["Price"];
            $this->oldPrice = $product["oldPrice"];
            $this->Summary = isset($product["Summary"]) ? $product["Summary"] : "";
            $this->Content = isset($product["Content"]) ? $product["Content"] : "";
            $this->UrlHinh = $product["UrlHinh"];
            $this->DateCreate = $product["DateCreate"];
            $this->Number = $product["Number"];
            $this->Note = $product["Note"];
            $this->BuyTimes = $product["BuyTimes"];
            $this->Views = $product["Views"];
            $this->isShow = $product["isShow"];
            $this->lang = !empty($product["lang"]) ? $product["lang"] : "vi";
        }
        parent::__construct();
    }

    function Note() {
        if ($this->Note)
            return new ProductNote($this->Note);
        return new ProductNote();
    }

    function Products() {
        return parent::Products();
    }

    function ProductsAll() {
        return parent::ProductsAll();
    }

    function ProductsAllPT($Page = 1, $Number = 20, &$Tong = 0) {
        return parent::ProductsAllPT($Page, $Number, $Tong);
    }

    function showPrice($a) {
        return \lib\Common::MoneyFomat($a);
    }

    function UrlHinh() {
        return $this->UrlHinh;
    }

    function Price() {
        $a = $this->Price;
        return \lib\Common::MoneyFomat($a);
    }

    function PriceShow() {
        $a = $this->Price;
        if ($a == 0) {
            return $this->Price();
        }
        return $this->Price() . " " . $this->Note()->TenDonVi();
    }

    function OldPrice() {
        $a = $this->oldPrice;
        return \lib\Common::MoneyFomat($a);
    }

    function CatName($id) {
        $a = $this->Category4Id($id);
        return $a->catName;
    }

    function DeleteProductsByID($ID) {
        $this->delete(table_prefix . "product", "`ID` = '{$ID}'");
    }

    function EditProducts($Product) {
        return parent::EditProducts($Product);
    }

    function AddProducts($Product) {
        return parent::AddProducts($Product);
    }

    function linkProduct() {
        $p = new \Model\Category();
        $a = $p->Category4Id($this->catID);
        $linkcat = $a->linkCurentCategory();
        return $linkcat . "/" . $this->Alias . ".html";
    }

    function ProductsByID($Id, $isobj = True) {
        return parent::ProductsByID($Id, $isobj);
    }

    function ProductsByAlias($Alias, $isobj = True) {
        return parent::ProductsByAlias($Alias, $isobj);
    }

    function ProductsByCatID($CatId, $page, $number, &$sum) {
        return parent::ProductsByCatID($CatId, $page, $number, $sum);
    }

    function getProductsByName($CatId, $page, $number, &$sum) {
        return $this->ProductsByName($CatId, $page, $number, $sum);
    }

    function AllProductsByCatID($CatId) {
        parent::AllProductsByCatID($CatId);
    }

    function imagesDirectory() {
        return "/public/img/images/sanpham/" . $this->ID . "/";
    }

    function imagesDirectory4Product($id) {
        return "/public/img/images/sanpham/" . $id . "/";
    }

    function getAllImges($id) {
        $dir = new \lib\redDirectory();
        $a = [];
        $dir->redDirectoryByPath("public/img/images/sanpham/" . $id . "/", $a);
        foreach ($a as $k => $value) {
            $a[$k] = $this->imagesDirectory4Product($id) . $value;
        }
        return $a;
    }

    public function ProductsSale($num) {
        $sql = "SELECT * FROM `" . table_prefix . "product` where 1 ORDER BY `DateCreate` DESC limit 0,{$num}";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

    public function Breadcrumb() {
        $cat = new Category();
        $a = $cat->Breadcrumb($this->catID);
        $a[] = [
            "link" => "#",
            "title" => $this->nameProduct
        ];

        return $a;
    }

    public function ProductsNoPrice() {
        $sql = "SELECT * FROM `" . table_prefix . "product` where `Price` = 0 ";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

//    public function ProductsByName($name) {
//        $sql = "SELECT * FROM `" . table_prefix . "product` where `nameProduct` like '%$name%'";
//        $this->Query($sql);
//        $a = $this->fetchAll();
//        return $a;
//    }

    public function DanhMuc() {
        $Cat = new Category();
        return $Cat->Category4Id($this->catID, FALSE);
    }

    public function ProductsByCatIDAndName($CatId, $Name, $page, $number, &$sum) {
        $start = ($page - 1) * $number;
        $start = max(0, $start);

        $CatId = is_array($CatId) ? implode(',', $CatId) : $CatId;
        $sql = "SELECT `ID`, `Username`, `catID`,`Alias`, `nameProduct`, `Price`, `oldPrice`, `UrlHinh`, `DateCreate`, `Number`, `Note`, `BuyTimes`, `Views`, `isShow`, `lang` "
                . "FROM `" . table_prefix . "product` "
                . "where `catID` in ({$CatId}) and (`Alias` like '%{$Name}%' or `nameProduct` like '%{$Name}%' or `ID` like '%{$Name}%')";
        $this->Query($sql);
        $a = $this->fetchAll();
        if ($a) {
            $sum = count($a);
        }
        $sql = "SELECT `ID`, `Username`, `catID`,`Alias`, `nameProduct`, `Price`, `oldPrice`, `UrlHinh`, `DateCreate`, `Number`, `Note`, `BuyTimes`, `Views`, `isShow`, `lang` "
                . "FROM `" . table_prefix . "product` "
                . "where `catID` in ({$CatId}) and (`Alias` like '%{$Name}%' or `nameProduct` like '%{$Name}%' or `ID` like '%{$Name}%') order by `catID`  limit {$start},{$number} ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    public function ListToArrayAPi($data) {
        $DanhMuc = new Category();
        foreach ($data as $key => $value) {
            $value["Summary"] = "";
            $value["Content"] = "";
            $value["DateCreate"] = date("d-m-Y", strtotime($value["DateCreate"]));
            $value["Price"] = floatval($value["Price"]);
            $value["DanhMuc"] = $DanhMuc->Category4Id($value["catID"], false);
            $data[$key] = $value;
        }
        return $data;
    }

    public function Summary() {
        return strip_tags($this->Summary);
    }

    //put your code here
}
