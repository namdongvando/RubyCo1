<?php

namespace Model;

class ProductNote {

    public $DonVi;

    public function __construct($stringNode = null) {
        try {
            $a = $this->JsonDecode($stringNode);
            $this->DonVi = !empty($a["DonVi"]) ? intval($a["DonVi"]) : 0;
        } catch (\Exception $exc) {

        }
    }

    function TenDonVi() {
        $list = $this->ListDonVi();
        return $list[$this->DonVi];
    }

    function JsonDecode($string) {
        return json_decode($string, JSON_OBJECT_AS_ARRAY);
    }

    function ListDonVi() {
        $DonVi = [1 => "Tỉ", "Triệu"];
        return $DonVi;
    }

    public static function GetList() {
        $p = new ProductNote();
        return $p->ListDonVi();
    }

}
