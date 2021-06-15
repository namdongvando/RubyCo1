<?php

class Model_TinTuc extends Model_Pages {

    public $IDTin;
    public $title;
    public $keyword;
    public $description;
    public $MaDanhMuc;
    public $TenDanhMuc;
    public $TieuDe;
    public $TieuDeKhongDau;
    public $TomTat;
    public $NoiDung;
    public $NoiDungSua;
    public $NoiDungHH;
    public $AnHien;
    public $NgayDang;
    public $UrlHinh;
    public $TinNoiBat;
    public $SoLanXem;
    public $Stt;
    public $LinkChiTiet;
    public $LinkFullChiTiet;
    static public $LinkXoaBaiViet;
    static public $LinkSuaBaiViet;
    static public $LinkThemBaiViet;
    public static $_LoaiDanhMuc = 2;

    function __construct($TinTuc = NULL) {
        self::$LinkXoaBaiViet = BASE_DIR . "quantribaiviet/tintucxoa/";
        self::$LinkSuaBaiViet = BASE_DIR . "quantribaiviet/tintucsua/";
        self::$LinkThemBaiViet = BASE_DIR . "quantribaiviet/tintucthem/";

        if ($TinTuc) {
            $this->IDTin = $TinTuc['IdTin'];
            $this->title = $TinTuc['title'];
            $this->keyword = $TinTuc['keyword'];
            $this->description = $TinTuc['description'];
            $this->MaDanhMuc = $TinTuc['MaDanhMuc'];
            $this->TenDanhMuc = $this->LayTenDanhMuc($this->MaDanhMuc);
            $this->TieuDe = $TinTuc['TieuDe'];
            $this->TieuDeKhongDau = $TinTuc['TieuDeKhongDau'];
            $this->TomTat = $TinTuc['TomTat'];
            $this->NoiDungSua = $this->NoiDungTinTuc($TinTuc['NoiDung']);
            $this->NoiDungHH = $this->NoiDungTinTuc($TinTuc['NoiDung']);
            $this->NoiDung = $TinTuc['NoiDung'];
            $this->AnHien = $TinTuc['AnHien'] == 1 ? TRUE : FALSE;
            $this->NgayDang = date("d-m-Y", strtotime($TinTuc['NgayDang']));
            $this->UrlHinh = BASE_DIR . "public/img/images/" . $TinTuc['UrlHinh'];
            $this->TinNoiBat = $TinTuc['TinNoiBat'] == 1 ? TRUE : FALSE;
            $this->SoLanXem = $TinTuc['SoLanXem'];
            $this->Stt = $TinTuc['Stt'];
            $this->LinkChiTiet = BASE_DIR . $this->LayTenDanhMucKD($this->MaDanhMuc) . "/" . $TinTuc['TieuDeKhongDau'] . ".html";
            $this->LinkFullChiTiet = BASE_URL . $this->LayTenDanhMucKD($this->MaDanhMuc) . "/" . $TinTuc['TieuDeKhongDau'] . ".html";
        }
        parent::__construct();
    }

    function getLinkXoaBaiViet() {
        return self::$LinkXoaBaiViet;
    }

    function getLinkSuaBaiViet() {
        return self::$LinkSuaBaiViet;
    }

    function getLinkThemBaiViet() {
        return self::$LinkThemBaiViet;
    }

    function ThemTinTuc($TinTuc) {
        $sql = "INSERT INTO `" . table_prefix. "tin` SET "
                . "`IdTin` = '{$TinTuc['IdTin']}',"
                . "`title` = '{$TinTuc['title']}',"
                . "`keyword` = '{$TinTuc['keyword']}',"
                . "`description` = '{$TinTuc['description']}',"
                . "`MaDanhMuc` = '{$TinTuc['MaDanhMuc']}',"
                . "`TieuDe` = '{$TinTuc['TieuDe']}',"
                . "`TieuDeKhongDau` = '{$TinTuc['TieuDeKhongDau']}',"
                . "`TomTat` = '{$TinTuc['TomTat']}',"
                . "`NoiDung` = '{$TinTuc['NoiDung']}',"
                . "`AnHien` = '{$TinTuc['AnHien']}',"
                . "`NgayDang` = '{$TinTuc['NgayDang']}',"
                . "`UrlHinh` = '{$TinTuc['UrlHinh']}',"
                . "`SoLanXem` = '{$TinTuc['SoLanXem']}', "
                . "`Stt` = '{$TinTuc['Stt']}', "
                . "`TinNoiBat` = '{$TinTuc['TinNoiBat']}'";

        $this->Query($sql);
        return $this->Luu();
    }

