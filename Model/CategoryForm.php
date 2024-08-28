<?php
namespace Model;

use PFBC\Element\Select;
use PFBC\Element\Textarea;
use PFBC\Element\Textbox;

class CategoryForm
{

    const FormNanme = __CLASS__;
    const Prop = ["class" => "form-control"];

    public static $formVaLue;
    function __construct($formVaLue = [])
    {
        self::$formVaLue = $formVaLue;
    }

    function GetLbl($name)
    {
        $a = [];
        $pop = $this->GetProp([]);
        return $a[$name] ?? $pop["label"] ?? $name;
    }
    function GetName($name)
    {
        return self::FormNanme . "[{$name}]";
    }
    function GetValue($name, $value)
    {
        return self::$formVaLue[$name] ?? $value ?? null;
    }
    function GetProp($prop)
    {
        $_p = self::Prop;
        foreach ($prop as $key => $value) {
            $_p[$key] = $value;
        }
        return $_p;
    }

    public function catID($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public function catName($prop = [])
    {

        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public function Path($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public function Link($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public function Note($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textarea($lable, $name, $prop));
    }
    public function parentCatID($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        $ops = ["" => "Chọn Danh Mục"] + Category::GetCatBy2Option();
        return new FormRender(new Select($lable, $name, $ops, $prop));
    }
    public function banner($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public function Public ($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Select($lable, $name, ["1" => "Có", "0" => "Không"], $prop));
    }
    public function Serial($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }
    public function Lang($prop = [])
    {
        $name = $this->GetName(__FUNCTION__);
        $prop["value"] = $this->GetValue(__FUNCTION__, $prop["value"] ?? null);
        $prop = $this->GetProp($prop);
        $lable = $this->GetLbl(__FUNCTION__);
        return new FormRender(new Textbox($lable, $name, $prop));
    }

}


?>