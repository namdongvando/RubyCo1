<?php

namespace Model\News;

class NewsService extends \Model\DB {

    //put your code here
    public function __construct() {
        \Model\DB::$TableName = table_prefix . "news";
        parent::__construct();
    }

    public function Delete($id) {
        $where = "`ID` = '{$id}'";
        return $this->UpdateDB($where);
    }

    public function GetAllPT($name, &$total, $indexPage = 1, $pageNumber = 10) {

    }

    public function GetById($id) {
        $where = "`ID` = '{$id}'";
        return $this->SelectRow($where);
    }

    public function Post($model) {

    }

    public function Put($model) {

    }

    public static function ToSelect() {

    }

}
