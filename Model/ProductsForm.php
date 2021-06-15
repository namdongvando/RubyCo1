<?php

namespace Model;

class ProductsForm implements iProductForm {

    static $Option = ["class" => "form-control"];

    public static function Alias($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $properties["class"] = "editor";
        $properties["id"] = "BaiViet";
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Bài Viết";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function BuyTimes($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "product[" . __FUNCTION__ . "]";
        $label = "Số Lần Mua";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Content($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $properties["class"] = "editor";
        $properties["id"] = "BaiViet";
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Bài Viết";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function DateCreate($val = null) {

    }

    public static function ID($val = null) {
        $name = "Product[" . __FUNCTION__ . "]";
        return new FormRender(new \PFBC\Element\Hidden($name, $val));
    }

    public static function Note($val = null) {

    }

    public static function DoVi($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[Note][DonVi]";
        $label = "Đơn Vị";
        $options = ProductNote::GetList();
        return new FormRender(new \PFBC\Element\Select($label, $name, $options, $properties));
    }

    public static function Number($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Số Lượng";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Price($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Giá";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Summary($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $properties["class"] = "editorMini";
        $properties["id"] = "TomTat";
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Mô Tả";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function UrlHinh($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $properties["id"] = "UrlHinh";
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Số Lượng";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Username($val = null) {

    }

    public static function Views($val = null) {

    }

    public static function catID($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Danh Mục";
        $options = Category::GetCatBy2Option();
        return new FormRender(new \PFBC\Element\Select($label, $name, $options, $properties));
    }

    public static function isShow($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Hiện Thị";
        return new FormRender(new \PFBC\Element\Select($label, $name, [1 => "Hiện", 0 => "Ẩn"], $properties));
    }

    public static function nameProduct($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Tên Sản Phẩm";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function oldPrice($val = null) {
        $properties = self::$Option;
        $properties["value"] = $val;
        $name = "Product[" . __FUNCTION__ . "]";
        $label = "Giá Cũ";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function lang($val = null) {
        $isShow = true;
        $name = "Product[" . __FUNCTION__ . "]";
        $properties = self::$Option;
        $properties["value"] = $val;
        $label = "Ngôn Ngữ";
        $options = ProductLang::GetLangsOption();
        if (count($options) == 1) {
            $isShow = FALSE;
        }
        if ($isShow == FALSE) {
            return new FormRender(new \PFBC\Element\Hidden($name, ProductLang::Defaut));
        }
        return new FormRender(new \PFBC\Element\Select($label, $name, $options, $properties));
    }

}
