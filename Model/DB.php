<?php

namespace Model;

class DB {

    public static $TableName;
    public static $Debug;
    private static $Connect;

    public function __construct() {
        $ad = new \Model_Adapter();
        if (self::$Connect == null)
            self::$Connect = \Model_Adapter::$_conn;
    }

    protected function GetRows($sql) {
        if (self::$Debug)
            echo $sql;

        $res = self::$Connect->query($sql);
        $a = [];
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $a[] = $row;
            }
        }
        return $a;
    }

    protected function GetRow($sql) {
        if (self::$Debug)
            echo $sql;
        $res = self::$Connect->query($sql);
        $a = [];
        if ($res)
            return $res->fetch_assoc();
        return null;
    }

    // đém so dòng
    protected function SelectCount($where) {
        $TableName = self::$TableName;
        $sql = "SELECT COUNT(*) as `Total` FROM `{$TableName}` WHERE {$where}";
        $res = $this->GetRow($sql);
        return $res["Total"];
    }

    // Phan Trang
    protected function SelectPT($where, $indexPage, $pageNumber, &$total) {
        $indexPage = ($indexPage - 1) * $pageNumber;
        $indexPage = max($indexPage, 0);
        $total = $this->SelectCount($where);
        $where = "{$where} limit {$indexPage},{$pageNumber}";
        return $this->Select($where);
    }

    // lấy 1 dòng
    public function SelectRow($where, $col = []) {
        $TableName = self::$TableName;
        $sql = "SELECT * FROM `{$TableName}` WHERE {$where}";
        if ($col) {
            $strCol = implode("`,`", $col);
            $sql = "SELECT `{$strCol}` FROM `{$TableName}` WHERE {$where}";
        }
        return $this->GetRow($sql);
    }

    public function GetToSelect($where, $col) {
        $TableName = self::$TableName;
        $sql = "SELECT * FROM `{$TableName}` WHERE {$where}";
        if ($col) {
            $strCol = implode("`,`", $col);
            $sql = "SELECT `{$strCol}` FROM `{$TableName}` WHERE {$where}";
        }
        return $this->GetRowsToSelect($sql, $col);
    }

    // lấy nhiều dòng
    public function Select($where, $col = []) {
        $TableName = self::$TableName;
        $sql = "SELECT * FROM `{$TableName}` WHERE {$where}";
        if ($col) {
            $strCol = implode("`,`", $col);
            $sql = "SELECT `{$strCol}` FROM `{$TableName}` WHERE {$where}";
        }
        return $this->GetRows($sql);
    }

    // sửa
    public function Update($model, $where) {
        $TableName = self::$TableName;
        $strsql = "";
        foreach ($model as $col => $val) {
            if ($val === null)
                $strsql .= "`{$col}`= null,";
            else
                $strsql .= "`{$col}`= '{$val}',";
        }
        $strsql = substr($strsql, 0, -1);
        $sql = "UPDATE `{$TableName}` SET {$strsql} WHERE {$where}";
        $res = self::$Connect->query($sql);
        if (!$res) {
            if (self::$Debug == TRUE)
                echo $sql;
            throw new \Exception(self::$Connect->error);
        }
        return self::$Connect;
    }

    // xóa data base

    public function UpdateDB($where) {
        $TableName = self::$TableName;
        $sql = "DELETE FROM `{$TableName}` WHERE {$where}";
        self::$Connect->query($sql);
        return self::$Connect;
    }

    //  Them6
    public function Insert($model) {
        $col = array_keys($model);
        $val = array_values($model);
        $colstr = implode("`,`", $col);
        $valstr = implode("','", $val);
        $TableName = self::$TableName;

        $sql = "INSERT INTO `{$TableName}`(`{$colstr}`) VALUES ('{$valstr}')";
        if (self::$Debug == TRUE) {
            echo $sql;
        }
        $res = self::$Connect->query($sql);
        if (!$res) {
            throw new \Exception(self::$Connect->error);
        }
        return self::$Connect;
    }

    public function GetRowsToSelect($sql, $col) {
        if (self::$Debug) {
            var_dump($col);
            echo $sql;
        }
        $res = self::$Connect->query($sql);
        $a = [];
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $a[$row[$col[0]]] = $row[$col[1]];
            }
        }
        return $a;
    }

}
