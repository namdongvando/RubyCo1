<?php

namespace Model\Pages;

class PagesService extends \Model\DB implements \Model\IModel {

    public function __construct() {
        \Model\DB::$TableName = table_prefix . "pages";
        parent::__construct();
    }

    public function Delete($id) {
        $where = "`idPa` = '{$id}'";
        return $this->UpdateDB($where);
    }

    public function GetAll() {
        $where = "1";
        return $this->Select($where);
    }

    public function GetAllIsShow() {
        $where = " `isShow` > 0  ";
        return $this->Select($where);
    }

    public function GetAllPT($name, &$total, $indexPage = 1, $pageNumber = 10) {
        $where = "`Name` like '%{$name}%'";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function GetAllPTByPrent($parent, &$total, $indexPage = 1, $pageNumber = 10) {
        $where = "`idGroup` = '{$parent}' and  `isShow` >= 0";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function GetById($id) {
        $where = "`idPa` = '{$id}'";
        return $this->SelectRow($where);
    }

    public function GetByIdByCol($id, $col = ["idPa", 'Name']) {
        $where = "`idPa` = '{$id}'";
        return $this->SelectRow($where, $col);
    }

    public function Post($model) {
        return $this->Insert($model);
    }

    public function Put($model) {
        $where = "`idPa` = '{$model["idPa"]}'";
        return $this->Update($model, $where);
    }

    public static function ToSelect() {
        $a = new PagesService();
        $where = "1";
        return $a->GetToSelect($where, ["idPa", "Name"]);
    }

    public static function ToSelectDequy($parent, &$arr, $tienTo = "--|") {
        $a = new PagesService();
        $where = "`idGroup` = '{$parent}'";
        $pagesByParent = $a->Select($where, ["idPa", "Name"]);
        if ($pagesByParent) {
            foreach ($pagesByParent as $k => $ps) {
                $arr[$ps["idPa"]] = $tienTo . $ps["Name"];
                self::ToSelectDequy($ps["idPa"], $arr, $tienTo . '--|');
            }
        }
        return;
    }

}
