<?php

namespace Model\tags;

class tags extends \Model\DB implements \Model\IModelDB
{

    public $Id;
    public $Name;
    public $Alias;
    public $Content;

    public function __construct($tag = null)
    {
        parent::$TableName = table_prefix . "tags";
        parent::__construct();
        if ($tag) {
            if (!is_array($tag)) {
                $tag = $this->GetById($tag);
            }
            if ($tag) {
                $this->Id = !empty($tag["Id"]) ? $tag["Id"] : null;
                $this->Name = !empty($tag["Name"]) ? $tag["Name"] : null;
                $this->Alias = !empty($tag["Alias"]) ? $tag["Alias"] : null;
                $this->Content = !empty($tag["Content"]) ? $tag["Content"] : null;
            }
        }
    }

    public function Delete($id)
    {
        $where = "`Id` = '{$id}'";
        return $this->UpdateDB($where);
    }

    public function GetAllPT($name, &$total, $indexPage = 1, $pageNumber = 10)
    {
        $where = "`Name` like '%{$name}%' ";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function GetById($id)
    {
        $where = "`Id` = '{$id}'";
        return $this->SelectRow($where);
    }

    public function Post($model)
    {
        return $this->Insert($model);
    }

    public function Put($model)
    {

        return $this->Update($model, "`Id` = '{$model["Id"]}'");
    }

    public static function ToSelect()
    {
        $where = "1";
        $t = new tags();
        return $t->GetToSelect($where, ["Id", "Name"]);
    }

    public function LinkTags()
    {
        return BASE_URL . $this->Alias;
    }

    public function GetByAlias($alias)
    {
        $where = "`Alias` = '{$alias}'";
        return $this->SelectRow($where);
    }

    public function GetByNameDetail($name)
    {
        $where = "`Name` = '{$name}'";
        return $this->SelectRow($where);
    }
    
}
