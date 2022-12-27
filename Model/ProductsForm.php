<?php

namespace Model;


class ProductsForm implements iProductForm
{

    public static $FormValue;
    const formName = "Product";
    static $Option = ["class" => "form-control"];

    public function __construct($value = null)
    {
        self::$FormValue = $value;
    }

    public static function GetValue($name)
    {
        return self::$FormValue[$name] ?? null;
    }

    public static function Alias($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["class"] = "editor";
        $properties["id"] = "BaiViet";
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Bài Viết";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function SetName($name)
    {
        return self::formName . "[{$name}]";
    }

    public static function BuyTimes($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Số Lần Mua";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Content($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["class"] = "editor";
        $properties["id"] = "BaiViet";
        $name = self::SetName(__FUNCTION__);
        $label = "Bài Viết";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function DateCreate($val = null)
    {
    }

    public static function Id($val = null)
    {
        $val = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        return new FormRender(new \PFBC\Element\Hidden($name, $val));
    }

    public static function Note($val = null)
    {
    }

    public static function DoViTinh($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Đơn Vị";
        $options = ProductNote::GetList();
        return new FormRender(new \PFBC\Element\Select($label, $name, $options, $properties));
    }

    public static function Number($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Số Lượng";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Price($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Giá";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Summary($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["class"] = "editorMini";
        $properties["id"] = "TomTat";
        $name = self::SetName(__FUNCTION__);
        $label = "Mô Tả";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function UrlHinh($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["id"] = "UrlHinh";
        $name = self::SetName(__FUNCTION__);
        $label = "Số Lượng";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Username($val = null)
    {
    }

    public static function Views($val = null)
    {
    }

    public static function CatId($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Danh Mục";
        $options = Category::GetCatBy2Option();
        return new FormRender(new \PFBC\Element\Select($label, $name, $options, $properties));
    }

    public static function IsShow($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Hiện Thị";
        return new FormRender(new \PFBC\Element\Select($label, $name, [1 => "Hiện", 0 => "Ẩn"], $properties));
    }

    public static function Name($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Tên Sản Phẩm";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function OldPrice($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = self::SetName(__FUNCTION__);
        $label = "Giá Cũ";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Lang($val = null)
    {
        $isShow = true;
        $name = self::SetName(__FUNCTION__);
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
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
    /**
     * @param mixed $val
     * @return mixed
     */
    public static function DonViTinh($val = null)
    {
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public static function Serial($val = null)
    {
    }
}
