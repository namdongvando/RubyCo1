<?php

class Model_TinhThanh extends Model_Adapter {

    public $MaDiaChi;
    public $TenDiaChi;
    public $TenDiaChiCha;
    public $MaDiaChiCha;
    public $GhiChu;
    public $LinkXemTinhThanh;
    public $LinkXoaTinhThanh;
    static public $LinkQuanTri;
    static public $LinkFormSuaQuanTri;
    static public $LinkFormThemQuanTri;
    static public $LinkThemTinhThanh;
    public $LinkSuaTinhThanh;
    public $LinkSanPhamTheoTinhThanh;
    public $TenKhongDau;
    public $Link;

    function __construct($TinhThanh = NULL) {
        self::$LinkQuanTri = BASE_DIR . "quantritinhthanh/listtinh/";
        self::$LinkFormSuaQuanTri = BASE_DIR . "quantritinhthanh/tinhsua/";
        self::$LinkFormThemQuanTri = BASE_DIR . "quantritinhthanh/tinhthem/";
        self::$LinkThemTinhThanh = BASE_DIR . "quantritinhthanh/tinhthem/";
        if ($TinhThanh) {
            $this->MaDiaChi = $TinhThanh['MaDiaChi'];
            $this->TenDiaChi = $TinhThanh['TenDiaChi'];
            $this->MaDiaChiCha = $TinhThanh['MaDiaChiCha'];
            $this->TenDiaChiCha = $this->TenDiaChiCha($this->MaDiaChiCha);
            $this->GhiChu = $TinhThanh['GhiChu'];
            $this->LinkSuaTinhThanh = BASE_DIR . "quantritinhthanh/tinhsua/" . $this->MaDiaChi;
            $this->LinkXoaTinhThanh = BASE_DIR . "quantritinhthanh/tinhxoa/" . $this->MaDiaChi;
            $this->LinkXemTinhThanh = BASE_DIR . "quantritinhthanh/listhuyen/" . $this->MaDiaChi;
            $this->LinkSanPhamTheoTinhThanh = BASE_DIR . "tinhthanh/" . $this->bodautv($this->TenDiaChi) . "-" . $this->MaDiaChi;
            $this->Link = BASE_DIR . "tinhthanh/" . $this->bodautv($this->TenDiaChi) . "-" . $this->MaDiaChi;
            $this->TenKhongDau = $this->bodautv($this->TenDiaChi) . "-" . $this->MaDiaChi;
        }
        parent::__construct();
    }

    function getLinkThemTinhThanh() {
        return self::$LinkThemTinhThanh;
    }

    function getLinkQuanTri() {
        return self::$LinkQuanTri;
    }

    function getLinkFormSuaQuanTri() {
        return self::$LinkFormSuaQuanTri;
    }

    function getLinkFormThemQuanTri() {
        return self::$LinkFormThemQuanTri;
    }

    function TenDiaChiCha($MaTinh) {
        $Tinh = $this->TimTinhHuyen($MaTinh);
        return $Tinh['TenDiaChi'];
    }

    function ThemTinhThanh($TinhThanh) {
        $sql = "INSERT INTO `" . table_prefix . "tinhthanh` SET "
                . "`TenDiaChi` = '{$TinhThanh['TenDiaChi']}', "
                . "`MaDiaChiCha` = '{$TinhThanh['MaDiaChiCha']}', "
                . "`AnHien` = '1', "
                . "`GhiChu` = '{$TinhThanh['GhiChu']}'";
        $this->Query($sql);
        $this->Luu();
    }

    function SuaTinhThanh($TinhThanh) {
        $sql = "UPDATE `" . table_prefix . "tinhthanh` SET "
                . "`TenDiaChi` = '{$TinhThanh['TenDiaChi']}', "
                . "`MaDiaChiCha` = '{$TinhThanh['MaDiaChiCha']}', "
                . "`AnHien` = '1', "
                . "`GhiChu` = '{$TinhThanh['GhiChu']}' where "
                . "`MaDiaChi` = '{$TinhThanh['MaDiaChi']}'";
        $this->Query($sql);
        $this->Luu();
    }

    function XoaTinhThanh($TinhThanh) {
        $sql = "DELETE FROM `" . table_prefix . "tinhthanh` WHERE `MaDiaChi` = '$TinhThanh'";
        $this->Query($sql);
        $this->Luu();
    }

    function DSTinh() {
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChiCha` = 0 ";
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $kq = $this->fetchAll();
            return $kq;
        } else {
            return FALSE;
        }
    }

    function DSTinhOption() {
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChiCha` = 0 ";
        $this->Query($sql);
        return $this->fetch2Option("MaDiaChi", "TenDiaChi");
    }

    function DSAllTinhAndHuyen() {
        $sql = "select * from `" . table_prefix . "tinhthanh`";
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $kq = $this->fetchAll();
            return $kq;
        } else {
            return FALSE;
        }
    }

    function DanhTinh() {
        $sql = "select * from `" . table_prefix . "tinhthanh` ";
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $kq = $this->fetchAll();
            return $kq;
        } else {
            return FALSE;
        }
    }

    function TimTinhHuyen($MaDiaChi) {
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChi` = '$MaDiaChi'";
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            return $this->fetchRow($kq);
        } else {
            return FALSE;
        }
    }

    function DSHuyenTheoTinh($TinhThanh) {
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChiCha` = '{$TinhThanh}'";
        if($TinhThanh==0){
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChiCha` = '0'";
        }
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $kq = $this->fetchAll();
            return $kq;
        } else {
            return FALSE;
        }
    }

    function ListTinhNoiBat() {
        return "57,32,1,189,146,249,338,394,78";
    }

    function DSTinhNoiBat() {
        $lisTinh = $this->ListTinhNoiBat();
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChi` in ($lisTinh)";
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $kq = $this->fetchAll();
            return $kq;
        } else {
            return FALSE;
        }
    }

    function DSTinh0NoiBat() {
        $lisTinh = $this->ListTinhNoiBat();
        $sql = "select * from `" . table_prefix . "tinhthanh` where `MaDiaChi` not in ($lisTinh) and `MaDiaChiCha` = 0";
        $this->Query($sql);
        $kq = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $kq = $this->fetchAll();
            return $kq;
        } else {
            return FALSE;
        }
    }

    function DSSanPham4TinhThanh($ThuocTinh, $ThuocTinh1) {
        $sql = "SELECT * FROM `" . table_prefix . "sanpham` where `AnHien` = '1' AND (`GhiChu` LIKE '%{$ThuocTinh}%' OR `GhiChu` LIKE '%{$ThuocTinh1}%') order by `DoQuanTrong` DESC ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSSanPham4TinhThanh2DanhMuc($MaDanhMuc, $ThuocTinh, $ThuocTinh1) {
        $DK = "";
        if ($MaDanhMuc != "") {
            $DK = "`MaDanhMuc` = {$MaDanhMuc} and ";
        }
        $sql = "SELECT * FROM `" . table_prefix . "sanpham` where {$DK} `AnHien` = '1'  order by `DoQuanTrong` DESC ";
        if ($ThuocTinh != "") {
            $sql = "SELECT * FROM `" . table_prefix . "sanpham` where {$DK} `AnHien` = '1' AND (`GhiChu` LIKE '%{$ThuocTinh}%' OR `GhiChu` LIKE '%{$ThuocTinh1}%') order by `DoQuanTrong` DESC ";
        }
        $this->Query($sql);
        return $this->fetchAll();
    }

}

?>