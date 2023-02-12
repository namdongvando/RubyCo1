<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of OptionsService
 *
 * @author MSI
 */
class OptionsService extends DB
{

    public $Id;
    public $Name;
    public $Val;
    public $Des;
    public $STT;
    public $GroupsId;

    public function __construct($op = null)
    {
        parent::$TableName = table_prefix . "options";
        parent::__construct();
        if ($op) {
            if (!is_array($op)) {
                $Id = $op;
                $op = $this->GetById($Id);
            }
        }

        $this->Id = $op["Id"] ?? null;
        $this->Name = $op["Name"] ?? null;
        $this->Val = $op["Val"] ?? null;
        $this->Des = $op["Des"] ?? null;
        $this->STT = $op["STT"] ?? null;
        $this->GroupsId = $op["GroupsId"] ?? null;
    }

    //put your code here
    public function Delete($Id)
    {
        $where = "`Id`='{$Id}'";
        return $this->UpdateDB($where);
    }

    public function GetById($Id)
    {
        $where = "`Id`='{$Id}'";
        return $this->SelectRow($where);
    }

    public function GetItems($params, $indexPage, $pageNumber, &$total)
    {
        $where = "`GroupsId` = '{$params["GroupsId"]}' and `Name` like '%{$params["keyword"]}%'";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function Post($model)
    {
        if (!isset($model["Id"])) {
            $model["Id"] = time();
        }
        return $this->Insert($model);
    }

    public function Put($model)
    {
        $where = "`Id` = '{$model["Id"]}'";
        return $this->Update($model, $where);
    }

    public static function GetGroupsToSelect($idGroups)
    {
        $op = new OptionsService();
        return $op->GetToSelect("`GroupsId`= '{$idGroups}' order by `STT` ", ["Val", "Name"]);
    }
    public static function ToSelectByGroup($idGroups)
    {
        $op = new OptionsService();
        return $op->GetToSelect("`GroupsId`= '{$idGroups}' order by `STT` ", ["Val", "Name"]);
    }

    public static function ToSelect()
    {
        $op = new OptionsService();
        return $op->GetToSelect("1=1", ["Val", "Name"]);
    }

    public function btnSua()
    {
    }

    public function btnXoa()
    {
    }

    public function GroupsId()
    {
    }
    public function Group()
    {
        return new OptionsService($this->GroupsId);
    }

    public function GetByKeyValue($val, $idGroups)
    {
        $where = "`GroupsId` = '{$idGroups}' and `Val` = '{$val}'";
        return $this->SelectRow($where);
    }
    public static function GetByKeyVal($val, $idGroups)
    {
        $op = new OptionsService(); 
        return $op->GetByKeyValue($val, $idGroups);
    }
}
