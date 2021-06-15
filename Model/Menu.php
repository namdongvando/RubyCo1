<?php

namespace Model;

class Menu extends \Model\Database {

    public
            $IDMenu,
            $Name,
            $Link,
            $Parent,
            $Theme,
            $Groups,
            $OrderBy,
            $Note,
            $createDate,
            $UpdateDate;

    function __construct($menu = null) {
        if ($menu) {
            $this->IDMenu = $menu['IDMenu'];
            $this->Name = $menu['Name'];
            $this->Link = $menu['Link'];
            $this->Parent = $menu['Parent'];
            $this->Theme = $menu['Theme'];
            $this->Groups = $menu['Groups'];
            $this->OrderBy = $menu['OrderBy'];
            $this->Note = $menu['Note'];
            $this->createDate = $menu['createDate'];
            $this->UpdateDate = $menu['UpdateDate'];
        }
        parent::__construct();
    }

    function Menus($isobj = true) {
        return parent::Menus($isobj);
    }

    function MenuByTheme($theme, $isobj = false) {
        return parent::MenuByTheme($theme, $isobj);
    }
    
    function MenusByGroup($group, $isobj = true) {
        return parent::MenusByGroup($group, $isobj);
    }

    function MenusById($id, $isobj = true) {
        return parent::MenusById($id, $isobj);
    }

    function MenusByParent($prent, $isobj = true) {
        return parent::MenusByParent($prent, $isobj);
    }

    function AllMenus($isobj = true) {
        return parent::AllMenus($isobj);
    }
    function AddMenu($Menu) {
        return parent::AddMenu($Menu);
    }
    function EditMenu($Menu) {
        return parent::EditMenu($Menu);
    }

        
    
    
}
