<?php

namespace Model;

class Content {

    public $Infor;

    function __construct() {
        $this->Infor = new \Module\minfor\Model\infor();
    }

    function Contents() {

        $DSinfor = $this->Infor->infors();
        if ($DSinfor)
            foreach ($DSinfor as $in) {
                $params[$in["Name"]] = $in["Content"];
            }
        return $params;
    }

}
