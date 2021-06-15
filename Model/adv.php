<?php

namespace Model;

class adv extends \Model\CheckInput {

    public $ID;
    public $Name;
    public $Content;
    public $Group;
    public $Urlimages;
    public $Link;
    public $Attribute;
    public $DataAttribute;
    public $isShow;
    public $createDate;
    public $updateDate;

    function __construct($adv = null) {
        if ($adv) {
            if (!is_array($adv)) {
                $adv = $this->AdvsById($adv, FALSE);
            }
            $this->ID = $adv["ID"];
            $this->Name = $adv["Name"];
            $this->Content = $adv["Content"];
            $this->Group = $adv["Group"];
            $this->Urlimages = $adv["Urlimages"];
            $this->Attribute = $adv["Attribute"];
            $this->DataAttribute = $adv["DataAttribute"];
            $this->Link = $adv["Link"];
            $this->isShow = $adv["isShow"];
            $this->createDate = $adv["createDate"];
            $this->updateDate = $adv["updateDate"];
        }
        parent::__construct();
    }

    function getImagesWH($param) {

    }

    function Advs($isobj = true) {
        return parent::Advs($isobj);
    }

    function AdvsByGroup($Group, $isobj = true) {
        return parent::AdvsByGroup($Group, $isobj);
    }

    function getGroupsAdv($isobj = true) {
        return parent::getGroupsAdv($isobj);
    }

    function AdvsById($ID, $isobj = true) {
        return parent::AdvsById($ID, $isobj);
    }

    function DeleteAdv($Adv) {
        return parent::DeleteAdv($Adv);
    }

    function AddAdv($Adv) {
        return parent::AddAdv($Adv);
    }

    function DeleteAdvByGroup($Group) {
        return parent::DeleteAdvByGroup($Group);
    }

    function updateHomeSlide() {

        $libImg = new \lib\imageComp();
        $DS = $this->AdvsByGroup("homeslide", FALSE);
        foreach ($DS as $k => $value) {
            $img = "/" . $libImg->layHinh($value["Urlimages"], 785, 480);
            $Attribute = $a->_decode($value["Attribute"]);
            $DS[$k]["Image"] = $img;
            $DS[$k]["Attribute"] = $Attribute;
        }

        $io = new \lib\io();
        $lib = new \lib\APIs();
        $fileName = "cache/homeslide.json";
        $content = $lib->ArrayToString($DS);
        $io->writeFile($fileName, $content);
    }

    public function GetFileContentGroup($param0) {

        $io = new \lib\io();
        $fileName = "cache/{$param0}.json";
        if (file_exists($fileName)) {
            $a = $io->readFile($fileName);
            return json_decode($a, JSON_OBJECT_AS_ARRAY);
        }
    }

    //put your code here
}
