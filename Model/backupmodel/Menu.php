<?php

class Model_Menu extends Model_Adapter {

    public $id;
    public $name;
    public $link;
    public $group;
    public $parent;
    public $range;

    function __construct($menu = NULL) {
        if ($menu) {
            $this->id = $menu["id"];
            $this->name = $menu["name"];
            $this->link = $menu["link"];
            $this->group = $menu["group"];
            $this->parent = $menu["parent"];
            $this->range = $menu["range"];
        }
        parent::__construct();
    }

    function checkmenu($MenuArray) {
        $MenuArray['name'] = isset($MenuArray['name']) ? $MenuArray['name'] : "";
        $MenuArray['link'] = isset($MenuArray['link']) ? $MenuArray['link'] : "";
        $MenuArray['parent'] = isset($MenuArray['parent']) ? $MenuArray['parent'] : 0;
        $MenuArray['group'] = isset($MenuArray['group']) ? $MenuArray['group'] : "N/A";
        $MenuArray['group'] = str_replace(" ", "_", $MenuArray['group']);
        $MenuArray['range'] = isset($MenuArray['range']) ? $MenuArray['range'] : 0;
        return $MenuArray;
    }

    function UpdateMenu($MenuArray) {
        $MenuArray = $this->checkmenu($MenuArray);
        $sql = "UPDATE `" . table_prefix . "menu` SET"
                . " `name` = '{$MenuArray['name']}', "
                . "`link` = '{$MenuArray['link']}', "
                . "`parent` = '{$MenuArray['parent']}', "
                . "`group` = '{$MenuArray['group']}', "
                . "`range` = '{$MenuArray['range']}' WHERE "
                . "`id` = '{$MenuArray['id']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function CreateMenu($MenuArray) {
        $MenuArray = $this->checkmenu($MenuArray);

        $sql = "INSERT INTO `" . table_prefix . "menu` SET"
                . " `name` = '{$MenuArray['name']}', "
                . "`link` = '{$MenuArray['link']}', "
                . "`parent` = '{$MenuArray['parent']}', "
                . "`group` = '{$MenuArray['group']}', "
                . "`range` = '{$MenuArray['range']}' ";
        $this->Query($sql);
        return $this->Luu();
    }

    function SelectMenu4Id($id) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` where `id` = '{$id}' ";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function SelectMenu4group($id) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` where `group` = '{$id}' ORDER BY `range` ASC ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function SelectMenu4group2parent($id, $idparent) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` where `group` = '{$id}' and `parent` ='{$idparent}'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function SelectGroup() {
        $sql = "SELECT `group` FROM `" . table_prefix . "menu` GROUP by `group`";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DeleteMenu($id) {
        $sql = "DELETE FROM `" . table_prefix . "menu` WHERE `id` = '{$id}'";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DeleteMenuByGroup($id) {
        $sql = "DELETE FROM `" . table_prefix . "menu` WHERE `group` = '{$id}'";
        $this->Query($sql);
        return $this->Luu();
    }

}

?>