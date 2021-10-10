<?php

namespace Model;

class newsService extends DB implements IModelDB {

    public
            $ID,
            $PageID,
            $Name,
            $Alias,
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

    function __construct($menu = null) {
        parent::$TableName = table_prefix . "news";
        parent::__construct();
        if ($menu) {
            if (!is_array($menu)) {
                $menu = $this->NewsById($menu, FALSE);
            }
            if ($menu) {
                $this->ID = $menu['ID'];
                $this->PageID = $menu['PageID'];
                $this->Name = $menu['Name'];
                $this->Alias = $menu['Alias'];
                $this->Summary = $menu['Summary'];
                $this->Content = $menu['Content'];
                $this->title = $menu['title'];
                $this->keyword = $menu['keyword'];
                $this->description = $menu['description'];
                $this->AnHien = $menu['AnHien'];
                $this->NgayDang = $menu['NgayDang'];
                $this->UrlHinh = $menu['UrlHinh'];
                $this->TinNoiBat = $menu['TinNoiBat'];
                $this->SoLanXem = $menu['SoLanXem'];
                $this->Stt = $menu['Stt'];
            }
        }
    }

    public function Delete($id) {

    }

    public function GetAllPT($name, &$total, $indexPage = 1, $pageNumber = 10) {

    }

    public function GetById($id) {

    }

    function linkCurent($Alias = null) {
        if ($Alias == null)
            return "/" . $this->Alias . ".html";
        return "/" . $Alias . ".html";
    }

    public function GetAllToRss() {
        $a = $this->Select(" `AnHien` = 1 ");
        return $a;
    }

    public function Post($model) {

    }

    public function Put($model) {

    }

    public static function ToSelect() {

    }

}
