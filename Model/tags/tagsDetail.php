<?php

namespace Model\tags;

class tagsDetail extends \Model\DB implements \Model\IModelDB
{

    public $Id, $IdTags, $IdNews, $Name;

    public function __construct($tag = null)
    {
        parent::$TableName = table_prefix . "tags_detail";
        parent::__construct();
        if ($tag) {
            if (!is_array($tag)) {
                $tag = $this->GetById($tag);
            }
            if ($tag) {
                $this->Id = !empty($tag["Id"]) ? $tag["Id"] : null;
                $this->IdTags = !empty($tag["IdTags"]) ? $tag["IdTags"] : null;
                $this->IdNews = !empty($tag["IdNews"]) ? $tag["IdNews"] : null;
                $this->Name = !empty($tag["Name"]) ? $tag["Name"] : null;
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

    public function GetByNewsId($id)
    {
        $where = "`IdNews` = '{$id}'";
        return $this->Select($where);
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
        $t = new tagsDetail();
        return $t->GetToSelect($where, ["Id", "Name"]);
    }

    public function GetByTagAlias($name, &$total, $indexPage = 1, $pageNumber = 10)
    {
        $where = "`Alias` = '{$name}'";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function GetNews(&$total, $indexPage = 1, $pageNumber = 10)
    {
        $where = "`IdTags` = '{$this->Id}'";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function GetByAlias($alias, &$total, $indexPage = 1, $pageNumber = 10)
    {
        $where = "`Alias` = '{$alias}'";
        return $this->SelectPT($where, $indexPage, $pageNumber, $total);
    }

    public function Tags()
    {
        return new tags($this->IdTags);
    }
}
