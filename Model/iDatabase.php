<?php

namespace Model;

abstract class iDatabase extends \Model_Adapter {

    function __construct() {
        parent::__construct();
    }

    abstract function Categorys();

    abstract function AllCategorys($isobj = true);

    abstract function EditCategory($Category);

    abstract function DeleteCategory($catId);

    abstract function DeleteCategoryByListCategory($listCatId = []);

    abstract function AddCategory($Category);

    abstract function Category4Id($id, $isobj = true);

    abstract function Category4Path($Path, $isobj);

    abstract function Category4Id2Array($id);

    abstract function Categorys4Name($Name);

    abstract function Categorys4IDParent($idParent);

//    on category change
    abstract function relEditCategorys($catID, $isobj = true);

//tất cả sản phẩm
    abstract function Products();

    abstract function EditProducts($p);

    abstract function AddProducts($p);

    abstract function DeleteProductsByListCategory($listCategory = []);

//    phân trang
    abstract function ProductsByCatID($CatId, $page, $number, &$sum);

    abstract function AllProductsByCatID($CatId);

//    sản phẩm theo ID
    abstract function ProductsByID($Id);

    abstract function ProductsByAlias($Alias, $isobj);

//    ?quảng cáo 

    abstract function Advs($isobj = true);

    abstract function AdvsById($ID, $isobj = true);

    abstract function AddAdv($Adv);

    abstract function EditAdv($Adv);

    abstract function DeleteAdv($Adv);

    abstract function DeleteAdvByGroup($Group);

    abstract function getGroupAdvByID($Group, $isobj = true);

    abstract function AdvsByGroup($Group, $isobj = true);

    abstract function getGroupsAdv($isobj = true);

//    admin
    abstract function Admin($Group, $isobj = true);

    abstract function CurentUsername($isobj = true);

    abstract function UserInfor($username, $isobj = true);

    abstract function CheckLogin($Username, $Password, $isobj = true);

    abstract function EditAdmin($User);

    abstract function editPassword($User);

    abstract function EditPassword4Username($username, $password);

    abstract function DeleteUsername($UserName, $Quyen = FALSE);

    abstract function AddUsername($UserName);

    abstract function Admins($isobj = true);

    abstract function Admin4Username($Username, $isobj = true);

//    menu
    abstract function Menus($isobj = true);

    abstract function MenusByGroup($group, $isobj = true);

    abstract function EditMenu($menu);

    abstract function AddMenu($menu);

    abstract function MenusById($id, $isobj = true);

    abstract function MenusByParent($prent, $isobj = true);

    abstract function AllMenus($isobj = true);

    abstract function MenuByTheme($theme, $isobj = true);

    abstract function MenuByGroupTheme($theme, $group, $isobj = true);

    abstract function AllTheme($isobj = true);

//pages
    abstract function Pages($isobj = true);

    abstract function PagesByGroup($group, $isobj = true);
    abstract function PagesByAlias($Alias, $isobj = true);

    abstract function PagesById($id, $isobj = true);

    abstract function PagesByType($type, $isobj = true);

    abstract function AllPages($isobj = true);

    abstract function AddPages($Page);

    abstract function editPages($Page);

    abstract function DeletePages($Id);

// news
    abstract function News($isobj = true);

    abstract function NewsByPages($group, $isobj = true);
    abstract function NewsByAlias($alias,$paId, $isobj = true);

    abstract function NewsById($id, $isobj = true);

    abstract function AllNews($isobj = true);

    abstract function AddNews($Page);

    abstract function editNews($Page);

    abstract function DeleteNews($Id);

    abstract function NewsByPagesLimitNumber($pages, $number, $isobj = true);

    
    
// slide    
//    abstract function Slides($isobj = true);
//    abstract function SlideByID($ID,$isobj = true);
//
//    abstract function AddSlides($Slide);
//
//    abstract function EditSlides($Slide);
//
//    abstract function DeleteSlides($Slide);
//
//    abstract function SlidesByTheme($theme, $isobj = true);
//
//    abstract function SlidesByThemeGroup($theme, $groups, $isobj = true);
}
