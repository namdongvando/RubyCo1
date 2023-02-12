<?php

namespace Module\minfor\Model;

use lib\Common;
use lib\input;

class infor extends \Model\Database
{

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

    function __construct($menu = null)
    {
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

    function infors()
    {
        return $this->select($this->NameTable);
    }
    public function getbybyname($name)
    {
        return $this->selectRow($this->NameTable, [], "`Name` = '{$name}'");
    }
    function inforsInArray($a = [])
    {
        if ($a) {
            foreach ($a as $key => $value) {
                if ($value) {
                    $infor =  $this->getbybyname($value);
                    if ($infor == null) {
                        $_post = new infor();
                        $_post->Name = $value;
                        $_post->Title = $value;
                        $_post->Content = "";
                        $_post->Config = input::InputText('{"Type":"text"}');
                        $_post->dataConfig = input::InputText('{"Type":"text"}');
                        $this->addinfor((array) $_post->ToArray());
                    }
                }
            }
        }
        $names = implode("','", $a);
        return $this->select($this->NameTable, [], "`Name` in ('{$names}')");
    }

    public function ToArray()
    {
        return [
            "ID" => $this->ID,
            "Name" => $this->Name,
            "Content" => $this->Content,
            "Title" => $this->Title,
            "Config" => $this->Config,
            "dataConfig" => $this->dataConfig,
            "createDate" => $this->createDate,
            "modifyDate" => $this->modifyDate,
        ];
    }
    function addinfor($Infor)
    {
        unset($Infor["ID"]);
        unset($Infor["createDate"]);
        unset($Infor["modifyDate"]);
        return $this->insert($this->NameTable, $Infor);
    }

    function editinfor($Infor)
    {

        return $this->update($this->NameTable, $Infor, "`ID` = '{$Infor["ID"]}'");
    }

    function deleteinfor($Id)
    {
        return $this->delete($this->NameTable, "`ID` = '{$Id}'");
    }

    function inforById($Id)
    {
        $In = $this->select($this->NameTable, [], "`ID` = '{$Id}'");
        return $In[0];
    }
}
