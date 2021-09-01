<?php

class Controller_mnews extends Controller_backend {

    public $news;
    public $page;

    function __construct() {
        $this->news = new \Model\news();
        $this->page = new \Model\pages();
        parent::__construct();
        ob_start();
        \Model\Breadcrumb::setMenuAcrive("QuanLyBaiViet");
        $this->Bread[] = [
            "title" => "Danh Sách Bài Viết",
            "link" => "/mnews/index/"
        ];
    }

    function index() {

        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "news");
    }

    function addnews() {
        if (isset($_POST["AddNews"])) {
            $a = new Model\news();
            $Page = get_class_vars(get_class($a));
            unset($Page["_conn"]);
            $img = "";
            foreach ($Page as $k => $v) {
                $Page[$k] = $this->news->Bokytusql($_POST[$k]);
            }
            $Page["ID"] = $this->news->createNewsID();
            $urlimg = "public/img/images/news/" . $Page["ID"] . "/";
            if (isset($_FILES["Fileimages"])) {
                if ($_FILES["Fileimages"]["error"] == 0) {
                    $img = $this->news->upload_image1($_FILES["Fileimages"], $urlimg, "news-" . $Page["ID"], true);
                    $img = explode("public/img/", BASE_URL . $img);
                    $img = "/public/img/" . $img[1];
                }
            }
            $Page["UrlHinh"] = $img;
            $Page["SoLanXem"] = 0;
            $Page["Stt"] = time();
            $Page["AnHien"] = isset($_POST["AnHien"]) ? $_POST["AnHien"] : 0;
            $Page["TinNoiBat"] = isset($_POST["TinNoiBat"]) ? $_POST["TinNoiBat"] : 0;
            $Page["Alias"] = $this->news->bodautv($_POST["Name"]);
            $Page["NgayDang"] = date("Y-m-d H:i:s", time());
            $this->news->AddNews($Page);
            $this->news->_header("/mnews/editnews/" . $Page["ID"]);
        }
        $Bread = new \Model\Breadcrumb();
        if (isset($this->param[0]))
            $_page = $this->page->PagesById($this->param[0]);

        $this->Bread[] = [
            "title" => "Thêm Bài Viết",
            "link" => "#"
        ];

        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "news");
    }

    function detail() {

        $data["news"] = $this->news->NewsById($this->param[0], FALSE);
        $Bread = new \Model\Breadcrumb();

        $this->Bread[] = [
            "title" => $data["news"]["Name"],
            "link" => "/"
        ];
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "page");
    }

    function deletenews() {
        $this->news->DeleteNews($this->param[0]);
        $this->news->_header($_SERVER["HTTP_REFERER"]);
    }

    function editnews() {
        if (isset($_POST["EditNews"])) {
            $a = new Model\news();
            $Page = $this->news->NewsById($_POST["ID"], FALSE);
            $img = $Page["UrlHinh"];
            if (isset($_FILES["Fileimages"])) {
                if ($_FILES["Fileimages"]["error"] == 0) {
                    $urlimg = "public/img/images/news/" . date("Y") . "/" . date("m") . "/";
                    $imgHinh = substr($img, 1);
                    if (is_file($imgHinh)) {
                        unlink($imgHinh);
                    }
                    $img = $this->news->upload_image1($_FILES["Fileimages"], $urlimg, "", true);
                    $img = explode("public/img/", BASE_URL . $img);
                    $img = "/public/img/" . $img[1];
                }
            }
            foreach ($Page as $k => $v) {
                $Page[$k] = $this->news->Bokytusql($_POST[$k]);
            }
            $Page["Alias"] = $Page["Alias"];
            $Page["UrlHinh"] = $Page["UrlHinh"];
            if (isset($_POST["TuDongCapNhat"]))
                $Page["NgayDang"] = date("Y-m-d H:i:s", time());
            $this->news->editNews($Page);
            $this->news->_header("/mnews/editnews/" . $Page["ID"]);
        }
        $data["news"] = $this->news->NewsById($this->param[0], FALSE);
        $path = "/public/img/news/" . $this->param[0] . "/";
        Model\pathCkFinder::set($path);
        $_New = new Model\news($data["news"]);
        $Bread = new \Model\Breadcrumb();
        $_Pages = $this->page->PagesById($_New->PageID);

        $this->Bread[] = [
            "title" => $_New->Name,
            "link" => "/mnews/"
        ];

        $Bread->setBreadcrumb($this->Bread);

        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "news");
    }

    function newsbypages() {
        $_Pages = $this->page->PagesById($this->param[0]);
        $Bread = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => $_Pages->Name,
            "link" => "/mpage/"
                ]
        ;
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "news");
    }

    function copy() {

        $data["news"] = $this->news->NewsById($this->param[0], FALSE);
        $_New = new Model\news($data["news"]);
        $Bread = new \Model\Breadcrumb();
        $_Pages = $this->page->PagesById($_New->PageID);
        $this->Bread[] = [
            "title" => $_Pages->Name,
            "link" => "/mnews/newsbypages/" . $_Pages->idPa
        ];
        $this->Bread[] = [
            "title" => $_New->Name,
            "link" => "/mnews/"
        ];

        $Bread->setBreadcrumb($this->Bread);

        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "news");
    }

    function getPages() {
        $a = $this->news->PagesByType(1, FALSE);
        foreach ($a as $k => $value) {

        }
        echo $this->news->_encode($a);
    }

    function getnewById() {
        $a = $this->news->NewsById($this->param[0], FALSE);
        $a["Summary"] = "";
        $a["Content"] = "";
        echo $this->news->_encode($a);
    }

    function createAlias() {
        $a = $this->news->NewsById($this->param[0], FALSE);
        echo $this->news->bodautv($a["Name"]);
    }

    function getNewsByPages() {
        $a = $this->news->NewsByPagesAD($this->param[0], FALSE);
        if ($a)
            echo $this->news->_encode($a);
        else
            echo "[]";
    }

    function addtags() {
        try {
            $Model["IdNews"] = Model\CheckInput::ChekInput($_POST["idnews"]);
            $Model["IdTags"] = Model\CheckInput::ChekInput($_POST["idtags"]);
            $modelTag = new Model\tags\tags($Model["IdTags"]);
            $Model["Id"] = \lib\Common::getGUID();
            if ($modelTag->Id == null) {
                throw new Exception("Không có tags");
            }
            $Model["Name"] = $modelTag->Name;
            $tagsDetail = new Model\tags\tagsDetail();
            $tagsDetail->Post($Model);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    function gettagsbynews() {
        try {
            $Id = Model\CheckInput::ChekInput($_POST["id"]);
            $tagsDetail = new Model\tags\tagsDetail();
            $tags = $tagsDetail->GetByNewsId($Id);
            $str = "";
            foreach ($tags as $value) {
                $_tagDetai = new Model\tags\tagsDetail($value);
                $str .= <<<TABLETR
                        <label class="btn btn-default" >
                           {$_tagDetai->Name}
                            <button title="Xóa Tags Này?" data-idnews="{$_tagDetai->IdNews}" data-id="{$_tagDetai->Id}"
                                    class="no-border btn-xoaTags " type="button" >
                                <i class="fa fa-times" ></i>
                            </button>
                        </label>

TABLETR;
            }
            echo $str;
        } catch (Exception $exc) {

        }
    }

    function delatetags() {
        try {
            $Id = Model\CheckInput::ChekInput($_POST["id"]);
            $tagsDetail = new Model\tags\tagsDetail();
            $tagsDetail->Delete($Id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    function addnewtags() {
        try {
            $tagsName = Model\CheckInput::ChekInput($_POST["tagsName"]);
            $idnews = Model\CheckInput::ChekInput($_POST["idnews"]);
            if ($tagsName == "") {
                throw new Exception("Không có tên");
            }
            $tagsModel = new Model\tags\tags();
            $tagsDetail = $tagsModel->GetByNameDetail($tagsName);
            if ($tagsDetail == null) {
                $model["Id"] = \lib\Common::getGUID();
                $model["Name"] = $tagsName;
                $model["Alias"] = \lib\Common::bodautv($tagsName);
                $tagsModel->Post($model);
                $modelTag["Id"] = \lib\Common::getGUID();
                $modelTag["IdTags"] = $model["Id"];
                $modelTag["IdNews"] = $idnews;
                $modelTag["Name"] = $tagsName;
                $modelTag["Alias"] = $model["Alias"];
                $ModeltagsDetail = new Model\tags\tagsDetail();
                $ModeltagsDetail->Post($modelTag);
            } else {
                // đã có tags
                $modelTag["Id"] = \lib\Common::getGUID();
                $modelTag["IdTags"] = $tagsDetail["Id"];
                $modelTag["IdNews"] = $idnews;
                $modelTag["Name"] = $tagsName;
                $modelTag["Alias"] = \lib\Common::bodautv($tagsName);
                $ModeltagsDetail = new Model\tags\tagsDetail();
                $ModeltagsDetail->Post($modelTag);
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            header('HTTP/1.1 404 Not Found');
        }
    }

    function __destruct() {
        $str = ob_get_clean();
        $params = parse_ini_file(__DIR__ . '/../public/language/editnews.ini', true);
        $DSOption = $params;
        if ($DSOption)
            foreach ($DSOption as $k => $value) {
                $str = str_replace($k, $value, $str);
            }
        echo $str;
    }

}

?>