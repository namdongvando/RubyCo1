<?php

namespace Module\pages\Model;

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

    function __construct($menu = null) {
        if ($menu) {
            $this->idPa = $menu['idPa'];
            $this->idGroup = $menu['idGroup'];
            $this->Name = $menu['Name'];
            $this->Alias = $menu['Alias'];
            $this->Title = $menu['Title'];
            $this->Des = $menu['Des'];
            $this->Keyword = $menu['Keyword'];
            $this->Summary = $menu['Summary'];
            $this->Content = $menu['Content'];
            $this->Urlimages = $menu['Urlimages'];
            $this->isShow = $menu['isShow'];
            $this->Type = $menu['Type'];
            $this->Note = $menu['Note'];
            $this->OrderBy = $menu['OrderBy'];
        }

        parent::__construct();
//        $this->capnhatAllPages();
    }

    function ToArrayJson() {
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

    function PagesByAlias($alias, $isobj = true) {
        return parent::PagesByAlias($alias, $isobj);
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

    public function Type() {
        $a = ["Trang", "Danh Mục Tin"];
        return $a[$this->Type];
    }

    public function idGroup() {
        if ($this->idGroup == 0) {
            return new \Model\pages(["idPa" => "0", "Name" => "Là cấp cha"]);
        }
        $a = $this->PagesById($this->idGroup, FALSE);
        if ($a)
            return new pages($a);
        return new pages(["idPa" => "0", "Name" => "N/a"]);
    }

}
