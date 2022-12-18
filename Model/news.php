<?php

namespace Model;

class news extends \Model\Database
{

    public
        $ID,
        $PageID,
        $Name,
        $Alias,
        $RedirectLink,
        $Summary,
        $Content,
        $title,
        $keyword,
        $description,
        $AnHien,
        $NgayDang,
        $UrlHinh,
        $TinNoiBat,
        $SoLanXem,
        $Stt;
    private $TableName;

    function __construct($menu = null)
    {

        parent::__construct();
        $this->TableName = table_prefix . "news";
        if ($menu) {
            if (!is_array($menu)) {
                $menu = $this->NewsById($menu, FALSE);
            }
        }

        $this->ID = $menu['ID'] ?? null;
        $this->PageID = $menu['PageID'] ?? null;
        $this->RedirectLink = $menu['RedirectLink'] ?? null;
        $this->Name = $menu['Name'] ?? null;
        $this->Alias = $menu['Alias'] ?? null;
        $this->Summary = $menu['Summary'] ?? null;
        $this->Content = $menu['Content'] ?? null;
        $this->title = $menu['title'] ?? null;
        $this->keyword = $menu['keyword'] ?? null;
        $this->description = $menu['description'] ?? null;
        $this->AnHien = $menu['AnHien'] ?? null;
        $this->NgayDang = $menu['NgayDang'] ?? null;
        $this->UrlHinh = $menu['UrlHinh'] ?? null;
        $this->TinNoiBat = $menu['TinNoiBat'] ?? null;
        $this->SoLanXem = $menu['SoLanXem'] ?? null;
        $this->Stt = $menu['Stt'] ?? null;
    }

    function NewsByAliasOnly($alias)
    {
        return $this->GetNewsByAlias($alias);
    }
    function ToArrayJson()
    {
        return [
            "ID" => $this->ID, "PageID" => $this->PageID, "PageName" => $this->PagesById($this->PageID, true)->Name, "Name" => $this->Name, "Alias" => $this->Alias, "Link" => $this->linkNewsCurent(), "Summary" => strip_tags($this->Summary), "UrlHinh" => $this->UrlHinh(), "NgayDang" => $this->NgayDang, "TinNoiBat" => $this->TinNoiBat, "SoLanXem" => $this->SoLanXem, "Stt" => $this->Stt
        ];
    }

    function createNewsID()
    {
        return md5(time() . $this->RandomString(8));
    }

    function linkPreview()
    {
        return "/index/newsPreview/" . $this->ID;
        $p = new pages();
        $_p = $p->PagesById($this->PageID, FALSE);
        $p1 = new pages($_p);
        return $p1->linkPagesCurent() . $this->Alias . ".html";
    }

    function linkNewsCurent()
    {
        return "/" . $this->Alias . ".html";
        $p = new pages();
        $_p = $p->PagesById($this->PageID, FALSE);
        $p1 = new pages($_p);
        return $p1->linkPagesCurent() . $this->Alias . ".html";
    }


    function linkFullNewsCurent()
    {
        return BASE_URL . $this->Alias . ".html";
        $p = new pages();
        $_p = $p->PagesById($this->PageID, FALSE);
        $p1 = new pages($_p);
        return $p1->linkFullPagesCurent() . $this->Alias . ".html";
    }

    function NewsHot()
    {
        return $this->select($this->TableName, [], " `TinNoiBat` = '1' and `AnHien` = 1 ");
    }

    function DanhSachTinMoiNhat($number = 10)
    {
        return $this->select($this->TableName, [], " `AnHien` = 1 and `NgayDang` < NOW() order by `NgayDang` desc limit 0,{$number}");
    }

