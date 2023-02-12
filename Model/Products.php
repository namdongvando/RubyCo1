<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use lib\input;

class Products extends \Model\Database
{

    public $Id;
    public $Username;
    public $CatId;
    public $Name;
    public $Alias;
    public $Price;
    public $DonViTinh;
    public $OldPrice;
    public $Summary;
    public $Content;
    public $UrlHinh;
    public $DateCreate;
    public $Number;
    public $Note;
    public $BuyTimes;
    public $Views;
    public $IsShow;
    public $Serial;
    public $Lang;
    public static $tableName;

    function __construct($product = null)
    {
        self::$tableName =  table_prefix . "product";
        if (!is_array($product)) {
            $product = $this->GetById($product);
        }
        parent::__construct();

        $this->Id = $product["Id"] ?? null;
        $this->Username = $product["Username"] ?? null;
        $this->CatId = $product["CatId"] ?? null;
        $this->Name = $product["Name"] ?? null;
        $this->Alias = $product["Alias"] ?? null;
        $this->Price = intval($product["Price"] ?? 0)  ?? null;
        $this->DonViTinh = $product["DonViTinh"] ?? null;
        $this->OldPrice = $product["OldPrice"] ?? null;
        $this->Summary = input::InputTextDecode($product["Summary"] ?? "");
        $this->Content = input::InputTextDecode($product["Content"] ?? "");
        $this->UrlHinh = $product["UrlHinh"] ?? null;
        $this->DateCreate = $product["DateCreate"] ?? null;
        $this->Number = $product["Number"] ?? null;
        $this->Note = $product["Note"] ?? null;
        $this->BuyTimes = $product["BuyTimes"] ?? null;
        $this->Views = $product["Views"] ?? null;
        $this->IsShow = $product["IsShow"] ?? null;
        $this->Serial = $product["Serial"] ?? null;
        $this->Lang = $product["Lang"] ?? null;
    }

    function Note()
    {
        if ($this->Note)
            return new ProductNote($this->Note);
        return new ProductNote();
    }

    public function DonViTinh()
    {
        return new OptionsService(OptionsService::GetByKeyVal($this->DonViTinh, "DVT"));
    }

    function Products()
    {
        return parent::Products();
    }

    function ProductsAll()
    {
        return parent::ProductsAll();
    }

    function ProductsAllPT($Page = 1, $Number = 20, &$Tong = 0)
    {
        return parent::ProductsAllPT($Page, $Number, $Tong);
    }


    public function BtnGroup()
    {
        return $this->btnEdit() . $this->btnDelete();
    }

    function showPrice($a)
    {
        return \lib\Common::MoneyFomat($a);
    }

    function UrlHinh()
    {
        return $this->UrlHinh;
    }

    function Price()
    {
        $a = $this->Price;
        return \lib\Common::MoneyFomat($a);
    }

    function PriceShow()
    {
        $a = $this->Price;
        if ($a == 0) {
            return $this->Price();
        }
        return $this->Price() . " " . $this->Note()->TenDonVi();
    }

    function OldPrice()
    {
        return \lib\Common::MoneyFomat($this->OldPrice);
    }

    function CatName($id)
    {
        $a = $this->Category4Id($id);
        return $a->catName;
    }

    function DeleteProductsByID($ID)
    {
        $this->delete(table_prefix . "product", "`Id` = '{$ID}'");
    }

    function EditProducts($Product)
    {
        $where = "`Id` = '{$Product["Id"]}'";
        return $this->update(self::$tableName, $Product, $where);
    }

    function AddProducts($Product)
    {
        return $this->insert(self::$tableName, $Product);
    }

    function linkProduct()
    {
        $p = new \Model\Category();
        $a = $p->Category4Id($this->CatId);
        $linkcat = $a->linkCurentCategory();
        return $linkcat . "/" . $this->Alias . ".html";
    }

    function ProductsByID($Id, $isobj = True)
    {
        return parent::ProductsByID($Id, $isobj);
    }
    function GetById($Id)
    {
        return parent::ProductsByID($Id, false);
    }

    function ProductsByAlias($Alias, $isobj = True)
    {
        return parent::ProductsByAlias($Alias, $isobj);
    }

    function ProductsByCatId($CatId, $page, $number, &$sum)
    {
        return parent::ProductsByCatId($CatId, $page, $number, $sum);
    }

    function getProductsByName($CatId, $page, $number, &$sum)
    {
        return $this->ProductsByName($CatId, $page, $number, $sum);
    }

    function AllProductsByCatId($CatId)
    {
        parent::AllProductsByCatId($CatId);
    }

    function imagesDirectory()
    {
        return "/public/img/images/sanpham/" . $this->Id . "/";
    }

    function imagesDirectory4Product($id)
    {
        return "/public/img/images/sanpham/" . $id . "/";
    }

    function getAllImges($id)
    {
        $dir = new \lib\redDirectory();
        $a = [];
        $dir->redDirectoryByPath("public/img/images/sanpham/" . $id . "/", $a);
        foreach ($a as $k => $value) {
            $a[$k] = $this->imagesDirectory4Product($id) . $value;
        }
        return $a;
    }

