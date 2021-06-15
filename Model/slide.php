<?php

namespace Model;

class slide extends \Model\Database{

    public
            $ID,
            $Name,
            $Urlimages,
            $Link,
            $Content,
            $Groups,
            $Theme,
            $OrderBy,
            $Note,
            $createDate,
            $UpdateDate;

    function __construct($menu = null) {
        if ($menu) {
            $this->ID = $menu['ID'];
            $this->Name = $menu['Name'];
            $this->Urlimages = $menu['Urlimages'];
            $this->Link = $menu['Link'];
            $this->Content = $menu['Content'];
            $this->Groups = $menu['Groups'];
            $this->OrderBy = $menu['OrderBy'];
            $this->Theme = $menu['Theme'];
            $this->Note = $menu['Note'];
            $this->createDate = $menu['createDate'];
            $this->UpdateDate = $menu['UpdateDate'];
        }
        parent::__construct();
    }

}