    function SuaTinTuc($TinTuc) {
        $sql = "UPDATE `" . table_prefix . "tin` SET "
                . "`title` = '{$TinTuc['title']}',"
                . "`keyword` = '{$TinTuc['keyword']}',"
                . "`description` = '{$TinTuc['description']}',"
                . "`MaDanhMuc` = '{$TinTuc['MaDanhMuc']}',"
                . "`TieuDe` = '{$TinTuc['TieuDe']}',"
                . "`TieuDeKhongDau` = '{$TinTuc['TieuDeKhongDau']}',"
                . "`TomTat` = '{$TinTuc['TomTat']}',"
                . "`NoiDung` = '{$TinTuc['NoiDung']}',"
                . "`AnHien` = '{$TinTuc['AnHien']}',"
                . "`NgayDang` = '{$TinTuc['NgayDang']}',"
                . "`UrlHinh` = '{$TinTuc['UrlHinh']}',"
                . "`SoLanXem` = '{$TinTuc['SoLanXem']}', "
                . "`Stt` = '{$TinTuc['Stt']}', "
                . "`TinNoiBat` = '{$TinTuc['TinNoiBat']}' where "
                . "`IdTin` = '{$TinTuc['IdTin']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function DSTinTucTheoTen($TuKhoa) {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `TieuDe` like '%{$TuKhoa}%' and `MaDanhMuc` > 0";
        $this->Query($sql);
        if ($this->GetNumRow() >= 1) {
            $SanPham = $this->fetchAll();
            return $SanPham;
        }
        return FALSE;
    }

