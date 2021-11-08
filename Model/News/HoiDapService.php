<?php

namespace Model\News;

class HoiDapService extends \Model\DB implements \Model\IModelDB {

    public function __construct() {
        parent::$TableName = table_prefix . "news_hoidap";
        parent::__construct();
    }

    public function Delete($id) {
        $where = "`Id` = '{$id}'";
        return $this->UpdateDB($where);
    }

    public function GetAllPT($name, &$total, $indexPage = 1, $pageNumber = 10) {
        $where = "1=1";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function GetById($id) {
        $where = "`Id` = '{$id}'";
        return $this->SelectRow($where);
    }

    public function Post($model) {
        return $this->Insert($model);
    }

    public function Put($model) {
        $where = "`Id` = '{$model["Id"]}'";
        return $this->Update($model, $where);
    }

    public static function ToSelect() {

    }

    public function GetByNewsId($id) {
        $where = "`NewsId` = '{$id}'";
        return $this->Select($where);
    }

}
