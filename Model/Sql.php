<?php

namespace Model;

class Sql
{

    static public function Table($tableName)
    {
        return "from {$tableName}";
    }
    static public function Select($columname = "*")
    {
        $select = "*";
        if (is_array($columname)) {
        }

        return $select;
    }
    static public function WhereEq($columname, $value)
    {
        return " `{$columname}` = '{$value}' ";
    }
    static public function WhereLess($columname, $value)
    {
        return " `{$columname}` < '{$value}'";
    }
    static public function WhereBigger($columname, $value)
    {
        return " `{$columname}` > '{$value}'";
    }
    static public function WhereLike($columname, $value, $f = "%", $l = "%")
    {
        return " `{$columname}` like '{$f}{$value}{$l}'";
    }
    static public function WhereOr($where)
    {
        return " or {$where} ";
    }
    static public function Opening($where)
    {
        return " ( {$where} )";
    }
    public static function Limit($index, $number)
    {
        return " Limit {$index},{$number} ";
    }
    static public function WhereInArray($columname, $listValue)
    {
        $strIn = implode("','", $listValue);
        $whereIn = "'{$strIn}'";
        return " `{$columname}` in ({$whereIn})";
    }
    static public function WhereAnd($where)
    {
        return " and {$where} ";
    }
    static public function OrderBy($col, $asc = "ASC")
    {
        if (is_array($col)) {
            $col = implode("`,`", $col);
        }
        return " Order By `{$col}` {$asc} ";
    }
}