    public function ProductsSale($num)
    {
        $sql = "SELECT * FROM `" . table_prefix . "product` where 1 ORDER BY `DateCreate` DESC limit 0,{$num}";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }
    public function btnEdit()
    {
        $id = $this->Id;
        return "<a class='btn btn-primary' href='/mproduct/editproduct/{$id}' >Sửa</a>";
    }
    public function btnDelete()
    {
        $id = $this->Id;
        return "<a class='btn btn-danger' href='/mproduct/deleteproduct/{$id}' >Xóa</a>";
    }
    public function Breadcrumb()
    {
        $cat = new Category();
        $a = $cat->Breadcrumb($this->CatId);
        $a[] = [
            "link" => "#",
            "title" => $this->Name
        ];

        return $a;
    }

    public function ProductsNoPrice()
    {
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

    public function DanhMuc()
    {
        $Cat = new Category();
        return $Cat->Category4Id($this->CatId, FALSE);
    }

    public function ProductsByCatIdAndName($CatId, $Name, $page, $number, &$sum)
    {
        $start = ($page - 1) * $number;
        $start = max(0, $start);

        $CatId = is_array($CatId) ? implode(',', $CatId) : $CatId;
        $sql = "SELECT `Id`, `Username`, `CatId`,`Alias`, `nameProduct`, `Price`, `oldPrice`, `UrlHinh`, `DateCreate`, `Number`, `Note`, `BuyTimes`, `Views`, `isShow`, `lang` "
            . "FROM `" . table_prefix . "product` "
            . "where `CatId` in ({$CatId}) and (`Alias` like '%{$Name}%' or `nameProduct` like '%{$Name}%' or `Id` like '%{$Name}%')";
        $this->Query($sql);
        $a = $this->fetchAll();
        if ($a) {
            $sum = count($a);
        }
        $sql = "SELECT `Id`, `Username`, `CatId`,`Alias`, `nameProduct`, `Price`, `oldPrice`, `UrlHinh`, `DateCreate`, `Number`, `Note`, `BuyTimes`, `Views`, `isShow`, `lang` "
            . "FROM `" . table_prefix . "product` "
            . "where `CatId` in ({$CatId}) and (`Alias` like '%{$Name}%' or `nameProduct` like '%{$Name}%' or `Id` like '%{$Name}%') order by `CatId`  limit {$start},{$number} ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    public function ListToArrayAPi($data)
    {
        $DanhMuc = new Category();
        foreach ($data as $key => $value) {
            // var_dump($value);
            $value["Summary"] = "";
            $value["Content"] = "";
            $value["DateCreate"] = date("d-m-Y", strtotime($value["DateCreate"]));
            $value["Price"] = floatval($value["Price"]);
            $value["DanhMuc"] = $DanhMuc->Category4Id($value["CatId"], false);
            $data[$key] = $value;
        }
        return $data;
    }

    public function Summary()
    {
        return strip_tags($this->Summary);
    }
    public function ToRow($index)
    {
        $url = $this->UrlHinh;
        return [
            "Id" => $index + 1,
            "UrlHinh" => "<img height='50' class='img img-reponsive' src='{$url}' >",
            // "Username" => "Tài khoản",
            "CatId" => $this->DanhMuc()["catName"],
            "Name" => $this->Name,
            // "Alias" => "Tên không dấu",
            "Price" => $this->Price(),
            "DonViTinh" => $this->DonViTinh()->Name,
            // "OldPrice" => "Giá cũ",
            // "Summary" => "Mô tả",
            // "Content" => "Chi tiết",

            "DateCreate" => date("d-m-Y", strtotime($this->DateCreate)),
            "Number" => $this->Number,
            // "Note" => "Ghi chú",
            "BuyTimes" => $this->BuyTimes,
            "Views" => $this->Views,
            "IsShow" => $this->IsShow == 1 ? "Hiện" : "Ẩn",
            "Serial" => $this->Serial,
            "Lang" => $this->Lang,
        ];
    }
    public function ColumnsTable()
    {
        return [
            // "Id" => "Mã",
            "UrlHinh" => "Hình",
            // "Username" => "Tài khoản", 
            "Name" => "Tên sản phẩm",
            "CatId" => "Danh Mục",
            // "Alias" => "Tên không dấu",
            "Price" => "Giá",
            "DonViTinh" => "ĐVT",
            // "OldPrice" => "Giá cũ",
            // "Summary" => "Mô tả",
            // "Content" => "Chi tiết",

            "DateCreate" => "Ngày tạo",
            "Number" => "Số lượng",
            // "Note" => "Ghi chú",
            "BuyTimes" => "Số lần mua",
            "Views" => "Số lần xem",
            "IsShow" => "Ẩn hiển",
            "Serial" => "STT",
            "Lang" => "Ngôn ngữ"
        ];
    }
    //put your code here
}
