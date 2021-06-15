<?php

namespace Module\minfor\Model;

class infor extends \Model\Database {

    private $NameTable;
    public
            $ID,
            $Name,
            $Title,
            $Content,
            $Config,
            $dataConfig,
            $createDate,
            $modifyDate;

    function __construct($menu = null) {
        if ($menu) {
            $this->ID = $menu['ID'];
            $this->Name = $menu['Name'];
            $this->Content = $menu['Content'];
            $this->Title = $menu['Title'];
            $this->Config = $menu['Config'];
            $this->dataConfig = $menu['dataConfig'];
            $this->createDate = $menu['createDate'];
            $this->modifyDate = $menu['modifyDate'];
        }
        parent::__construct();
        $this->NameTable = table_prefix . "infor";
    }

    function infors() {
        return $this->select($this->NameTable);
    }

    function addinfor($Infor) {
        return $this->insert($this->NameTable, $Infor);
    }

    function editinfor($Infor) {
        
        return $this->update($this->NameTable, $Infor, "`ID` = '{$Infor["ID"]}'");
    }

    function deleteinfor($Id) {
        return $this->delete($this->NameTable, "`ID` = '{$Id}'");
    }

    function inforById($Id) {
        $In = $this->select($this->NameTable, [], "`ID` = '{$Id}'");
        return $In[0];
    }

}
