<?php

namespace Model;

use PFBC\Element;

class PhanTrangForm {

    const classElament = ["class" => "form-control"];

    //put your code here
    public function __construct() {

    }

    static function TuKhoa($val, $prop) {
        $label = "Từ Khóa";
        $name = "Name";
        $properties = self::classElament;
        $properties = array_merge($properties, $prop);
        $properties["value"] = $val;
        return new FormRender(new Element\Textbox($label, $name, $properties));
    }

    static function HienThi($val, $prop) {
        $label = "Hiển thị";
        $name = "Number";
        $properties = self::classElament;
        $properties = array_merge($properties, $prop);
        $properties["value"] = $val;
        return new FormRender(new Element\Select($label, $name, [10 => "10 dòng", 20 => "20 dòng", 50 => "50 dòng", 100 => "100 dòng"], $properties));
    }

    public static function IndexPage($val, $prop) {
        $properties = self::classElament;
        $properties = array_merge($properties, $prop);
        return new FormRender(new Element\Hidden(__FUNCTION__, $val, $properties));
    }

    public static function Select($val, $options, $prop) {
        $name = !empty($prop["name"]) ? $prop["name"] : '';
        $label = !empty($prop["label"]) ? $prop["label"] : '';
        $properties = self::classElament;
        $properties = array_merge($properties, $prop);
        $properties["value"] = $val;
        return new FormRender(new Element\Select($label, $name, $options, $properties));
    }

}
