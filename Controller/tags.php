<?php

class Controller_tags extends Controller_backend {

    function __construct() {
        parent::__construct();
        \Model\Breadcrumb::setMenuAcrive("QuanLyBaiViet");
    }

    function index() {
        $this->Bread[] = [
            "title" => "Tags",
            "link" => "#"
        ];
        $Bread = new \Model\Breadcrumb();
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme([], Model_ViewTheme::get_viewthene());
    }

    public function post() {
        if (isset($_POST[\Model\tags\tagsForm::FormName])) {
            $model = $_POST[\Model\tags\tagsForm::FormName];
            foreach ($model as $k => $value) {
                $model[$k] = Model\CheckInput::ChekInput($value);
            }
//            $model["Id"] =
            $model["Id"] = \lib\Common::getGUID();
            if ($model["Alias"] == "") {
                $model["Alias"] = \lib\Common::bodautv($model["Name"]);
            }
            $mf = new Model\tags\tags();
            $mf->Post($model);
            \lib\Common::ToUrl('/tags/');
        }
        $this->Bread[] = [
            "title" => "Tags",
            "link" => "/tags/"
        ];
        $this->Bread[] = [
            "title" => "Thêm",
            "link" => "#"
        ];
        $Bread = new \Model\Breadcrumb();
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "news");
    }

    public function delete() {

        $this->ViewTheme([], Model_ViewTheme::get_viewthene());
    }

    public function detail() {
        $this->ViewTheme([], Model_ViewTheme::get_viewthene());
    }

    public function put() {
        $mf = new Model\tags\tags();
        if (isset($_POST[\Model\tags\tagsForm::FormName])) {
            $model = $_POST[\Model\tags\tagsForm::FormName];
            if (isset($_POST[\Model\tags\tagsForm::NameXoa])) {
                $mf->Delete($model["Id"]);
                \lib\Common::ToUrl('/tags/');
                exit();
            }
            foreach ($model as $k => $value) {
                $model[$k] = Model\CheckInput::ChekInput($value);
            }
            if ($model["Alias"] == "") {
                $model["Alias"] = \lib\Common::bodautv($model["Name"]);
            }
            $mf->Put($model);
            \lib\Common::ToUrl('/tags/');
        }
        $this->Bread[] = [
            "title" => "Tags",
            "link" => "/tags/"
        ];
        $this->Bread[] = [
            "title" => "Sửa",
            "link" => "#"
        ];
        $Bread = new \Model\Breadcrumb();
        $Bread->setBreadcrumb($this->Bread);
        $id = $this->getParam()[0];
        $tagsModel = $mf->GetById($id);
        $this->ViewTheme(["tags" => $tagsModel], Model_ViewTheme::get_viewthene());
    }

}

?>