    function DSTinTuc($lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` ORDER BY `Stt` ASC  ";
        $this->Query($sql);

        if ($this->GetNumRow() >= 1) {
            $SanPham = $this->fetchAll();
            return $SanPham;
        }
        return FALSE;
    }

    function TimTinTucCT($MaTin) {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `idTin`= '{$MaTin}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function TimTinTuc($MaTin, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `IdTin`= '{$MaTin}' ";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function TimTieuDeTinTuc($TieuDe, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `TieuDeKhongDau`= '{$TieuDe}' ";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function TimTinTuc4TieuDe($TieuDe) {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `TieuDe` like '%{$TieuDe}%' ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSAllTinTheoLoai($MaLoaiTin) {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}' ORDER BY `Stt` ASC ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTinTheoLoaiNoiBat($MaLoaiTin, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}'  ORDER BY `Stt` ASC Limit 0,5 ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTinTheoLoai($MaLoaiTin, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}'  ORDER BY `Stt` ASC ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function TongDSTinTheoLoai($MaLoaiTin) {
        $sql = "SELECT count(*) as `TongTinTuc` FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}'";
        $this->Query($sql);
        $kq = $this->fetchRow();
        return $kq['TongTinTuc'];
    }

    function DSTinTheoLoaiPT($MaLoaiTin, $lang = 'vi', $Vitri, $SoLuong) {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}' and "
                . "`lang` = '{$lang}' ORDER BY `Stt` ASC LIMIT {$Vitri},{$SoLuong} ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function TongSoTinDangHienTheoLoai($LoaiSanPham, $lang = 'vi') {
        $sql = "SELECT count(*) as `TongSanPham` FROM `" . table_prefix . "tin` where `lang` = '{$lang}' "
                . "and `AnHien` ='1' and `MaDanhMuc` = '{$LoaiSanPham}' ORDER BY `Stt` ASC ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DS5TinMoiNhat($MaLoaiTin, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}'  ORDER BY `Stt` ASC limit 0,5";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTinMoiNhat($SLTin, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` ORDER BY `Stt` ASC limit 0,{$SLTin}";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTinMoiNhat4Loai($SLTin, $Loai) {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc` = '{$Loai}' ORDER BY `Stt` ASC limit 0,{$SLTin}";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DStTopTinMoiNhat($MaLoaiTin, $SLTin, $lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc`= '{$MaLoaiTin}'  ORDER BY `Stt` ASC limit 0,{$SLTin}";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DS5TinNoiBat($SoLuong, $lang = 'vi') {
        $sql = "SELECT `idTin`,`urlHinh`,`TieuDe`,`TomTat`,`NgayDang`,`TieuDeKhongDau` FROM `" . table_prefix . "tin` where `TinNoiBat` = '1'  ORDER BY `Stt` ASC limit 0,{$SoLuong}";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DS10TinNoiBat($sl,$lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin`  limit 0,10";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function XoaTinTuc($idTin) {
        $sql = "DELETE FROM `" . table_prefix . "tin` WHERE `idTin` = '{$idTin}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function AnTinDangDuyet($idTin) {
        echo $sql = "UPDATE `" . table_prefix . "tin_tam` SET "
        . "`AnHien` = '0' where "
        . "`idTin` = '{$idTin}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function LayTinTuDong($TinTuc) {
        $sql = "INSERT INTO `" . table_prefix . "tin_tam` SET "
                . "`lang` = '{$TinTuc['lang']}',"
                . "`MaDanhMuc` = '{$TinTuc['MaDanhMuc']}',"
                . "`urlHinh` = '{$TinTuc['urlHinh']}',"
                . "`TieuDe` = '{$TinTuc['TieuDe']}',"
                . "`TieuDeKhongDau` = '{$TinTuc['TieuDeKhongDau']}',"
                . "`TomTat` = '{$TinTuc['TomTat']}',"
                . "`NoiDung` = '{$TinTuc['NoiDung']}',"
                . "`AnHien` = '{$TinTuc['AnHien']}',"
                . "`NgayDang` = '{$TinTuc['NgayDang']}',"
                . "`SoLanXem` = '{$TinTuc['SoLanXem']}', "
                . "`Link` = '{$TinTuc['Link']}', "
                . "`idTin` = NULL";
        $this->Query($sql);
        return $this->Luu();
    }

    function LayTenDanhMuc($maDanhMuc) {
        $DM = $this->TimPages($maDanhMuc);
        return $DM['TieuDe'];
    }

    function LayTenDanhMucKD($maDanhMuc) {
        $DM = $this->TimPages($maDanhMuc);
        return $DM['TieuDeKD'];
    }

    function TimTinTuDong($idTin) {
        $sql = "SELECT * FROM `" . table_prefix . "tin_tam` where `idTin` = '{$idTin}' and `AnHien` = '1'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function DSTinTuDong() {
        $sql = "SELECT * FROM `" . table_prefix . "tin_tam` where `AnHien` = '1'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTinHot($lang = 'vi') {
        $sql = "SELECT * FROM `" . table_prefix . "tin` where `TinNoiBat` = '1'  ORDER BY `Stt` ASC ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTimTinTuc($keyword, $lang = 'vi') {
        $sql = "SELECT `idTin`,`urlHinh`,`TieuDe`,`TomTat`,`AnHien`,`TinNoiBat`,`NgayDang`,`TieuDeKhongDau` FROM `" . table_prefix . "tin` where `TieuDe` like '%$keyword%'  ORDER BY `Stt` ASC";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSTimTinTucPT($keyword, $vitriHienTai, $soluong = 12, &$TongSanPham) {
        $sql = "SELECT count(*) as `TongSanPham` FROM `" . table_prefix . "tin` where `TieuDe` like '%$keyword%'  ORDER BY `Stt` ASC";
        $this->Query($sql);
        $result = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $SanPham = $this->fetchRow();
            $TongSanPham = $SanPham['TongSanPham'];
        } else {
            $TongSanPham = 0;
        }
        if ($TongSanPham <= 0) {
            return FALSE;
        } else {

            $vitri = ($vitriHienTai - 1) * $soluong;

            $sql = "SELECT `idTin`,`urlHinh`,`TieuDe`,`TomTat`,`AnHien`,`TinNoiBat`,`NgayDang`,`TieuDeKhongDau` "
                    . "FROM `" . table_prefix . "tin` where "
                    . "`TieuDe` like '%$keyword%'  ORDER BY `Stt` ASC limit {$vitri},{$soluong} ";
            $this->Query($sql);
            if ($this->GetNumRow() >= 1) {
                $SanPham = $this->fetchAll();
                return $SanPham;
            }
            return FALSE;
        }
    }

    function DSTinTucLoaiPT($vitri, $soluong = 8, $MaDanhMuc, &$TongSanPham) {
        $TongSanPham = 0;
        $sql = "SELECT count(*) as `TongSanPham` FROM `" . table_prefix . "tin` where `MaDanhMuc` = '{$MaDanhMuc}' ORDER BY `Stt` ASC";
        $this->Query($sql);
        $result = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $SanPham = $this->fetchRow($result);
            $TongSanPham = $SanPham['TongSanPham'];
        }
        if ($TongSanPham == 0) {
            return FALSE;
        } else {
            $sql = "SELECT * FROM `" . table_prefix . "tin` where `MaDanhMuc` = '{$MaDanhMuc}' ORDER BY `Stt` ASC limit {$vitri},{$soluong} ";
            $this->Query($sql);
            if ($this->GetNumRow() >= 1) {
                $SanPham = $this->fetchAll();
                return $SanPham;
            }
            return FALSE;
        }
    }

