<?php

namespace Model;

class ProductLang {

    const Defaut = "vi";

    public $Code;
    public $Name;

    public function __construct($lang = null) {
        if ($lang) {
            $this->Code = $lang["Code"];
            $this->Name = $lang["Name"];
        }
    }

    public static function GetLangs() {
        return [
            ["Code" => "vi", "Name" => "Tiếng Việt"]
//            ["Code" => "en", "Name" => "Tiếng Anh"]
        ];
    }

    public static function ToOption() {
        $a = [];
        foreach (self::GetLangs() as $key => $value) {
            $a[$value["Code"]] = $value["Name"];
        }
        return $a;
    }

    public static function GetLangsOption() {
        return self::ToOption();
    }

}
