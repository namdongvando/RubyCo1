<?php

class Model_DanhMuc extends Model_TinhThanh
{

    public $MaDanhMuc;
    public $TenDanhMuc;
    public $NoiDung;
    public $NoiDungHH;
    public $CapCha;
    public $UrlHinh;
    public $Title;
    public $Des;
    public $keywords;
    public $STT;
    public $LoaiDanhMuc;
    public $TenKhongDau;
    public $ThuocTinh;
    public $CapCon;
    public $LinkDanhMuc;
    public $LinkSuaDanhMuc;
    public $LinkThemDanhMuc;
    public $LinkXoaDanhMuc;
    public $LinkListDanhMuc;
    public $LinkDanhMucTinhThanh;
    public $ViewDanhMuc;
    public $DanhMucLienQuan1;
    public $DanhMucLienQuan2;
    public static $DanhMucTinTuc = 1;
    public static $DanhMucSanPham = 2;

    function __construct($DanhMuc = NULL)
    {

        if ($DanhMuc) {
            $_TinTuc = new Model_TinTuc();
            $this->MaDanhMuc = $DanhMuc['MaDanhMuc'];
            $this->TenDanhMuc = $DanhMuc['TenDanhMuc'];
            $this->NoiDung = $DanhMuc['NoiDung'];
            $this->NoiDungHH = $_TinTuc->NoiDungTinTuc($DanhMuc['NoiDung']);
            $this->CapCha = $DanhMuc['CapCha'];
            $this->UrlHinh = BASE_DIR . "public/img/images/" . $DanhMuc['UrlHinh'];
            $this->STT = $DanhMuc['STT'];
            $this->LoaiDanhMuc = $DanhMuc['LoaiDanhMuc'];
            $this->TenKhongDau = $DanhMuc['TenKhongDau'];
            $this->ThuocTinh = json_decode($DanhMuc['ThuocTinh']);
            $this->Title = $this->TenDanhMuc;
            $this->keywords = $this->TenDanhMuc;
            $this->Des = $this->TenDanhMuc;
            $this->CapCon = isset($DanhMuc['CapCon']) ? $DanhMuc['CapCon'] : FALSE;
            $this->LinkDanhMuc = BASE_DIR . $this->TenKhongDau . "/";
            $this->LinkSuaDanhMuc = BASE_DIR . "quantridanhmuc/danhmucsua/" . $this->MaDanhMuc;
            $this->LinkXoaDanhMuc = BASE_DIR . "quantridanhmuc/danhmucxoa/" . $this->MaDanhMuc;
            $this->LinkThemDanhMuc = BASE_DIR . "quantridanhmuc/danhmucthem/" . $this->MaDanhMuc;
            $this->LinkListDanhMuc = BASE_DIR . "quantridanhmuc/index/";
            $this->ViewDanhMuc = isset($this->ThuocTinh->DanhMucView) ? $this->ThuocTinh->DanhMucView : 'index';
            $this->DanhMucLienQuan1 = isset($this->ThuocTinh->DanhMucLienQuan1) ? $this->ThuocTinh->DanhMucLienQuan1 : 256;
            $this->DanhMucLienQuan2 = isset($this->ThuocTinh->DanhMucLienQuan2) ? $this->ThuocTinh->DanhMucLienQuan2 : 257;
        }

        parent::__construct();
    }

