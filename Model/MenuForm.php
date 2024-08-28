<?php
namespace Model;

use PFBC\Element\Textbox;

class MenuForm
{

    const formName = 'FormMenu';
    private static $formValue;
    const prop = ["class" => "form-control"];


    function __construct($v = null)
    {
        self::$formValue = $v;
    }

    private function GetName($name)
    {
        return self::formName . "[{$name}]";
    }
    private function GetProp($pr)
    {
        $propTemp = self::prop;
        if ($pr) {
            foreach ($pr as $k => $v) {
                $propTemp[$k] = $v;
            }
        }
        return $propTemp ?? [];
    }
    private function GetValue($name)
    {
        return self::$formValue[$name] ?? null;
    }
    private function GetLable($name)
    {
        $lb = [
            "IDMenu" => "Mã",
            "Name" => "Tiêu đề",
            "Link" => "Đường Dẫn",
            "Parent" => "Cấp Cha",
            "Theme" => "Theme",
            "Groups" => "Nhóm",
            "OrderBy" => "Sắp Xếp",
            "Note" => "Hình Ảnh",
            "createDate" => "Ngày tạo",
            "UpdateDate" => "Ngày sửa",
        ];
        return $lb[$name];
    }



    public function IDMenu($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function Name($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function Link($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function Parent($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function Theme($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function Groups($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function OrderBy($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function Note($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function createDate($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }
    public function UpdateDate($prop = [])
    {
        $prop = $this->GetProp($prop);
        $prop["value"] = $this->GetValue(__FUNCTION__);
        $name = $this->GetName(__FUNCTION__);
        $label = $this->GetLable(__FUNCTION__);
        return new FormRender(new Textbox($label, $name, $prop));
    }

}


?>