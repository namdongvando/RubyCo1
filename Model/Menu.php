<?php

namespace Model;

class Menu extends \Model\Database
{

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

    function __construct($menu = null)
    {
        if ($menu) {
            if (!is_array($menu)) {
                $id = $menu;
                var_dump($id);
                $menu = $this->GetById($id);
            }
        }
        $this->IDMenu = $menu['IDMenu'] ?? null;
        $this->Name = $menu['Name'] ?? null;
        $this->Link = $menu['Link'] ?? null;
        $this->Parent = $menu['Parent'] ?? null;
        $this->Theme = $menu['Theme'] ?? null;
        $this->Groups = $menu['Groups'] ?? null;
        $this->OrderBy = $menu['OrderBy'] ?? null;
        $this->Note = $menu['Note'] ?? null;
        $this->createDate = $menu['createDate'] ?? null;
        $this->UpdateDate = $menu['UpdateDate'] ?? null;
        parent::__construct();
    }

    function Menus($isobj = true)
    {
        return parent::Menus($isobj);
    }

    function MenuByTheme($theme, $isobj = false)
    {
        return parent::MenuByTheme($theme, $isobj);
    }

    function MenusByGroup($group, $isobj = true)
    {
        return parent::MenusByGroup($group, $isobj);
    }

    function MenusById($id, $isobj = true)
    {
        return parent::MenusById($id, $isobj);
    }
    function GetById($id)
    {
        return parent::MenusById($id, false);
    }

    function MenusByParent($prent, $isobj = true)
    {
        return parent::MenusByParent($prent, $isobj);
    }

    function AllMenus($isobj = true)
    {
        return parent::AllMenus($isobj);
    }
    function AddMenu($Menu)
    {
        return parent::AddMenu($Menu);
    }
    function EditMenu($Menu)
    {
        return parent::EditMenu($Menu);
    }




}