    function DSTinTucLoaiPT1($vitri, $soluong = 8, $MaDanhMuc, &$TongSanPham) {
        
        $vitri = intval($vitri);
        $vitri = $vitri <= 0 ? 1 : $vitri;
        $vitri = ($vitri - 1) * $soluong;
        
        $TongSanPham = 0;
        $sql = "SELECT count(*) as `TongSanPham` FROM `" . table_prefix . "tin` where `MaDanhMuc` = '{$MaDanhMuc}' ORDER BY `Stt` ASC";
        $this->Query($sql);
        $result = $this->Tim();
        if ($this->GetNumRow() >= 1) {
            $SanPham = $this->fetchRow($result);
            $TongSanPham = $SanPham['TongSanPham'];
        }
        if ($TongSanPham <= 0) {
            return FALSE;
        } else {
            $sql = "SELECT * "
                    . "FROM `" . table_prefix . "tin` where `MaDanhMuc` = '{$MaDanhMuc}' ORDER BY `Stt` ASC limit {$vitri},{$soluong} ";
            $this->Query($sql);
            if ($this->GetNumRow() >= 1) {
                $SanPham = $this->fetchAll();
                return $SanPham;
            }
            return FALSE;
        }
    }

    function NoiDungTinTuc($str) {

        $pattern = "#{Hinh}(.*){/Hinh}#i";
        preg_match($pattern, $str, $m);
        if (count($m) == 0)
            return $str;
        $bd = $m[1];
        if ($bd == "")
            return $str;
        $a = explode("|", $bd);
        if (count($a) == 0)
            return $str;
        $codebando = '<section id="portfolio"><div class="container"><div class="row"><div class="portfolio-items">';
        foreach ($a as $img) {
            $codebando .='<div class="portfolio-item apps col-xs-12 col-sm-4 col-md-3" style="margin-bottom: 10px" >
                            <div class="recent-work-wrap">
                             <a class="preview" href="' . $img . '" rel="prettyPhoto">
                                <img class="img-responsive" src="' . $img . '" alt="Su Kiệm"/>
                               </a>
                            </div>
                        </div>';
        }
        $codebando .= '</div></div></div></section>';


        $str = preg_replace($pattern, $codebando, $str);
        return $str;
    }

}

?>
