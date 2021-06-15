<?php

class Model_Template extends Model_Adapter {

    public $IdTemplate;
    public $Name;
    public $Content;
    public $Note;

    function __construct($menu = NULL) {
        if ($menu) {
            $this->IdTemplate = $menu["IdTemplate"];
            $this->Name = $menu["Name"];
            $this->Content = $menu["Content"];
            $this->ContentFull = $menu["Content"];
            $this->Note = $menu["Note"];
        }
        parent::__construct();
    }

    function ContentFull() {
        $param = $this->Content;
        $a = $this->GetTemplateById($this->IdTemplate);
        $Note = $this->_decode($a["Note"]);
        for ($index = 1; $index <= 4; $index++) {
            $BaiVietDacBiet_Title = "BaiVietDacBiet_Title" . $index;
            $BaiVietDacBiet_Link = "BaiVietDacBiet_Link" . $index;
            $BaiVietDacBiet_Introtext = "BaiVietDacBiet_Introtext" . $index;
            $Note[$index - 1]->$BaiVietDacBiet_Link = isset($Note[$index - 1]->$BaiVietDacBiet_Link) ? $Note[$index - 1]->$BaiVietDacBiet_Link : "";
            $Note[$index - 1]->$BaiVietDacBiet_Title = isset($Note[$index - 1]->$BaiVietDacBiet_Title) ? $Note[$index - 1]->$BaiVietDacBiet_Title : "";
            $Note[$index - 1]->$BaiVietDacBiet_Introtext = isset($Note[$index - 1]->$BaiVietDacBiet_Introtext) ? $Note[$index - 1]->$BaiVietDacBiet_Introtext : "";
            $param = str_replace("{BaiVietDacBiet_Link" . $index . "}", $Note[$index - 1]->$BaiVietDacBiet_Link, $param);
            $param = str_replace("{BaiVietDacBiet_Title" . $index . "}", $Note[$index - 1]->$BaiVietDacBiet_Title, $param);
            $param = str_replace("{BaiVietDacBiet_Introtext" . $index . "}", $Note[$index - 1]->$BaiVietDacBiet_Introtext, $param);
        }

        return $param;
    }

    function GetTemplate() {
        $sql = "SELECT * FROM `" . table_prefix . "template`";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function GetTemplateById($id) {
        $sql = "SELECT * FROM `" . table_prefix . "template` where `IdTemplate` = '{$id}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function SuaTemplate($View) {
        $sql = "UPDATE `" . table_prefix . "template` SET "
                . "`Name`='{$View["Name"]}',"
                . "`Content`='{$View["Content"]}',"
                . "`Note`='{$View["Note"]}' "
                . "WHERE `IdTemplate`='{$View["IdTemplate"]}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function ThemTemplate($View) {
        $sql = "INSERT INTO `" . table_prefix . "template` SET "
                . "`Name`='{$View["Name"]}',"
                . "`Content`='{$View["Content"]}',"
                . "`Note`='{$View["Note"]}' ";
        $this->Query($sql);
        return $this->Luu();
    }

    function XoaTemplate($Id) {
        $sql = "DELETE FROM `" . table_prefix . "template` WHERE `IdTemplate`='{$Id}'";
        $this->Query($sql);
        return $this->Luu();
    }

}

?>