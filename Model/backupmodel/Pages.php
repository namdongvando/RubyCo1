<?php

class Model_Pages extends Model_Adapter {

    public $Pagesid;
    public $Pagesgroup;
    public $TieuDe;
    public $TieuDeKD;
    public $Title;
    public $Des;
    public $Keyword;
    public $TomTat;
    public $NoiDung;
    public $LoaiPage;
    public $TenLoaiPage;
    public $UrlHinh;
    public $NgayDang;
    public $AnHien;
    public $LinkPages;
    static public $LinkDSBVPages;
    static public $LinkThemPages;
    static public $LinkXoaPages;
    static public $LinkSuaPages;
    static public $LinkDSPages;

    function __construct($Pages = NULL) {
        self::$LinkDSBVPages = BASE_DIR . "quantribaiviet/tintuc/";
        self::$LinkThemPages = BASE_DIR . "quantripages/pagesthem/";
        self::$LinkXoaPages = BASE_DIR . "quantripages/pagesxoa/";
        self::$LinkSuaPages = BASE_DIR . "quantripages/pagessua/";
        self::$LinkDSPages = BASE_DIR . "quantripages/pages/";

        if ($Pages) {
            $this->Pagesid = $Pages['idPa'];
            $this->Pagesgroup = $Pages['idGroup'];
            $this->TieuDe = $Pages['TieuDe'];
            $this->TieuDeKD = $Pages['TieuDeKD'];
            $this->Title = $Pages['Title'];
            $this->Des = $Pages['Des'];
            $this->LoaiPage = $Pages['LoaiPage'];
            $this->TenLoaiPage = $Pages['LoaiPage'] == 1 ? "Loại Bài Viết" : "Bài Viết";
            $this->Keyword = $Pages['Keyword'];
            $this->TomTat = $Pages['TomTat'];
            $this->NoiDung = $Pages['NoiDung'];
            $this->UrlHinh = BASE_DIR . "public/img/images/" . $Pages['UrlHinh'];
            $this->LinkPages = $this->LinkPages();
            $this->AnHien = $Pages['AnHien'];
        }
        parent::__construct();
    }

    function LinkPages() {
        if ($this->LoaiPage == 1) {
            return BASE_DIR . $this->TieuDeKD . "/";
        } else {
            return BASE_DIR . $this->TieuDeKD . ".html";
        }
    }

    function getLinkDSBVPages() {
        return self::$LinkDSBVPages;
    }

    function getLinkThemPages() {
        return self::$LinkThemPages;
    }

    function getLinkXoaPages() {
        return self::$LinkXoaPages;
    }

    function getLinkSuaPages() {
        return self::$LinkSuaPages;
    }

    function getLinkDSPages() {
        return self::$LinkDSPages;
    }

    function DSPages() {
        $sql = "SELECT * FROM `" . table_prefix . "pages` ORDER BY `idPa` ASC";
        $this->Query($sql);
        return $this->fetchAll();
    }
    function DSPagesOp() {
        $sql = "SELECT * FROM `" . table_prefix . "pages` ORDER BY `idPa` ASC";
        $this->Query($sql);
        return $this->fetch2Option("idPa","TieuDe");
    }

    function DSPages4LoaiPage($Loai) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` where `LoaiPage` = '{$Loai}' ORDER BY `idPa` ASC";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSPages4idGroup($idGroup) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` where `idGroup` = '{$idGroup}' ORDER BY `idPa` ASC";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function TimPages($idPa) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` where `idPa` = '{$idPa}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function TimPages4TieuDeKD($idPa) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` where `TieuDeKD` = '{$idPa}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function GetIDPagesTieuDe($TieuDe) {
        $sql = "SELECT `idPa` FROM `" . table_prefix . "pages` where `TieuDeKD` = '{$TieuDe}'";
        $this->Query($sql);
        $kq = $this->fetchRow();
        return $kq['idPa'];
    }

    function XoaPages($idPages, $Quyen = FALSE) {
        if ($Quyen) {
            $sql = "DELETE FROM `" . table_prefix . "pages` WHERE `idPa` = {$idPages}";
            $this->Query($sql);
            return $this->Luu();
        }
        return $Quyen;
    }

    function ThemPages($Pages) {
        $Pages['TieuDeKD'] = $this->bodautv(strtolower(trim($Pages['TieuDe'])));
        $sql = "INSERT INTO `" . table_prefix . "pages` "
                . "(`idPa`, `LoaiPage`, `idGroup`, `TieuDe`, `TieuDeKD`, `Title`, `Des`, `Keyword`, `TomTat`, `NoiDung`, `UrlHinh`, `AnHien`)"
                . " VALUES (NULL,"
                . " '{$Pages['LoaiPage']}',"
                . " '{$Pages['idGroup']}',"
                . " '{$Pages['TieuDe']}',"
                . " '{$Pages['TieuDeKD']}',"
                . " '{$Pages['Title']}',"
                . " '{$Pages['Des']}',"
                . " '{$Pages['Keyword']}',"
                . " '{$Pages['TomTat']}',"
                . " '{$Pages['NoiDung']}',"
                . " '{$Pages['UrlHinh']}',"
                . " '1')";
        $this->Query($sql);
        return $this->Luu();
    }

    function SuaPages($Pages) {
        $Pages['TieuDeKD'] = $this->bodautv(strtolower(trim($Pages['TieuDe'])));
        $sql = "UPDATE `" . table_prefix . "pages` SET "
                . "`TieuDe` = '{$Pages['TieuDe']}', "
                . "`LoaiPage` = '{$Pages['LoaiPage']}', "
                . "`TieuDeKD` = '{$Pages['TieuDeKD']}', "
                . "`idGroup` = '{$Pages['idGroup']}', "
                . "`Des` = '{$Pages['Des']}', "
                . "`Title` = '{$Pages['Title']}', "
                . "`Keyword` = '{$Pages['Keyword']}', "
                . "`TomTat` = '{$Pages['TomTat']}', "
                . "`NoiDung` = '{$Pages['NoiDung']}', "
                . "`UrlHinh` = '{$Pages['UrlHinh']}', "
                . "`AnHien` = '{$Pages['AnHien']}' "
                . "WHERE `idPa` = '{$Pages['idPa']}'";
        $this->Query($sql);
        return $this->Luu();
    }

}

?>