    function DanhSachTinPT($indexPage, $Number, $Name, &$Tong)
    {
        $DanhMuc = 0;
        if (!is_array($Name)) {
            $Name = $Name;
        } else {
            $DanhMuc = !empty($Name["DanhMuc"]) ? intval($Name["DanhMuc"]) : "";
            $Name = $Name["Name"];
        }
        $sqlDanhmuc = "";
        if ($DanhMuc > 0) {
            $sqlDanhmuc = " and `PageID` = '{$DanhMuc}'";
        }
        $Tong = 0;
        $indexPage = $indexPage - 1;
        $indexPage = max($indexPage, 0);
        $indexPage = $indexPage * $Number;
        $TongTin = $this->select($this->TableName, [], " `Name` like '%$Name%' and `AnHien` = 1 $sqlDanhmuc");
        if ($TongTin)
            $Tong = count($TongTin);
        $where = "`Name` like '%$Name%' $sqlDanhmuc order by `NgayDang` desc limit {$indexPage},{$Number}";
        return $this->select($this->TableName, [], $where);
    }
    function DanhSachIsDelete($indexPage, $Number, $Name, &$Tong)
    {
        $DanhMuc = 0;
        if (!is_array($Name)) {
            $Name = $Name;
        } else {
            $DanhMuc = !empty($Name["DanhMuc"]) ? intval($Name["DanhMuc"]) : "";
            $Name = $Name["Name"];
        }
        $sqlDanhmuc = "";
        if ($DanhMuc > 0) {
            $sqlDanhmuc = " and `PageID` = '{$DanhMuc}'";
        }
        $Tong = 0;
        $indexPage = $indexPage - 1;
        $indexPage = max($indexPage, 0);
        $indexPage = $indexPage * $Number;
        $Tong = 0;
        $where = "`Name` like '%$Name%' and `AnHien` < 1 order by `NgayDang` desc limit {$indexPage},{$Number}";
        return $this->select($this->TableName, [], $where);
    }
    function Thumnail()
    {
        $lib = new \lib\imageComp();
        return "/" . $lib->layHinh($this->UrlHinh, 250, 250, true);
    }

    public function NgayDang()
    {
        return date(\lib\Common::ShowDateFormat(), strtotime($this->NgayDang));
    }

    public static function LinkDetail($param0 = null)
    {
        if ($param0)
            return "/mnews/detail/" . $param0 . '/';
        return "/mnews/detail/" . $this->ID . '/';
    }

    public function PageID()
    {
        $pa = new pages();
        return new pages($pa->PagesById($this->PageID, FALSE));
    }

    public static function LinkEdit($param0)
    {

        return "/mnews/editnews/" . $param0 . '/';
    }

    public static function LinkDelete($param0)
    {

        return "/mnews/deletenews/" . $param0 . '/';
    }

    public static function LinkCopy($param0)
    {

        return "/mnews/copy/" . $param0 . '/';
    }

    public function Summary()
    {
        $sumary = strip_tags($this->Summary);
        if (!empty($sumary))
            return strip_tags($this->Summary);
        $Content = strip_tags($this->Content);
        $Content = explode(" ", $Content);
        $a = [];
        for ($i = 0; $i < 50; $i++) {
            if (isset($Content[$i]))
                $a[] = $Content[$i];
        }
        return implode(" ", $a);
    }

    public function DanhSachTinNoiBat($param0)
    {
        return $this->select($this->TableName, [], " `TinNoiBat` >= 1 order by `NgayDang` desc limit 0,{$param0}");
    }

    public function NewsByName($keyword, $Pages, $number, &$sum)
    {
        $count = $this->count($this->TableName, " `Name` like '%{$keyword}%' ");
        $sum = $count;
        $start = ($Pages - 1) * $number;
        return $this->select($this->TableName, [], " `Name` like '%{$keyword}%' and `AnHien` >= 1 order by `NgayDang` desc limit {$start},{$number}");
    }

    public function BaiVietLienQuan()
    {
        $start = 0;
        $number = 10;
        $id = $this->ID;
        $PageID = $this->PageID;
        $pk = "`PageID` = '{$PageID}' and `ID` not in('{$id}') and `AnHien` >= 1 and `NgayDang` < NOW() order by `NgayDang` desc limit {$start},{$number}";
        return $this->select($this->TableName, [], $pk);
    }

    public function UrlHinh()
    {
        $url = substr($this->UrlHinh, 1);
        if (file_exists($url))
            return substr(BASE_URL, 0, -1) . $this->UrlHinh;
        return "/public/lawkimsa/Images/h1.jpg";
    }

    public function AnHien()
    {
        return $this->AnHien == 0 ? 'Ẩn' : "Hiện";
    }

    public function NgayDangEdit()
    {
        return date("Y-m-d\TH:i", strtotime($this->NgayDang));
    }

    function functionName($param)
    {
        $sql = " SELECT
a.* ,b.*
   ,MAX(case when (b.ColumName='Maps') then b.ValuesText else NULL end) as 'Maps'
        ,MAX(case when (b.ColumName='DienTich') then b.ValuesText else NULL end) as 'DienTich'
FROM `bakcodt_duan` as a,`bakcodt_duan_options` as b where a.Id = b.IdDuan GROUP BY a.Id";
    }

    function HoiDaps()
    {
        $HoiDap = new News\HoiDap();
        return $HoiDap->GetByNews($this->ID);
    }
}
