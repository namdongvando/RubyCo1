<?php

//Chứa các hàm với csdl

namespace Model;

//ALt + Enter
class Database extends \Model\iDatabase {

//    kết nối CSDL
    function __construct() {
        parent::__construct();
    }

    public function notOrEmpty($param0, $defaul) {
        if (!isset($$param0))
            return $defaul;
        if ($param0 == null)
            return $defaul;
        return $param0;
    }

    public function Category4Id($id, $isObj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `catID` = '{$id}'";
        $this->Query($sql);
        if ($isObj) {
            $a = $this->fetchRow();
            return new \Model\Category($a);
        } else {
            return $this->fetchRow();
        }
    }

    public function Categorys() {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `parentCatID` = 0 and `Public` = 1";
        $this->Query($sql);
        $a = $this->fetchAllObj("Model\\Category");
        return $a;
    }

    public function getCategorys($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `Public` = 1 order by `Serial` ";
        $this->Query($sql);
        if ($isobj) {
            $a = $this->fetchAllObj("Model\\Category");
            return $a;
        }
        return $this->fetchAll();
    }

    public function Categorys4Name($Name) {

    }

    public function Categorys4IDParent($idParent) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `parentCatID` = '{$idParent}' and `Public` = 1 order by `Serial`";
        $this->Query($sql);
        $a = $this->fetchAllObj("Model\\Category");
        return $a;
    }

    public function AllCategorys4IDParent($idParent) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `parentCatID` = '{$idParent}'  order by `Serial`";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

    public function CategorysID4IDParent($idParent = []) {
        $idParent = implode(",", $idParent);
        $sql = "SELECT `catID` FROM `" . table_prefix . "categories` where `parentCatID` in ($idParent)  and `Public` = 1 order by `Serial`";
        $this->Query($sql);
        return $this->fetchArrayByColum("catID");
    }

    static function listerror() {
        return [
            -101 => "Mã danh mục và mã danh mục cha trùng nhau"
            , -102 => "Mã danh mục không thể là con của danh mục con"
            , -201 => "Bạn không có quền xóa danh mục này"
            , -202 => "Bạn không thể xóa danh mục có danh mục con"
            , -203 => "Danh mục đang có sản phẩm không thể xóa"
        ];
    }

    function getError($id) {
        $a = self::listerror();
        return $a[$id];
    }

    function checkParentCatID($idcat, $parentcatid) {
//        khong thể trùng nhau
        if ($idcat == $parentcatid) {
            return -101;
        }
//       không thể là con của danh mục con
        $listCatID = [];
        $this->AllCategoryByParentID([$idcat], $listCatID);
        $parentcatid = strval($parentcatid);
        if (in_array($parentcatid, $listCatID, TRUE)) {
            return -102;
        }
        return 1;
    }

    public function EditCategory($Category) {
//        kiểm tra id parent có vấn dề hay không
        $kt = $this->checkParentCatID($Category["catID"], $Category["parentCatID"]);
        if ($kt < 0) {
            return $kt;
        }
        $sql = "UPDATE `" . table_prefix . "categories` SET "
                . "`Path` = '{$Category["Path"]}', "
                . "`catName` = '{$Category["catName"]}', "
                . "`Note` = '{$Category["Note"]}', "
                . "`Link` = '{$Category["Link"]}', "
                . "`parentCatID` = '{$Category["parentCatID"]}', "
                . "`banner` = '{$Category["banner"]}', "
                . "`Lang` = '{$Category["Lang"]}', "
                . "`Serial` = '{$Category["Serial"]}', "
                . "`Public` = '{$Category["Public"]}' "
                . "WHERE `catID` = '{$Category["catID"]}'";

        $this->Query($sql);
        $this->Luu();
        $this->relEditCategorys($Category["catID"], FALSE);
        return 1;
    }

    public function AddCategory($Category) {
        $sql = "INSERT INTO `" . table_prefix . "categories` SET "
                . "`Path` = '{$Category["Path"]}', "
                . "`catName` = '{$Category["catName"]}', "
                . "`Link` = '{$Category["Link"]}', "
                . "`Note` = '{$Category["Note"]}', "
                . "`Lang` = '{$Category["Lang"]}', "
                . "`parentCatID` = '{$Category["parentCatID"]}', "
                . "`banner` = '{$Category["banner"]}', "
                . "`Serial` = '{$Category["Serial"]}', "
                . "`Public` = '{$Category["Public"]}' ";
        $this->Query($sql);
        $this->Luu();
        return $this->Category4Path($Category["Path"], FALSE);
    }

    public function AddCategory1($Category) {
        $sql = "INSERT INTO `" . table_prefix . "categories` SET "
                . "`catID` = '{$Category["catID"]}', "
                . "`Path` = '{$Category["Path"]}', "
                . "`catName` = '{$Category["catName"]}', "
                . "`Link` = '{$Category["Link"]}', "
                . "`Note` = '{$Category["Note"]}', "
                . "`Lang` = '{$Category["Lang"]}', "
                . "`parentCatID` = '{$Category["parentCatID"]}', "
                . "`banner` = '{$Category["banner"]}', "
                . "`Serial` = '{$Category["Serial"]}', "
                . "`Public` = '{$Category["Public"]}' ";
        $this->Query($sql);
        $this->Luu();
        return $this->Category4Path($Category["Path"], FALSE);
    }

    public function Products() {
        $sql = "SELECT * FROM `" . table_prefix . "product`";
        $this->Query($sql);
        $a = $this->fetchAllObj("Model\\Products");
        return $a;
    }

    public function ProductsAll() {
        $sql = "SELECT * FROM `" . table_prefix . "product`";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

    public function ProductsAllPT($Page = 1, $Number = 20, &$Tong = 0) {
        $Page = intval($Page);
        $Page = min($Page, 1);
        $start = ($Page - 1) * $Number;
        $sql = "SELECT count(*) as `Tong` FROM `" . table_prefix . "product` where 1";
        $this->Query($sql);
        $a = $this->fetchRow();
        $Tong = intval($a["Tong"]);
        $sql = "SELECT * FROM `" . table_prefix . "product` where 1 limit {$start},{$Number} ";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

    public function ProductsHotNew($num) {
        $sql = "SELECT * FROM `" . table_prefix . "product` where 1 ORDER BY `DateCreate` DESC limit 0,{$num}";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

    public function ProductsHotView($num) {
        $sql = "SELECT * FROM `" . table_prefix . "product` where 1 ORDER BY `Views` DESC limit 0,{$num}";
        $this->Query($sql);
        $a = $this->fetchAll();
        return $a;
    }

    public function EditProducts($Product) {
        $Product["DateCreate"] = $Product["DateCreate"] != "" ? $Product["DateCreate"] : date("Y-m-d H:i:S", time());

        $sql = "UPDATE `" . table_prefix . "product` SET "
                . "`Username`='{$Product["Username"]}',"
                . "`catID`='{$Product["catID"]}',"
                . "`nameProduct`='{$Product["nameProduct"]}',"
                . "`Alias`='{$Product["Alias"]}',"
                . "`Price`='{$Product["Price"]}',"
                . "`oldPrice`='{$Product["oldPrice"]}',"
                . "`Summary`= '{$Product["Summary"]}',"
                . "`Content`='{$Product["Content"]}',"
                . "`UrlHinh`='{$Product["UrlHinh"]}',"
                . "`DateCreate`='{$Product["DateCreate"]}',"
                . "`Number`='{$Product["Number"]}',"
                . "`Note`='{$Product["Note"]}',"
                . "`BuyTimes`='{$Product["BuyTimes"]}',"
                . "`Views`='{$Product["Views"]}',"
                . "`isShow`='{$Product["isShow"]}',"
                . "`Serial`='{$Product["Serial"]}',"
                . "`lang`= '{$Product["lang"]}' WHERE `ID` = '{$Product["ID"]}'";
        $this->Query($sql);
        return $this->Luu();
    }

    public function AddProducts($Product) {
        $Product["DateCreate"] = $Product["DateCreate"] != "" ? $Product["DateCreate"] : date("Y-m-d H:i:S", time());
        $sql = "INSERT INTO `" . table_prefix . "product` SET "
                . "`ID`='{$Product["ID"]}',"
                . "`Username`='{$Product["Username"]}',"
                . "`catID`='{$Product["catID"]}',"
                . "`nameProduct`='{$Product["nameProduct"]}',"
                . "`Alias`='{$Product["Alias"]}',"
                . "`Price`='{$Product["Price"]}',"
                . "`oldPrice`='{$Product["oldPrice"]}',"
                . "`Summary`= '{$Product["Summary"]}',"
                . "`Content`='{$Product["Content"]}',"
                . "`UrlHinh`='{$Product["UrlHinh"]}',"
                . "`DateCreate`='{$Product["DateCreate"]}',"
                . "`Number`='{$Product["Number"]}',"
                . "`Note`='{$Product["Note"]}',"
                . "`BuyTimes`='{$Product["BuyTimes"]}',"
                . "`Views`='{$Product["Views"]}',"
                . "`isShow`='{$Product["isShow"]}',"
                . "`Serial`='{$Product["Serial"]}',"
                . "`lang`= '{$Product["lang"]}'";
        $this->Query($sql);
        return $this->Luu();
    }

    protected function ProductsByName($Name, $page, $number, &$sum) {
        $page = intval($page);
        $page = max(1, $page);
        $sum = 0;
        $NameAlias = $this->bodautv($Name);
        $NameAlias = str_replace("-", "_", $Name);
        $where = " `nameProduct` like '%{$Name}%' or `Alias` like '%{$NameAlias}%' ";
        $select = "SELECT COUNT(`ID`) as `Tong` FROM `" . table_prefix . "product` "
                . "where {$where}";
        $this->Query($select);
        $a = $this->fetchRow();
        $sum = intval($a["Tong"]);
        $vt = ($page - 1) * $number;
        $limit = " limit {$vt},{$number} ";
        $select = "SELECT `ID`, `Username`, `catID`,`Alias`, `nameProduct`, `Price`, `oldPrice`, `UrlHinh`, `DateCreate`, "
                . "`Number`, `Note`, `BuyTimes`, `Views`, `isShow`, `lang` FROM `" . table_prefix . "product` "
                . "where {$where} {$limit}";
        $this->Query($select);
        return $this->fetchAll();
    }

    public function ProductsByCatID($CatId, $page, $number, &$sum) {
        $start = ($page - 1) * $number;
        $start = max(0, $start);

        $CatId = is_array($CatId) ? implode(',', $CatId) : $CatId;
        $sql = "SELECT Count(*) as `Tong` FROM `" . table_prefix . "product` "
                . "where `catID` in ({$CatId})";
        $this->Query($sql);
        $a = $this->fetchAll();
        if (!$a["Tong"] == 0) {
            $sum = 0;
            return null;
        }

        $sum = $a["Tong"];
        $sql = "SELECT *"
                . "FROM `" . table_prefix . "product` "
                . "where `catID` in ({$CatId}) order by `catID` limit {$start},{$number} ";
        $this->Query($sql);
        return $this->fetchAll();
    }

    public function ProductsByID($Id, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "product` where `ID` = '{$Id}'";
        $this->Query($sql);

        if ($isobj) {
            return new \Model\Products($this->fetchRow());
        }
        return $this->fetchRow();
    }

    public function Category4Id2Array($id) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `catID` = '{$id}' and `Public` = 1";
        $this->Query($sql);
        return $this->fetchRow();
    }

    public function AllCategorys($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `Public` >= 0 order by `Serial`";
        $this->Query($sql);
        if ($isobj) {
            $a = $this->fetchAllObj("Model\\Category");
            return $a;
        }
        return $this->fetchAll();
    }

    public function Category4Path($Path, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `Path` = '{$Path}' and `Public` >= 0";
        $this->Query($sql);
        $a = $this->fetchRow();
        if ($isobj)
            return new \Model\Category($a);
        return $a;
    }

    public function Advs($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "adv`";
        $this->Query($sql);
        if ($isobj) {
            $a = $this->fetchAllObj("\model\adv");
            return $a;
        } else {
            return $this->fetchAll();
        }
    }

    public function AdvsByGroup($Group, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "adv` where `Group` = '{$Group}' and `isShow` > 0 order by `isShow`";
        $this->Query($sql);
        if ($isobj) {
            $a = $this->fetchAllObj("\model\adv");
            return $a;
        }
        return $this->fetchAll();
    }

    public function AdvsById($ID, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "adv` where `ID` = '{$ID}'";
        $this->Query($sql);
        $a = $this->fetchRow();
        if ($isobj)
            return new \Model\adv($a);
        return $a;
    }

    public function AllProductsByCatID($CatId) {
        $sql = "SELECT * FROM `" . table_prefix . "product` where `catID` = '{$CatId}'";
        $this->Query($sql);
        $a = $this->fetchAllObj("Model\\Products");
        return $a;
    }

//    admin
    public function AddUsername($UserName) {

    }

    public function Admin($Group, $isobj = true) {

    }

    public function Admin4Username($Username, $isobj = true) {

    }

    public function Admins($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "admin` WHERE 1 ";
        $this->Query($sql);
        if ($isobj)
            return $this->fetchAllObj("/Modle/Admin");
        return $this->fetchAll();
    }

    public function CheckLogin($Username, $Password, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "admin` WHERE `Username` = '{$Username}' AND `Password` = SHA1(CONCAT('{$Password}',`Random`))";
        $this->Query($sql);
        if ($isobj)
            return new \Model\Admin($this->fetchRow());
        return $this->fetchRow();
    }

    public function CurentUsername($isobj = true) {

    }

    public function DeleteUsername($UserName, $Quyen = FALSE) {

    }

    public function EditAdmin($User) {

    }

    public function EditPassword4Username($username, $password) {

    }

    public function UserInfor($username, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "admin` WHERE `Username` = '{$username}'";
        $this->Query($sql);
        if ($isobj)
            return new \Model\Admin($this->fetchRow());
        return $this->fetchRow();
    }

    public function editPassword($User) {

    }

    public function relEditCategorys($catID, $isobj = true) {
        $listCatID = [];
        $this->AllCategoryByParentID([$catID], $listCatID);
        foreach ($listCatID as $catID) {
            $M_Cat = new \Model\Category();
            $_Cat = $M_Cat->Category4Id($catID, FALSE);
            $_Cat["Path"] = $M_Cat->bodautv($_Cat["catName"]);
            $_Cat["Link"] = $M_Cat->getlinkCategoryByID($_Cat["catID"]);
            $this->EditCategory($_Cat);
        }
        return;
    }

    function AllCategoryByParentID($catID, &$listCatID) {
        $a = $this->CategorysID4IDParent($catID);
        if (!$a) {
            return;
        }
        $listCatID = array_merge($listCatID, $a);
        return $this->AllCategoryByParentID($a, $listCatID);
    }

    public function relDeleteCategorys($catID) {
//        Xóa các Sản phẩm của danh muc và các sản phẩm của các danh muc con
//        sách danh muc con
        $listCatID = [];
        $this->AllCategoryByParentID([$catID], $listCatID);
        $listCatID[] = strval($catID);
        $Model_Producs = new \Model\Products();
//        cập nhật trang thái về ản /xóa sản phẩm
        $Model_Producs->DeleteProductsByListCategory($listCatID);
//        cập nhật trang thái về ản /xóa danh mục
        $Model_Producs->DeleteCategoryByListCategory($listCatID);
        return true;
    }

    public function DeleteCategory($catID) {
        return $this->relDeleteCategorys($catID);
//        xóa các sam của danh mucl
    }

    public function DeleteProductsByListCategory($listCategory = array()) {
        if (!$listCategory) {
            return;
        }
        $listCategory = implode(",", $listCategory);
        $sql = "UPDATE `" . table_prefix . "product` SET `isShow` = (`isShow` - 1) WHERE `catID` in ({$listCategory})";
        $this->Query($sql);
        $this->Luu();
        $sql = "DELETE FROM `" . table_prefix . "product` WHERE `catID` in ({$listCategory}) and `isshow` <= -1";
        $this->Query($sql);
        $this->Luu();
    }

    public function DeleteCategoryByListCategory($listCatId = []) {
        if (!$listCatId) {
            return;
        }
        $listCatId = implode(",", $listCatId);
        $sql = "UPDATE `" . table_prefix . "categories` SET `Public` = (`Public` - 2) WHERE `catID` in ({$listCatId})";
        $this->Query($sql);
        $this->Luu();
        $sql = "DELETE FROM `" . table_prefix . "categories` WHERE `catID` in ({$listCatId}) and `Public` < '-2'";
        $this->Query($sql);
        $this->Luu();
    }

    public function getGroupsAdv($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "adv` group by `Group`";
        $this->Query($sql);
        if ($isobj) {
            $a = $this->fetchAllObj("\model\adv");
            return $a;
        } else {
            return $this->fetchAll();
        }
    }

    public function AddAdv($Adv) {
        $sql = "INSERT INTO `" . table_prefix . "adv` SET "
                . "`Name` = '{$Adv["Name"]}', "
                . "`Content` = '{$Adv["Content"]}', "
                . "`Attribute` = '{$Adv["Attribute"]}', "
                . "`DataAttribute` = '{$Adv["DataAttribute"]}', "
                . "`Group` = '{$Adv["Group"]}', "
                . "`isShow` = '{$Adv["isShow"]}', "
                . "`Urlimages` = '{$Adv["Urlimages"]}', "
                . "`createDate` = NOW(), "
                . "`updateDate` = NOW(), "
                . "`Link` = '{$Adv["Link"]}' ";
        $this->Query($sql);
        return $this->SaveInsert();
    }

    public function EditAdv($Adv) {
        $sql = "UPDATE `" . table_prefix . "adv` SET "
                . "`Name` = '{$Adv["Name"]}', "
                . "`Content` = '{$Adv["Content"]}', "
                . "`Attribute` = '{$Adv["Attribute"]}', "
                . "`DataAttribute` = '{$Adv["DataAttribute"]}', "
                . "`Group` = '{$Adv["Group"]}', "
                . "`isShow` = '{$Adv["isShow"]}', "
                . "`Urlimages` = '{$Adv["Urlimages"]}', "
                . "`updateDate` = NOW(), "
                . "`Link` = '{$Adv["Link"]}' "
                . "WHERE `ID` = '{$Adv["ID"]}'";
        $this->Query($sql);
        return $this->Luu();
    }

    public function DeleteAdv($Adv) {
        $sql = "DELETE FROM `" . table_prefix . "adv` WHERE `ID` = '{$Adv}'";
        $this->Query($sql);
        return $this->Luu();
    }

    public function DeleteAdvByGroup($Group) {

    }

    public function getGroupAdvByID($Group, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "adv` where `Group` = '{$Group}'";
        $this->Query($sql);
        if ($isobj) {
            return new \Model\adv($this->fetchRow());
        } else {
            return $this->fetchRow();
        }
    }

    public function ProductsByAlias($Alias, $isobj) {
        $sql = "SELECT * FROM `" . table_prefix . "product` WHERE `Alias` = '{$Alias}'";
        $this->Query($sql);
        $a = $this->fetchRow();
        if ($isobj) {
            return new \Model\Products($a);
        } else {
            return $a;
        }
    }

    public function Menus($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` WHERE 1";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\Menu");
        }
        return $this->fetchAll();
    }

    public function AddMenu($Menu) {
        $this->insert(table_prefix . "menu", $Menu);
        return $Menu["IDMenu"];
    }

    public function MenusByGroup($group, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` WHERE  `Groups` = '{$group}'";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\Menu");
        }
        return $this->fetchAll();
    }

    public function MenusById($id, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` WHERE  `IDMenu` = '{$id}'";
        $this->Query($sql);
        if ($isobj) {
            return new Model\Menu($this->fetchRow());
        }
        return $this->fetchRow();
    }

    public function MenusByParent($prent, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` WHERE  `Parent` = '{$prent}'";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\Menu");
        }
        return $this->fetchAll();
    }

    public function AllMenus($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "menu` Group BY `Groups`";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\Menu");
        }
        return $this->fetchAll();
    }

    public function AddPages($data) {
        return $this->insert(table_prefix . "pages", $data);
    }

    public function AllPages($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` WHERE 1";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\pages");
        }
        return $this->fetchAll();
    }

    public function DeletePages($Id) {
        $this->delete(table_prefix . "pages", " `idPa` = '{$Id}'");
    }

    public function Pages($isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` WHERE 1";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\pages");
        }
        return $this->fetchAll();
    }

    public function PagesByGroup($group, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` WHERE `idGroup` = '{$group}'";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\pages");
        }
        return $this->fetchAll();
    }

    public function IdPagesByGroup($group, $isobj = true) {
        $sql = "SELECT `idPa` FROM `" . table_prefix . "pages` WHERE `idGroup` = '{$group}'";
        $this->Query($sql);
        if ($isobj) {
            return $this->fetchAllObj("\Model\pages");
        }
        return $this->fetchAll();
    }

    public function PagesById($id, $isobj = true) {
        $sql = "SELECT * FROM `" . table_prefix . "pages` WHERE  `idPa` = '{$id}' ";
        $this->Query($sql);
        if ($isobj) {
            return new \Model\pages($this->fetchRow());
        }
        return $this->fetchRow();
    }

    function update($tableName, $data, $pk) {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $this->BoHieuUngSQL($value));
        }
        $sql = sprintf("UPDATE `%s` SET %s WHERE %s", $tableName, implode(', ', $fields), $pk);

        $this->Query($sql);
        return $this->Luu();
    }

    function insert($tableName, $data) {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = sprintf('`%s` = "%s" ', $key, $this->BoHieuUngSQL($value));
        }
        $sql = sprintf("INSERT INTO `%s` SET %s ", $tableName, implode(', ', $fields));

        $this->Query($sql);
        return $this->SaveInsert();
    }

    function select($tableName, $listColum = [], $pk = "1", $className = "") {
        $select = " * ";
        if ($listColum) {
            $fields = [];
            foreach ($listColum as $value) {
                $fields[] = sprintf("`%s`", $value);
            }
            $select = implode(",", $fields);
        }
        $sql = sprintf("SELECT %s FROM `%s` WHERE %s ", $select, $tableName, $pk);
//        echo sprintf("SELECT %s FROM `%s` WHERE %s ", $select, $tableName, $pk);
        $this->Query($sql);
        if ($className) {
            return $this->fetchAllObj($className);
        }
        return $this->fetchAll();
    }

    function count($tableName, $pk = "1") {
        $sql = sprintf("SELECT count(*) as `Tong` FROM `%s` WHERE %s ", $tableName, $pk);
        $this->Query($sql);
        $a = $this->fetchRow();
        return $a["Tong"];
    }

    function delete($tableName, $pk) {
        $sql = sprintf("DELETE FROM `%s` WHERE %s", $tableName, $pk);
        $this->Query($sql);
        return $this->Luu();
    }

    public function editPages($Page) {
        return $this->update(table_prefix . "pages", $Page, " `idPa` = '{$Page["idPa"]}'");
    }

    public function AddNews($Page) {
        return $this->insert(table_prefix . "news", $Page);
    }

    public function AllNews($isobj = true) {

    }

    public function DeleteNews($Id) {
        return $this->delete(table_prefix . "news", "`ID` = '{$Id}'");
    }

    public function News($isobj = true) {
        return $this->select(table_prefix . "news", [], ' 1 ORDER BY `Stt` DESC');
    }

    public function NewsIsShow($isobj = true) {
        return $this->select(table_prefix . "news", [], ' `AnHien` > 0 ORDER BY `Stt` DESC');
    }

    function NewsByAlias($alias, $paId, $isobj = true) {
//        reutur array
        $a = $this->select(table_prefix . "news", [], "`Alias` = '{$alias}' and `PageID` = '{$paId}'");
        if ($a)
            return $a[0];
        return null;
    }

    function NewsByAliasHien($alias, $paId, $isobj = true) {
//        reutur array
        $a = $this->select(table_prefix . "news", [], "`Alias` = '{$alias}' and `PageID` = '{$paId}' and `AnHien` >= 1");
        if ($a)
            return $a[0];
        return null;
    }

    public function NewsByPages($pages, $isobj = true) {
        if (!$isobj)
            return $this->select(table_prefix . "news", [], "`PageID` = '{$pages}' and `AnHien` >= 1  ORDER BY `STT` DESC");
        return $this->select(table_prefix . "news", [], "`PageID` = '{$pages}' and `AnHien` >= 1 ORDER BY `STT` DESC", "\Model\news");
    }

    public function NewsByPagesTop($pages, $number) {
        $where = "`PageID` = '{$pages}' and `AnHien` >= 1  ORDER BY `STT` DESC limit 0,$number";
        return $this->select(table_prefix . "news", [], $where);
    }

    public function NewsByPagesAD($pages, $isobj = true) {
        $a = ["ID",
            "PageID",
            "Name",
            "AnHien",
            "NgayDang",
            "UrlHinh",
            "TinNoiBat",
            "SoLanXem",
            "Stt"];
        if (!$isobj)
            return $this->select(table_prefix . "news", $a, "`PageID` = '{$pages}'");
        return $this->select(table_prefix . "news", $a, "`PageID` = '{$pages}'", "\Model\news");
    }

    public function NewsByPagesLimitNumber($pages, $number, $isobj = true) {
        if (!$isobj)
            return $this->select(table_prefix . "news", [], "`PageID` = '{$pages}' limit 0,{$number}");
        return $this->select(table_prefix . "news", [], "`PageID` = '{$pages}' limit 0,{$number}", "\Model\news");
    }

    public function NewsById($id, $isobj = true) {
        if (!$isobj) {
            $a = $this->select(table_prefix . "news", [], "`ID` = '{$id}'");
            return $a[0];
        }
        $a = $this->select(table_prefix . "news", [], "`ID` = '{$id}'", "\Model\news");
        return $a[0];
    }

    public function editNews($Page) {
        $this->update(table_prefix . "news", $Page, "`ID` = '{$Page["ID"]}'");
    }

    public function PagesByType($type, $isobj = true) {
        if ($isobj) {
            return $this->select(table_prefix . "pages", [], " `Type` = '{$type}' and `isShow` > 0 ", "\Model\pages");
        }
        return $this->select(table_prefix . "pages", [], " `Type` = '{$type}' and `isShow` > 0 ");
    }

    public function MenuByTheme($theme, $isobj = true) {
        if ($isobj) {
            return $this->select(table_prefix . "menu", [], " `Theme` = '{$theme}' GROUP BY `Groups` ", "\Model\Menu");
        }
        return $this->select(table_prefix . "menu", [], " `Theme` = '{$theme}' GROUP BY `Groups` ");
    }

    public function MenuByGroupTheme($theme, $group, $isobj = true) {
        if ($isobj) {
            return $this->select(table_prefix . "menu", [], " `Theme` = '{$theme}' and `Groups` = '{$group}' ", "\Model\Menu");
        }
        return $this->select(table_prefix . "menu", [], " `Theme` = '{$theme}' and `Groups` = '{$group}' ");
    }

    public function MenuByGroupThemeParent($theme, $group, $parent = 0, $isobj = true) {
        if ($isobj) {
            return $this->select(table_prefix . "menu", [], " `Parent` = '{$parent}' and `Theme` = '{$theme}' and `Groups` = '{$group}' Order by `OrderBy` ", "\Model\Menu");
        }
        return $this->select(table_prefix . "menu", [], " `Parent` = '{$parent}' and `Theme` = '{$theme}' and `Groups` = '{$group}' Order by `OrderBy`");
    }

    public function AllTheme($isobj = true) {
        if ($isobj)
            return $this->select(table_prefix . "menu", [], " 1 GROUP BY `Theme`");
        return $this->select(table_prefix . "menu", [], " 1 GROUP BY `Theme`");
    }

    function getIDAutoIncerement($tableName) {
        global $INI;
        $sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $INI["DBname"] . "' AND TABLE_NAME = '{$tableName}'";
        $this->Query($sql);
        $a = $this->fetchRow();
        return $a["AUTO_INCREMENT"];
    }

    function createID($tableName) {
        $a = $this->getIDAutoIncerement($tableName);
        return $a;
    }

    function DeleteMenu($id) {
        return $this->delete(table_prefix . "menu", "`IDMenu` = '{$id}'");
    }

    public function EditMenu($menu) {
        return $this->update(table_prefix . "menu", $menu, "`IDMenu` = '{$menu["IDMenu"]}'");
    }

    public function PagesByPK($pk) {
        return $this->select(table_prefix . "pages", [], $pk);
    }

    public function PagesByAlias($Alias, $isobj = true) {
        $a = $this->select(table_prefix . "pages", [], "`Alias` = '{$Alias}'");
        if ($isobj) {
            return new \Model\pages($a[0]);
        }
        if ($a)
            return $a[0];
        return null;
    }

    public function PagesByAliasIsShow($Alias, $isobj = true) {
        $a = $this->select(table_prefix . "pages", [], " `IsShow` > 0 and  `Alias` = '{$Alias}'");
        if ($isobj) {
            return new \Model\pages($a[0]);
        }
        if ($a)
            return $a[0];
        return null;
    }

    function PagesMin() {
        return $this->select(table_prefix . "pages", [], " 1 ");
    }

//    public function Slides($isobj = true) {
//        return $this->select(table_prefix . "slide", [], " 1 ");
//    }
//
//    public function SlidesByTheme($theme, $isobj = true) {
//        return $this->select(table_prefix . "slide", [], " `Theme` = '{$theme}' ");
//    }
//
//    public function SlidesByThemeGroup($theme, $group, $isobj = true) {
//        return $this->select(table_prefix . "slide", [], " `Theme` = '{$theme}' and `Groups` ='{$group}' ");
//    }
//
//    public function AddSlides($Slide) {
//        return $this->insert(table_prefix . "slide", $Slide);
//    }
//
//    public function DeleteSlides($Slide) {
//        return $this->delete(table_prefix . "slide", "'ID' = '{$Slide["ID"]}'");
//    }
//
//    public function EditSlides($Slide) {
//        return $this->update(table_prefix . "slide", $Slide, "'ID' = '{$Slide["ID"]}'");
//    }
//
//    public function SlideByID($ID, $isobj = true) {
//        $a = $this->select(table_prefix . "slide", [], " `ID` = '{$ID}' ");
//        return $a[0];
//    }
//    admin
}
