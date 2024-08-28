<?php

namespace Model;

class Category extends \Model\Database
{

    public $catID;
    public $catName;
    public $Note;
    public $parentCatID;
    public $banner;
    public $Public;
    public $Path;
    public $Link;
    public $Serial;

    function __construct($Cat = null)
    {
        //        khỏi tao đối tuong
        if (!is_array($Cat)) {
            $Cat = $this->CategoryByID($Cat, false);
        }
        parent::__construct();
        $this->catID = $Cat["catID"] ?? null;
        $this->catName = $Cat["catName"] ?? null;
        $this->Note = $Cat["Note"] ?? null;
        $this->parentCatID = $Cat["parentCatID"] ?? null;
        $this->banner = $Cat["banner"] ?? null;
        $this->Public = $Cat["Public"] ?? null;
        $this->Path = $Cat["Path"] ?? null;
        $this->Link = $Cat["Link"] ?? null;
        $this->Serial = $Cat["Serial"] ?? null;
    }

    public function ColumnsTable()
    {
        return [
            "banner" => "Banner",
            "catID" => "Mã",
            "catName" => "Tên Danh Mục",
            // "Note" => "Ghi Chú",
            "parentCatID" => "Cấp Cha",
            "Public" => "Public",
            "Serial" => "Sắp Xếp",
            "Actions" => "Thao tác",
        ];
    }
    function BtnGroup()
    {
        return $this->btnPut() . $this->btnXoa();

    }
    function btnPut()
    {
        $id = $this->catID;
        return <<<BTN
        <a href="/mcategory/edit/{$id}" class="btn btn-primary" >Sửa</a>
BTN;
    }
    function btnXoa()
    {
        $id = $this->catID;
        return <<<BTN
        <a href="/mcategory/deleteid/{$id}" class="btn xoa btn-danger" >Xóa</a>
BTN;
    }
    function getIDCategoryByParentID($Id, &$listCat)
    {
        //        FILO
        $a = $this->CategoryByID($Id);
        //        thêm vào đầu mảng
        array_unshift($listCat, $a);
        if ($a->parentCatID == 0) {
            return;
        }
        //            không thì trả lại path của cha cat hien tại
        return $this->getIDCategoryByParentID($a->parentCatID, $listCat);
    }


