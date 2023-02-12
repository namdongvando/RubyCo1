<?php

namespace Model;

use PFBC\Element\Hidden;
use PFBC\Element\Select;


class ProductsForm implements iProductForm
{

    public static $FormValue;
    const formName = "Product";
    static $Option = ["class" => "form-control"];

    public function __construct($value = null)
    {
        self::$FormValue = $value;
    }
    public function GetName($name)
    {
        return  self::formName . "[" . $name . "]";
    }
    public function GetValue($name)
    {
        return self::$FormValue[$name] ?? null;
    }

    public function Alias($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Bài Viết";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     * @param mixed $val
     * @return mixed
     */
    public function Id($val = null)
    {
        $name = $this->GetName(__FUNCTION__);
        $val = $val ?? self::GetValue(__FUNCTION__);
        return new FormRender(new Hidden($name, $val));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Username($val = null)
    {
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function CatId($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Danh Mục";
        $Option = Category::GetCatBy2Option();
        return new FormRender(new Select($label, $name, $Option, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Name($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Tên Sản Phẩm";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Price($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Giá";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function DonViTinh($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "ĐVT";
        return new FormRender(new Select($label, $name, OptionsService::ToSelectByGroup("DVT"), $properties));
    }

    public function OldPrice($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Giá Cũ";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Summary($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["class"] = "editorMini";
        $properties["id"] = "editorMini" . __FUNCTION__;
        $name = $this->GetName(__FUNCTION__);
        $label = "Mô tả";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Content($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["class"] = "editor";
        $properties["id"] = "editor" . __FUNCTION__;
        $name = $this->GetName(__FUNCTION__);
        $label = "Chi tiết";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function UrlHinh($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $properties["id"] = __FUNCTION__;
        $properties[FormRender::readonly] = "true";
        $name = $this->GetName(__FUNCTION__);
        $label = "Hình";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function DateCreate($val = null)
    {
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Number($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Số Lượng";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Note($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Ghi chú";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function BuyTimes($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Số lần mua";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Views($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Số lần xem";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function IsShow($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Ẩn/Hiện";
        return new FormRender(new Select($label, $name, [1 => "Hiện", 0 => "Ẩn"], $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Serial($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Thứ tự";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    /**
     *
     * @param mixed $val
     * @return mixed
     */
    public function Lang($val = null)
    {
        $properties = self::$Option;
        $properties["value"] = $val ?? self::GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = "Ngôn ngữ";
        return new FormRender(new Select($label, $name, \Model\ProductLang::GetLangsOption(), $properties));
    }
}
