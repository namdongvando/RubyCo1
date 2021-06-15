<?php

namespace Module\DB\Model;

class Duser extends \Model\Admin {

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
        parent::__construct();
    }

    function CheckLogin($Username, $Password, $isobj = true) {
        return parent::CheckLogin($Username, $Password, $isobj);
    }

    function Admins($isobj = true) {
        return parent::Admins($isobj);
    }

    function CreateTable($NameTable, $data) {

        $sql = "DROP TABLE `{$NameTable}`";
        $this->Query($sql);
        $this->Luu();

        $sql = "CREATE TABLE `{$NameTable}` (`Id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,`Name` varchar(200) NOT NULL,";
        $dem = 1;
        $a = count($data);
        foreach ($data as $key => $value) {
            if ($dem < $a)
                $sql .= sprintf("`%s` %s ,", $key, $value);
            else
                $sql .= sprintf("`%s` %s ", $key, $value);
            $dem++;
        }
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $this->Query($sql);
        $this->Luu();
    }

}

?>
