<?php

namespace Model\ChamSocKhachHang;

class NhanVien {

    static $filename;
    public $id;
    public $name;
    public $phone;
    public $email;
    public $sky;
    public $facebook;

    public function __construct($nhanVien = null) {
        if ($nhanVien) {
            $this->id = isset($nhanVien["id"]) ? $nhanVien["id"] : null;
            $this->name = isset($nhanVien["name"]) ? $nhanVien["name"] : null;
            $this->phone = isset($nhanVien["phone"]) ? $nhanVien["phone"] : null;
            $this->email = isset($nhanVien["email"]) ? $nhanVien["email"] : null;
            $this->sky = isset($nhanVien["sky"]) ? $nhanVien["sky"] : null;
            $this->facebook = isset($nhanVien["facebook"]) ? $nhanVien["facebook"] : null;
        }
    }

    private static function GetPath() {
        return ROOT_DIR . "/data/chamsockhachhang/NhanVien.json";
    }

    static function Save($DataList) {
        $filename = self::GetPath();
        $string = $DataList;
        if (is_array($DataList)) {
            $string = json_encode($DataList, JSON_UNESCAPED_UNICODE);
        }
        $io = new \lib\io();
        if ($string != "") {
            $io->writeFile($filename, $string);
        }
    }

    static function GetToString() {
        $fileName = self::GetPath();
        return file_get_contents($fileName);
    }

    static function GetToArray() {
        $string = self::GetToString();
        return json_decode($string, JSON_OBJECT_AS_ARRAY);
    }

}
