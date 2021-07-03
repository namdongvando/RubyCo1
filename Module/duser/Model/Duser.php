<?php

namespace Module\duser\Model;

class Duser extends \Model\Admin {

    public static $TableName = table_prefix . "admin";
    public static $CodeAdmin = 1;
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

    public function CreatePassword($pass, $random) {
        return sha1($pass . $random);
    }

    function Admins($isobj = true) {
        return parent::Admins($isobj);
    }

    static function CurentUsernameAdmin($isobj = true) {
        if ($isobj)
            return new \Module\duser\Model\Duser($_SESSION[QuanTri]);
        return $_SESSION[QuanTri];
    }

    public function CreateUser($user) {
        $sql = sprintf("INSERT INTO `" . table_prefix . "admin`"
                . "(`Username`, `Password`, `Random`, `Name`, `Email`, `Phone`, `Address`, `Note`, `Groups`, `Urlimages`) VALUES"
                . " ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $user["Username"], $user["Password"], $user["Random"], $user["Name"], $user["Email"], $user["Phone"], $user["Address"], $user["Note"], $user["Groups"], $user["Urlimages"]
        );
        $this->Query($sql);
        return $this->SaveInsert();
    }

    function DeleteOnsubmit($id) {
        $where = sprintf("`Username` = '%s'", $id);
        $this->Query($sql);
        return $this->delete(self::$TableName, $where);
    }

    public function MapArray($POST) {

    }

    public function UpdateInfor($username) {
        $sql = sprintf("UPDATE `" . table_prefix . "admin` SET "
                . "`Name` = '%s', "
                . "`Email` = '%s', "
                . "`Phone` = '%s', "
                . "`Address` = '%s', "
                . "`Note` = '%s', "
                . "`Groups` = '%s', "
                . "`Urlimages` = '%s' WHERE `Username` = '%s'", $username["Name"]
                , $username["Email"]
                , $username["Phone"]
                , $username["Address"]
                , $username["Note"]
                , $username["Groups"]
                , $username["Urlimages"]
                , $username["Username"]
        );
        $this->Query($sql);
        return $this->SaveInsert();
    }

    public static function SetUsernameAdmin($username) {
        $_SESSION[QuanTri] = $username;
    }

    public function UpdatePassword($username) {
        return $this->update(table_prefix . "admin", $username, "`Username` = '{$username["Username"]}'");
    }

    public function ThemUser($user) {
        $user["Urlimages"] = isset($user["Urlimages"]) ? $user["Urlimages"] : "";
        return $this->insert(self::$TableName, $user);
    }

    public function GetByUsername($Username) {
        $users = $this->select(self::$TableName, null, "`Username` = '{$Username}'");
        if ($users) {
            return $users[0];
        }
        return NULL;
    }

    public function AdminsPT($name, $index, $number, $tong) {

    }

}

?>
