<?php

namespace Model;

use PFBC\Element\Hidden;
use PFBC\Element\Textbox;

class FormCommon
{

    public function __construct()
    {
    }

    public static function Name($lable, $name, $val)
    {
        $prop["value"] = $val;
        $prop["class"] = "form-control";
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public static function Hidden($name, $val)
    {
        return new FormRender(new Hidden($name, $val));
    }
}