    public function GetItems($params, $indexPage, $pageNumber, &$tong)
    {
        $indexPage = ($indexPage - 1) * $pageNumber;
        $name = $params["Name"] ?? null;
        $ispublic = $params["ispublic"] ?? null;
        $where =
            Sql::Opening(Sql::WhereLike("catName", $name, "%", "%")
                . Sql::WhereOr(Sql::WhereLike("path", $name, "%", "%")));
        if ($ispublic) {
            $where .= Sql::WhereAnd(Sql::WhereEq("public", $ispublic));
        }
        $where .= Sql::OrderBy("public", "DESC");

        $sql = "SELECT * FROM `" . table_prefix . "categories` where {$where}";
        $this->Query($sql);
        $tong = $this->GetNumRow();

        $where .= Sql::Limit($indexPage, $pageNumber);
        $sql = "SELECT * FROM `" . table_prefix . "categories` where {$where}";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function getAllIDCategoryByParentID($Id, &$listCat)
    {
        //        FILO
        $a = $this->CategoryByID($Id);
        //        thêm vào đầu mảng
        array_unshift($listCat, $a);
        //            không thì trả lại path của cha cat hien tại
        return $this->getIDCategoryByParentID($a->parentCatID, $listCat);
    }

    function Categorys()
    {
        return parent::Categorys();
    }

    function getCategorys($isobj = false)
    {
        return parent::getCategorys($isobj);
    }

    function CategoryByID($ID, $bj = true)
    {
        return parent::Category4Id($ID, $bj);
    }

    function getPathCategoryByID($Id)
    {
        $a = $this->CategoryByID($Id);
        return $a->Path;
    }

    function getAllParentCategoryByID($Id, &$path)
    {
        $a = $this->CategoryByID($Id);
        //            nếu là cha thì trả về path
        $path = BASE_DIR . $this->getPathCategoryByID($a->catID) . $path;
        if ($a->parentCatID == 0) {
            return;
        }
        //            không thì trả lại path của cha cat hien tại
        return $this->getAllParentCategoryByID($a->parentCatID, $path);
    }

    function getlinkCategoryByID($catID)
    {
        $path = "";
        $this->getAllParentCategoryByID($catID, $path);
        return $path;
    }

    function linkCurentCategory()
    {
        $this->getAllParentCategoryByID($this->catID, $path);
        return $path;
    }

    function Categorys4IDParent($id)
    {
        return parent::Categorys4IDParent($id);
    }

    function UpdateCategory()
    {
        $ala = $cat->AllCategorys();
        if ($ala)
            foreach ($ala as $_cat) {
                $catm = new \Model\Category();
                $cat = $catm->Category4Id2Array($_cat->catID);
                $catobj = new \Model\Category($cat);
                $cat["Link"] = $catobj->linkCurentCategory();
                $catm->EditCategory($cat);
            }
    }

    function EditCategory($Category)
    {
        $Category["Path"] = $this->bodautv($Category["catName"]);
        return parent::EditCategory($Category);
    }

    function getCategoryFromPath($path)
    {
        $path = explode("/", $path);
        //        var_dump($path);
        $pathcat = end($path) != "" ? end($path) : $path[count($path) - 2];
        return $pathcat;
    }

    function Category4Path($Path, $isobj = true)
    {
        return parent::Category4Path($Path, $isobj);
    }

    function Breadcrumb($id)
    {
        $listCat = [];
        $a = [];
        $this->getIDCategoryByParentID($id, $listCat);
        if ($listCat)
            foreach ($listCat as $dem => $cat) {
                $a[$dem]["link"] = $cat->linkCurentCategory();
                $a[$dem]["title"] = $cat->catName;
            }
        return $a;
    }

    function checkDeleteCategory($CatsID, $username)
    {
        //        kiểm tra quyền có hợp lệ không

        $M_auth = new \Model\Authorities();
        $kt = $M_auth->getAuthDeleteCategoryMaster($_SESSION[QuanTri]["Username"]);
        if (!$kt) {
            $kt = $M_auth->getAuthDeleteCategory($_SESSION[QuanTri]["Username"]);
            if (!$kt) {
                return -201;
            }
            //        kiểm tra có danh mục con không?
            $kt = $this->Categorys4IDParent($CatsID);
            if ($kt) {
                return -202;
            }
            //        kiểm tra có Sản phẩm không?
            $Model_Products = new \Model\Products();
            $kt = $Model_Products->AllProductsByCatID($CatsID);
            if ($kt) {
                return -203;
            }
            return 1;
        }
        return 1;
    }

    function DeleteCategory($catId)
    {
        $kt = $this->checkDeleteCategory($catId, $_SESSION[QuanTri]["Username"]);
        if ($kt < 0) {
            return $kt;
        }
        return parent::DeleteCategory($catId);
    }

    public function getCategoryFromLink($linkDanhMuc)
    {
        $sql = "SELECT * FROM `bakcodt_categories` where Link = '{$linkDanhMuc}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    public function AllCategorys4IDParent($idParent)
    {
        return parent::AllCategorys4IDParent($idParent);
    }

    public function getAllChil($parent, $user_tree_array = [])
    {

        ini_set("memory_limit", -1);
        $Child = $this->getIdCatByParents($parent);
        if ($Child) {
            foreach ($Child as $k) {
                $user_tree_array = $this->getAllChil($k, $user_tree_array);
                $user_tree_array[] = $k;
            }
        }
        return $user_tree_array;
    }

    public function getIdCatByParents($listCat)
    {
        $sql = "SELECT catID FROM `" . table_prefix . "categories` where `parentCatID` = $listCat";
        $this->Query($sql);
        return $this->fetchArrayByColum("catID");
    }

    public static function GetCatBy2Option()
    {
        $sql = "SELECT * FROM `" . table_prefix . "categories` where `Public` = 1 order by `Serial` ";
        $p = new Products();
        $res = $p->Query($sql);
        return $p->fetch2Option(["catID", "catName"]);
    }

    public function DanhMucTheoDanhMucIds($DanhSachDichVu)
    {
        $DanhSachDichVu = implode("','", $DanhSachDichVu);
        echo $sql = "SELECT * FROM `" . table_prefix . "categories` where `CatID` in ('{$DanhSachDichVu}')";
        $this->Query($sql);
        return $this->fetchArray();
    }

    function ToRow($index)
    {
        $a = (array) $this;
        $a["banner"] = <<<IMG
        <img style='height:70px' onerror="this.src='/public/no-image.jpg'" class='img img-reponsive' src='{$a["banner"]}' >
IMG;
        return $a;

    }
}