    public static function DanhMucs($CapCha = 0)
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `CapCha` = '{$CapCha}' ORDER BY `STT` ASC";
        $t = new Model_DanhMuc();
        $t->Query($sql);
        return $t->fetchAll();
    }

    function LoaiDanhMucTinTuc()
    {
        return self::$DanhMucTinTuc;
    }

    public static function DanhMucTinTuc()
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `LoaiDanhMuc` = '{$this->LoaiDanhMuc}' ORDER BY `STT` ASC";
        $t = new Model_DanhMuc();
        $t->Query($sql);
        $t->Query($sql);
        return $t->fetchAll();
    }

    function TenCapCha($MaDanhMuc)
    {
        $DM = $this->TimDanhCha($MaDanhMuc);
        if ($DM) {
            return $DM['TenDanhMuc'];
        } else {
            return "Là Danh Mục Cha";
        }
    }

    function TongDanhMucCon($MaDanhMuc)
    {
        $DSDM = $this->DSDanhMuc($MaDanhMuc);
        if ($DSDM) {
            return count($DSDM);
        } else {
            return 0;
        }
    }

    function DanhMuc($DanhMuc)
    {
        $this->MaDanhMuc = $DanhMuc['MaDanhMuc'];
        $this->TenDanhMuc = $DanhMuc['TenDanhMuc'];
        $this->NoiDung = $DanhMuc['NoiDung'];
        $this->CapCha = $DanhMuc['CapCha'];
        $this->UrlHinh = BASE_DIR . "public/img/images/" . $DanhMuc['UrlHinh'];
        $this->STT = $DanhMuc['STT'];
        $this->LoaiDanhMuc = $DanhMuc['LoaiDanhMuc'];
        $this->TenKhongDau = $DanhMuc['TenKhongDau'];
        $this->ThuocTinh = json_decode($DanhMuc['ThuocTinh']);
    }

    function DSDanhMuc($maDanhMuc = 0)
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `CapCha` = '{$maDanhMuc}' ORDER BY `STT` ASC";
        $kq = $this->Query($sql);
        return $this->fetchAll();
    }

    function DSDanhMuc4ThuocTinh($key)
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `ThuocTinh` like '%{$key}%' ORDER BY `STT` ASC";
        $kq = $this->Query($sql);
        return $this->fetchAll();
    }

    function TimDanhCha($maDanhMuc)
    {
        $maDanhMuc = intval($maDanhMuc);
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `MaDanhMuc` = '{$maDanhMuc}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function ChiTietDM($maDanhMuc)
    {
        $maDanhMuc = intval($maDanhMuc);
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `MaDanhMuc` = '{$maDanhMuc}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function TimDanhMucTieuDe($TieuDeKD)
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `TenKhongDau` = '{$TieuDeKD}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function DSSanPhamDanhMuc($MaDanhMuc)
    {
        $sql = "SELECT a.`MaSanPham`, a.`ChuSanPham`, a.`MaDanhMuc`, a.`TenSanPham`, a.`Gia`, a.`MoTa`, a.`UrlHinh`, a.`NgayDang`, a.`SoLanXem`,b.`MaDanhMuc`,b.`TenDanhMuc` FROM `" . table_prefix . "sanpham` as a,`" . table_prefix . "danhmuc` as b WHERE b.`MaDanhMuc` = '{$MaDanhMuc["MaDanhMuc"]}' and a.`MaDanhMuc`=b.`MaDanhMuc` and a.`ChuSanPham` ='{$MaDanhMuc["ChuSanPham"]}'  limit 0,6";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function SuaDanhMuc($DanhMuc)
    {
        $sql = "UPDATE `" . table_prefix . "danhmuc` SET "
            . "`TenDanhMuc` = '{$DanhMuc['TenDanhMuc']}',"
            . "`ThuocTinh` = '{$DanhMuc['ThuocTinh']}',"
            . "`LoaiDanhMuc` = '{$DanhMuc['LoaiDanhMuc']}',"
            . "`TenKhongDau` = '{$DanhMuc['TenKhongDau']}',"
            . "`UrlHinh` = '{$DanhMuc['UrlHinh']}',"
            . "`NoiDung` = '{$DanhMuc['NoiDung']}',"
            . "`STT` = '{$DanhMuc['STT']}',"
            . "`CapCha` = '{$DanhMuc['CapCha']}' where "
            . "`MaDanhMuc` = '{$DanhMuc['MaDanhMuc']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function SuaTTDanhMuc($MaDanhMuc, $Key, $value)
    {
        $DanhMucChon = $this->DanhMuc->TimDanhCha($MaDanhMuc);
        $TTDanhMuc = json_decode($DanhMucChon['ThuocTinh']);
        foreach ($TTDanhMuc as $key => $value) {
            $ThuocTinh[$key] = $value;
        }
        $ThuocTinh['menufooter'] = $ThuocTinh['menufooter'] == 1 ? 0 : 1;
        $ThuocTinh = json_encode($ThuocTinh);

        $sql = "UPDATE `" . table_prefix . "danhmuc` SET `ThuocTinh` = '{$ThuocTinh}'  WHERE `MaDanhMuc` = '{$MaDanhMuc}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function ThemDanhMuc($DanhMuc)
    {
        $sql = "INSERT INTO `" . table_prefix . "danhmuc` SET "
            . "`TenDanhMuc` = '{$DanhMuc['TenDanhMuc']}',"
            . "`ThuocTinh` = '{$DanhMuc['ThuocTinh']}',"
            . "`LoaiDanhMuc` = '{$DanhMuc['LoaiDanhMuc']}',"
            . "`TenKhongDau` = '{$DanhMuc['TenKhongDau']}',"
            . "`CapCha` = '{$DanhMuc['CapCha']}',"
            . "`UrlHinh` = '{$DanhMuc['UrlHinh']}',"
            . "`NoiDung` = '{$DanhMuc['NoiDung']}',"
            . "`STT` = '{$DanhMuc['STT']}'";

        $this->Query($sql);
        return $this->Luu();
    }

    function XoaDanhMuc($DanhMuc, $Quyen = FALSE)
    {
        $DanhMuc = $DanhMuc['MaDanhMuc'];
        if ($Quyen) {
            $DSDanhMucCon = $this->DSDanhMuc($DanhMuc);
            if (!$DSDanhMucCon) {
                $Model_TinTuc = new Model_TinTuc();
                $DSTinLoai = $Model_TinTuc->TongDSTinTheoLoai($DanhMuc);
                $kt = $DSTinLoai == FALSE ? 1 : 0;
                $Model_SanPham = new Model_SanPham();
                $DSSanPham = $Model_SanPham->DSSanPhamLoai($DanhMuc);
                $kt = $DSSanPham == FALSE ? 1 : 0;
                if ($kt == 1) {
                    $sql = "DELETE FROM `" . table_prefix . "danhmuc` WHERE `MaDanhMuc` = '{$DanhMuc}'";
                    $this->Query($sql);
                    return $this->Luu();
                }
            }
        }
        return FALSE;
    }

    function DSDMRaoVat()
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc`";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSDanhMucTheoLoai($LoaiDM)
    {
        $sql = "SELECT * FROM `" . table_prefix . "danhmuc` where `LoaiDanhMuc` = '{$LoaiDM}'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function LayDanhMucLoai($LoaiDM = 1)
    {
        $DSDanhMuc = $this->DSDanhMucTheoLoai($LoaiDM);
        if ($DSDanhMuc) {
            foreach ($DSDanhMuc as $k => $v) {
                $this->DanhMuc($v);
                $DMCon = $this->DSDanhMuc($this->MaDanhMuc);
                if ($DMCon) {
                    $DSDanhMuc[$k]['CapCon'] = $DMCon;
                }
            }
            return $DSDanhMuc;
        }
        return FALSE;
    }

    function LayDanhMucTinTuc()
    {
        $LoaiDM = self::$DanhMucTinTuc;
        $DSDanhMuc = $this->DSDanhMucTheoLoai($LoaiDM);
        if ($DSDanhMuc) {
            foreach ($DSDanhMuc as $k => $v) {
                $this->DanhMuc($v);
                $DMCon = $this->DSDanhMuc($this->MaDanhMuc);
                if ($DMCon) {
                    $DSDanhMuc[$k]['CapCon'] = $DMCon;
                }
            }
            return $DSDanhMuc;
        }
        return FALSE;
    }

    function LayDanhMucSanPham()
    {
        $LoaiDM = self::$DanhMucSanPham;
        $DSDanhMuc = $this->DSDanhMucTheoLoai($LoaiDM);
        if ($DSDanhMuc) {
            foreach ($DSDanhMuc as $k => $v) {
                $this->DanhMuc($v);
                $DMCon = $this->DSDanhMuc($this->MaDanhMuc);
                if ($DMCon) {
                    $DSDanhMuc[$k]['CapCon'] = $DMCon;
                }
            }
            return $DSDanhMuc;
        }
        return FALSE;
    }

    function LayDangMucGoc($MaDanhMuc)
    {
        $DanhMucCanTim = "";
        $danhmuccon = $this->TimDanhCha($MaDanhMuc);
        while ($danhmuccon['CapCha']) {
            $danhmuccon = $this->TimDanhCha($MaDanhMuc);
        }
    }

    function LayDanhMucDeQuy($maDanhMuc = "NULL", &$DSDanhMuc = array())
    {
        if ($maDanhMuc != "NULL") {
            foreach ($DSDanhMuc as $k => $DanhMuc) {
                if ($DanhMuc['MaDanhMuc'] == $maDanhMuc) {
                    $DSDanhMuc[$k]['CapCon'] = $this->DSDanhMuc($maDanhMuc);
                    if ($DSDanhMuc[$k]['CapCon']) {
                        foreach ($DSDanhMuc[$k]['CapCon'] as $DanhMucCon) {
                            $DSDanhconTim = $this->DSDanhMuc($DanhMucCon['MaDanhMuc']);
                            if ($DSDanhconTim) {
                                $this->LayDanhMucDeQuy($DanhMucCon['MaDanhMuc'], $DSDanhMuc[$k]['CapCon']);
                            }
                        }
                    } else {
                        unset($DSDanhMuc[$k]['CapCon']);
                    }
                }
            }
        } else {
            $DSDanhMucTim = $this->DSDanhMuc($maDanhMuc);
            if ($DSDanhMucTim) {
                foreach ($DSDanhMucTim as $DanhMuc) {
                    $DSDanhcon1 = $this->DSDanhMuc($DanhMuc['MaDanhMuc']);
                    $DSDanhMuc[] = $DanhMuc;
                    if ($DSDanhcon1) {
                        $DanhMuc['MaDanhMuc'];
                        foreach ($DSDanhcon1 as $DanhMucCon1) {
                            $DanhMuc['CapCon'][] = $DanhMucCon1;
                            $this->LayDanhMucDeQuy($DanhMuc['MaDanhMuc'], $DSDanhMuc);
                        }
                    }
                }
            }
            return $DSDanhMuc;
        }
    }

    function TaoTenKhongDau($TenDanhMuc)
    {
        return strtolower(bodautv($TenDanhMuc));
    }

    function getLinkDanhMucTinhThanh($KhuVuc)
    {
        $TenDm = $this->TenKhongDau;
        if ($this->TenKhongDau == NULL) {
            $TenDm = "all";
        }
        return BASE_DIR . "sangquan/" . $TenDm . "/" . $KhuVuc;
    }

    function export()
    {
        $ex = new Model_excell_docexcelldanhmuc();
        return $ex->index();
    }

    function import($file)
    {
        $ex = new Model_excell_docexcelldanhmuc();
        return $ex->import($file);
    }
}
