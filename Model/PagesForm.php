<?php

namespace Model;

use PFBC\Element;

class PagesForm extends \PFBC\Form implements IPagesForm {

    function __construct() {

    }

    private static $Option = ["class" => "form-control"];

    public static function Alias($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Tiêu Đề Không Dấu";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Content($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $properties["class"] = "editor";
        $properties["id"] = "BaiViet";
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Bài Viết";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function Des($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Mô Tả ";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function Keyword($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Từ Khóa";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function Name($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Tên Trang";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Note($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Ghi Chú";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function OrderBy($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Sắp Xếp";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $properties));
    }

    public static function Summary($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $properties["class"] = "editorMini";
        $properties["id"] = "TomTatBaiViet";
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Mô Tả Ngắn";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function Title($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Tiêu Đề";
        return new FormRender(new \PFBC\Element\Textarea($label, $name, $properties));
    }

    public static function Type($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $options = [
            "1" => "Danh Mục Tin"
            , "0" => "Trang"
        ];
        $label = "Loại Trang";
        return new FormRender(new \PFBC\Element\Select($label, $name, $options, $properties));
    }

    public static function Urlimages($value = null) {
        $options = self::$Option;
        $options["value"] = $value;
        $options["readonly"] = "true";
        $options["id"] = "txtUrlimages";
        $name = "pages[" . __FUNCTION__ . "]";
        $label = "Hình Ảnh";
        return new FormRender(new \PFBC\Element\Textbox($label, $name, $options));
    }

    public static function idGroup($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $options["1"] = "Hiện";
        $options["0"] = "Ẩn";
        $label = "Nhóm";
        return new FormRender(new Element\Select($label, $name, $options, $properties));
    }

    public static function isShow($value = null) {
        $properties = self::$Option;
        $properties["value"] = $value;
        $name = "pages[" . __FUNCTION__ . "]";
        $options["1"] = "Hiện";
        $options["0"] = "Ẩn";
        $label = "Ẩn/Hiện";
        return new FormRender(new Element\Select($label, $name, $options, $properties));
    }

    public static function idPa($value = null) {
        $name = "pages[" . __FUNCTION__ . "]";
        return new \PFBC\Element\Hidden($name, $value);
    }

}

?>