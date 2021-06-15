<?php

class Model_Option extends Model_Adapter {

    public $MaOption;
    public $GiaTri;
    public $LoaiOption;
    public $GhiChu;
    public $Title;
    public $DanhMucMacDinh;

    function __construct($option = NULL) {
        if ($option) {
            $this->MaOption = $option["MaOption"];
            $this->LoaiOption = $option["LoaiOption"];
            $this->GiaTri = $this->LoaiOption == 1 ? BASE_DIR . "public/img/images/" . $option["GiaTriVN"] : $option["GiaTriVN"];
            $this->GhiChu = $this->_decode($option['GhiChu']);
            $this->Title = isset($this->GhiChu->title) ? $this->GhiChu->title : '';
        }
        parent::__construct();
    }

    function TimOption($MaOption) {
        $sql = "SELECT * FROM `" . table_prefix . "option` where `MaOption` = '{$MaOption}'";
        $this->Query($sql);
        $KQ = $this->Tim();
        return $this->fetchRow($KQ);
    }

    function SuaOptionGhiChu($Option) {
        $sql = "UPDATE `" . table_prefix . "option` SET "
                . "`GhiChu` = '{$Option['GhiChu']}' WHERE "
                . "`MaOption` = '{$Option['MaOption']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function DSOption() {
        $sql = "SELECT * FROM `" . table_prefix . "option` ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSOption4LoaiOption($LoaiOption) {
        $sql = "SELECT * FROM `" . table_prefix . "option` where `LoaiOption` = '{$LoaiOption}'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSOptionTheoTem($TuKhoa) {
        $sql = "SELECT * FROM `" . table_prefix . "option` where `MaOption` like '%{$TuKhoa}%'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function SuaOption($Option) {
        $sql = "UPDATE `" . table_prefix . "option` SET "
                . "`GiaTriVN` = '{$Option['GiaTriVN']}',"
                . "`LoaiOption` = '{$Option['LoaiOption']}',"
                . "`GhiChu` = '{$Option['GhiChu']}',"
                . "`GiaTriEN` = '{$Option['GiaTriEN']}' WHERE "
                . "`MaOption` = '{$Option['MaOption']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function XoaOption($Option) {
        $sql = "DELETE FROM `" . table_prefix . "option` WHERE `MaOption` = '{$Option}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function ThemOption($Option) {
        $sql = "INSERT INTO `" . table_prefix . "option` SET "
                . "`GiaTriVN` = '',"
                . "`LoaiOption` = '{$Option['LoaiOption']}',"
                . "`GiaTriEN` = '',"
                . "`MaOption` = '{$Option['MaOption']}',"
                . "`GhiChu` = '{$Option['GhiChu']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function ThemOptionFull($Option) {
        $sql = "INSERT INTO `" . table_prefix . "option` SET "
                . "`GiaTriVN` = '{$Option['GiaTriVN']}' ,"
                . "`LoaiOption` = '{$Option['LoaiOption']}',"
                . "`GiaTriEN` = '{$Option['GiaTriEN']}',"
                . "`MaOption` = '{$Option['MaOption']}',"
                . "`GhiChu` = '{$Option['GhiChu']}'";

        $this->Query($sql);
        return $this->Luu();
    }

    function ThemTuDien($TuVung) {
        $sql = "INSERT INTO `" . table_prefix . "lang` SET `MaText` = '{$TuVung['MaText']}', "
                . "`GiaTriVI` = '{$TuVung['GiaTriVI']}',"
                . " `GiaTriEN` = '{$TuVung['GiaTriEN']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function DSTuVung() {
        $sql = "SELECT * FROM `" . table_prefix . "lang`";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function SuaTuVung($TuVung) {
        $sql = "UPDATE `" . table_prefix . "lang` SET "
                . "`GiaTriVI` = '{$TuVung['GiaTriVI']}',"
                . "`GiaTriEN` = '{$TuVung['GiaTriEN']}' where "
                . "`MaText` = '{$TuVung['MaText']}'";
//      UPDATE `pgexpress`.`pgv_lang` SET `GiaTriVI` = 'a',
//`GiaTriEN` = 'a' WHERE `pgv_lang`.`MaText` = 'TaiKhoan';

        $this->Query($sql);
        return $this->Luu();
    }

    function XoaTuVung($TuVung) {
        $sql = "DELETE FROM `" . table_prefix . "lang` WHERE `MaText` = '{$TuVung}'";
//      UPDATE `pgexpress`.`pgv_lang` SET `GiaTriVI` = 'a',
//`GiaTriEN` = 'a' WHERE `pgv_lang`.`MaText` = 'TaiKhoan';
        $this->Query($sql);
        return $this->Luu();
    }

    function DSLoaiOption() {
        return array(1 => "Hình Ảnh", "Ngôn Ngữ", "SEO");
    }

    function DSTienToOption() {
        return array(1 => "Option_", "Lang_", "SEO_");
    }

    function DSOption4TienTo($TienTo) {
        $sql = "SELECT * FROM `" . table_prefix . "option` where `MaOption` like '%{$TienTo}%'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function getTienToOption($id) {
        $a = $this->DSTienToOption();
        return $a[$id];
    }

    function getLoaiOption($id) {
        $a = $this->DSLoaiOption();
        return $a[$id];
    }

    function DanhMucMacDinh() {
        $kq = $this->TimOption("Lang_defautcat");
        if ($kq) {
            return intval($kq["GiaTriVN"]);
        } else {
            $Model_DanhMuc = new Model_DanhMuc();
            $DSDanhMuc = $Model_DanhMuc->DSDanhMuc();
            return $DSDanhMuc[0]['TenKhongDau'];
        }
    }

}

?>