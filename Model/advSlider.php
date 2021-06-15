<?php

namespace Model;

class advSlider extends adv {

    const HomeSlide = "HomeSlide";

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

    function GetSlides() {
        return $this->AdvsByGroup(self::HomeSlide, FALSE);
    }

    //put your code here
}
