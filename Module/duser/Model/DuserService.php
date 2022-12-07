<?php

namespace Module\duser\Model;

class DuserService extends DB implements IModel
{

    function __construct($NhanVien = NULL)
    {
        DB::$TableName = table_prefix . "admin";
        parent::__construct();
    }

    public function Delete($id)
    {
        $where = "`Username` = '{$id}'";
        return $this->UpdateDB($where);
    }

    public function GetAll()
    {
        $where = " `Groups` >= 0  ";
        return $this->Select($where);
    }

    public function GetAllPT($keyword, &$total, $pagesIndex = 1, $pageNumber = 10)
    {
        $where = " 1 ";
        return $this->SelectPT($where, $pagesIndex, $pageNumber, $total);
    }

    public function GetById($id)
    {
        $where = "`Username` = '{$id}'";
        return $this->Select($where);
    }

    public function Post($Model)
    {
        return $this->Insert($Model);
    }

    public function Put($Model)
    {
        $where = "`Username` = '{$Model["Username"]}'";
        return $this->Update($Model, $where);
    }

    public static function ToSelect()
    {
    }
}
