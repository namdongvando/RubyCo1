<?php

namespace Model;

class pages extends \Model\Database {

    public
            $idPa,
            $idGroup,
            $Name,
            $Alias,
            $Title,
            $Des,
            $Keyword,
            $Summary,
            $Content,
            $Urlimages,
            $isShow,
            $Type,
            $Note,
            $OrderBy;
    private $TableName;

    function __construct($menu = null) {

        if ($menu) {

            if (!is_array($menu)) {
                $menu = $this->PagesById($menu, FALSE);
            }
            $this->idPa = $menu["idPa"];
            $this->idGroup = !empty($menu["idGroup"]) ? $menu["idGroup"] : 0;
            $this->Name = !empty($menu["Name"]) ? $menu["Name"] : null;
            $this->Alias = !empty($menu["Alias"]) ? $menu["Alias"] : null;
            $this->Title = !empty($menu["Title"]) ? $menu["Title"] : null;
            $this->Des = !empty($menu["Des"]) ? $menu["Des"] : null;
            $this->Keyword = !empty($menu["Keyword"]) ? $menu["Keyword"] : "";
            $this->Content = !empty($menu["Content"]) ? $menu["Content"] : "";
            $this->Urlimages = !empty($menu["Urlimages"]) ? $menu["Urlimages"] : "";
            $this->isShow = !empty($menu["isShow"]) ? $menu["isShow"] : 0;
            $this->Type = !empty($menu["Type"]) ? $menu["Type"] : 0;
            $this->Note = !empty($menu["Note"]) ? $menu["Note"] : "";
            $this->OrderBy = !empty($menu["OrderBy"]) ? $menu["OrderBy"] : 0;
        }

        parent::__construct();
        $this->TableName = table_prefix . "pages";
//        $this->capnhatAllPages();
    }

    public function ToArrayJson() {
        return [
            "idPa" => $this->idPa
            , "idGroup" => $this->idGroup
            , "idGroupName" => $this->idGroup()->Name
            , "Name" => $this->Name
            , "Alias" => $this->Alias
            , "isShow" => $this->isShow
            , "Type" => $this->Type
            , "OrderBy" => $this->OrderBy
            , "TypeName" => $this->Type()
        ];
    }

    function getNewsMoi() {
        $news = new news();
        $newsByPages = $news->NewsByPages($this->idPa, FALSE);

        return $newsByPages;
    }

    public function getAllChil($parent, $user_tree_array = []) {

        ini_set("memory_limit", -1);
        $Child = $this->IdPagesByGroup($parent, FALSE);
        if ($Child) {
            foreach ($Child as $k) {
                $user_tree_array = $this->getAllChil($k, $user_tree_array);
                $user_tree_array[] = $k;
            }
        }
        return $user_tree_array;
    }

    function editPages($Page) {
        $Page["Alias"] = $this->bodautv($Page["Name"]);
        return parent::editPages($Page);
    }

    function linkPagesCurent() {
        if ($this->Type == 1) {
            return "/page-" . $this->Alias . "/";
        }
        return "/page-" . $this->Alias . ".html";
    }

    function linkFullPagesCurent() {
        if ($this->Type == 1) {
            return BASE_URL . "page-" . $this->Alias . "/";
        }
        return BASE_URL . "page-" . $this->Alias . ".html";
    }

    function AddPages($data) {
        $data["Alias"] = $this->bodautv($data["Name"]);
        return parent::AddPages($data);
    }

    function DeletePages($Id) {
        return parent::DeletePages($Id);
    }

    function Pages($isobj = true) {
        return parent::Pages($isobj);
    }

    function PagesMin($isobj = true) {
        return parent::PagesMin();
    }

    function PagesByGroup($group, $isobj = true) {
        return parent::PagesByGroup($group, $isobj);
    }

    function IdPagesByGroup($group, $isobj = true) {
        return parent::IdPagesByGroup($group, $isobj);
    }

    function PagesByAlias($alias, $isobj = true) {
        return parent::PagesByAlias($alias, $isobj);
    }

    function PagesByAliasIsShow($alias, $isobj = true) {
        return parent::PagesByAliasIsShow($alias, $isobj);
    }

    function Breadcrumb($id) {
        $listCat = [];
        $a = [];
        $pages = $this->PagesById($id, FALSE);
        $pa = new \Model\pages($pages);
        $a[0]["link"] = $pa->linkPagesCurent();
        $a[0]["title"] = $pa->Name;
        return $a;
    }

    function PagesById($id, $isobj = true) {
        return parent::PagesById($id, $isobj);
    }

    function PagesInHome($PK, $isobj = true) {
//        return  array
        return parent::PagesByPK(" `Note` like '%ShowInHome___1%' ");
    }

    function capnhatAllPages() {
        $a = $this->Pages(FALSE);
        foreach ($a as $v) {
            $mp = new \Model\pages($v);
            $v["Alias"] = $mp->bodautv($v["Name"]);
            $this->editPages($v);
        }
    }

    public function idGroup() {
        if ($this->idGroup == 0) {
            return new pages(["idPa" => "0", "Name" => "Là cấp cha"]);
        }
        $a = $this->PagesById($this->idGroup, FALSE);
        if ($a)
            return new pages($a);
        return new pages(["idPa" => "0", "Name" => "N/a"]);
    }

    public function Type() {
        $a = ["Trang", "Danh Mục Tin"];
        return $a[$this->Type];
    }

    public function getNewsMoiTop($number) {
        $Modelnew = new news();
        return $Modelnew->NewsByPagesTop($this->idPa, $number);
    }

    function ToFormOption() {
        $sql = "SELECT * FROM `" . table_prefix . "pages` WHERE 1";
        $this->Query($sql);
        return $this->fetch2Option(["idPa", "Name"]);
    }

    public function isShow() {
        echo $this->isShow == 1 ? 'Hiện' : 'Ẩn';
    }

    public function GetPagesByidGroup() {
        $PagesService = new Pages\PagesService();
        $where = "`idGroup` = '{$this->idPa}'";
        return $PagesService->Select($where);
    }

}
