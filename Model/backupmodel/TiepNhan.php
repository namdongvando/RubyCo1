<?php

class Model_TiepNhan extends Model_Adapter {

    public $Id;
    public $FullName;
    public $Phone;
    public $Email;
    public $Sex;
    public $Birthday;
    public $Job;
    public $Service;
    public $Address;
    public $Note;
    public $Status;
    public $IdBV;
    public $SoNha;
    public $Duong;
    public $Xa;
    public $LoaiHinhKham;
    public $Huyen;
    public $Tinh;
    public $createdate;

    function __construct() {

        parent::__construct();
    }

    function SuaTiepNhan($Param) {
        $Sql = "UPDATE `" . table_prefix . "tiepnhan` SET "
                . "`FullName` = '{$Param["FullName"]}', "
                . "`Phone` = '{$Param["Phone"]}', "
                . "`Email` = '{$Param["Email"]}', "
                . "`Sex` = '{$Param["Sex"]}', "
                . "`Job` = '{$Param["Job"]}', "
                . "`Birthday` = '{$Param["Birthday"]}', "
                . "`Service` = '{$Param["Service"]}', "
                . "`Address` = '{$Param["Address"]}', "
                . "`SoNha` = '{$Param["SoNha"]}', "
                . "`Duong` = '{$Param["Duong"]}', "
                . "`Xa` = '{$Param["Xa"]}', "
                . "`Huyen` = '{$Param["Huyen"]}', "
                . "`Tinh` = '{$Param["Tinh"]}', "
                . "`LoaiHinhKham` = '{$Param["LoaiHinhKham"]}', "
                . "`TrieuChung` = '{$Param["TrieuChung"]}', "
                . "`Note` = '{$Param["Note"]}', "
                . "`createdate` = '" . date("Y-m-d H:i:s") . "', "
                . "`IdBV` = '{$Param["IdBV"]}', "
                . "`Status` = '{$Param["Status"]}' WHERE "
                . "`Id` = {$Param["Id"]}";
        $this->Query($Sql);
        return $this->Luu();
    }

    function ThemTiepNhan($Param) {
        $Sql = "INSERT INTO `" . table_prefix . "tiepnhan` SET "
                . "`FullName` = '{$Param["FullName"]}', "
                . "`Phone` = '{$Param["Phone"]}', "
                . "`Email` = '{$Param["Email"]}', "
                . "`Sex` = '{$Param["Sex"]}', "
                . "`Job` = '{$Param["Job"]}', "
                . "`Birthday` = '{$Param["Birthday"]}', "
                . "`Service` = '{$Param["Service"]}', "
                . "`Address` = '{$Param["Address"]}', "
                . "`SoNha` = '{$Param["SoNha"]}', "
                . "`Duong` = '{$Param["Duong"]}', "
                . "`Xa` = '{$Param["Xa"]}', "
                . "`Huyen` = '{$Param["Huyen"]}', "
                . "`Tinh` = '{$Param["Tinh"]}', "
                . "`LoaiHinhKham` = '{$Param["LoaiHinhKham"]}', "
                . "`TrieuChung` = '{$Param["TrieuChung"]}', "
                . "`Note` = '{$Param["Note"]}', "
                . "`IdBV` = '{$Param["IdBV"]}', "
                . "`createdate` = '" . date("Y-m-d H:i:s") . "', "
                . "`Status` = '{$Param["Status"]}'";
        $this->Query($Sql);
        return $this->Luu();
    }

    function getTiepNhan() {
        $Sql = "SELECT * FROM `" . table_prefix . "tiepnhan`";
        $this->Query($Sql);
        return $this->fetchRow();
    }

    function getTiepNhanById($Id) {
        $Sql = "SELECT * FROM `" . table_prefix . "tiepnhan` WHERE `Id` = '{$Id}'";
        $this->Query($Sql);
        return $this->fetchRow();
    }

    function getTiepNhanByIdBV($Id) {
        $Sql = "SELECT * FROM `" . table_prefix . "tiepnhan` WHERE `IdBV` = '{$Id}'";
        $this->Query($Sql);
        return $this->fetchAll();
    }

    function getTiepNhanByIdBVAndDate($Id, $date) {
        $Sql = "SELECT * FROM `" . table_prefix . "tiepnhan` WHERE `createdate` like '{$date}%' and `Status` = 0 order by `Status` DESC ";
        $this->Query($Sql);
        return $this->fetchAll();
    }

    function getTiepNhanByIdBVAndDateAndStatus($Id, $date, $status) {
        $Sql = "SELECT * FROM `" . table_prefix . "tiepnhan` WHERE `IdBV` = '{$Id}' and `createdate` like '{$date}%' and `Status` = '{$status}'";
        $this->Query($Sql);
        return $this->fetchAll();
    }

    function GetStructTiepNhan() {
        $Sql = "DESCRIBE `" . table_prefix . "tiepnhan`";
        $this->Query($Sql);
        return $this->fetchAll();
    }

}
