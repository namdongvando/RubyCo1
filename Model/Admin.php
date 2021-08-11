<?php

namespace Model;

class Admin extends \Model\Database {

    public $tableName;
    public $Username;
    public $Password;
    public $Random;
    public $Name;
    public $Email;
    public $Phone;
    public $Address;
    public $Note;
    public $Groups;

    function __construct($NhanVien = NULL) {
        if ($NhanVien) {
            $this->Username = isset($NhanVien['Username']) ? $NhanVien['Username'] : '';
            $this->Password = isset($NhanVien['Password']) ? $NhanVien['Password'] : '';
            $this->Random = isset($NhanVien['Random']) ? $NhanVien['Random'] : '';
            $this->Name = isset($NhanVien['Name']) ? $NhanVien['Name'] : '';
            $this->Email = isset($NhanVien['Email']) ? $NhanVien['Email'] : "";
            $this->Phone = isset($NhanVien['Phone']) ? $NhanVien['Phone'] : "";
            $this->Address = isset($NhanVien['Address']) ? $NhanVien['Address'] : "";
            $this->Note = isset($NhanVien['Note']) ? $NhanVien['Note'] : "";
            $this->Groups = isset($NhanVien['Groups']) ? $NhanVien['Groups'] : "";
        }
        $this->tableName = table_prefix . "admin";
        parent::__construct();
    }

    function CheckLogin($Username, $Password, $isobj = true) {
        return parent::CheckLogin($Username, $Password, $isobj);
    }

    static public function UsernameLogin() {
        return new Admin($_SESSION[QuanTri]);
    }

    static public function isLogin() {
        return empty($_SESSION[QuanTri]) ? FALSE : TRUE;
    }

}

?>
