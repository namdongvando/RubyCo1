<?php

namespace Model\tags;

use PFBC\Element;

class tagsForm implements itagsForm {

    const elementClass = ["class" => "form-control"];
    const FormName = 'TagsForm';
    const NameXoa = 'Xoa';
    const NameSave = "Save";

    public static function Alias($val = null) {
        $prop = self::elementClass;
        $prop["value"] = $val;
        $name = self::FormName . "[" . __FUNCTION__ . "]";
        $label = __FUNCTION__;
        return new \Model\FormRender(new Element\Textbox($label, $name, $prop));
    }

    public static function Content($val = null) {
        $prop = self::elementClass;
        $prop["value"] = $val;
        $prop["id"] = __FUNCTION__;
        $name = self::FormName . "[" . __FUNCTION__ . "]";
        $label = __FUNCTION__;
        return new \Model\FormRender(new Element\Textarea($label, $name, $prop));
    }

    public static function Id($val = null) {
        $name = self::FormName . "[" . __FUNCTION__ . "]";
        return new \Model\FormRender(new Element\Hidden($name, $val));
    }

    public static function Name($val = null) {
        $prop = self::elementClass;
        $prop["value"] = $val;
        $prop[] = $val;
        $prop[\Model\FormRender::required] = "";
        $name = self::FormName . "[" . __FUNCTION__ . "]";
        $label = __FUNCTION__;
        return new \Model\FormRender(new Element\Textbox($label, $name, $prop));
    }

    public static function btnSave() {
        return new \Model\FormRender(new Element\Button("Save", "submit", ["Name" => self::NameSave]));
    }

    public static function btnDelete() {
        return new \Model\FormRender(new Element\Button("Xóa", "submit", ["title" => "Xóa", "class" => "pull-right xoa btn btn-danger", "Name" => self::NameXoa]));
    }

}
