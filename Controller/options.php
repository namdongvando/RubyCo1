<?php

class Controller_options extends Application
{

    public function __construct()
    {
        new Controller_backend();
        // Model_ViewTheme::set_viewthene("backend");
    }

    public function delete()
    {
        $Id = \Model\Request::Get("id", null);
        if ($Id) {
            $option = new \Model\OptionsService($Id);
            $option->Delete($Id);
            new \Model\Error(["Type" => \Model\Error::success, "Content" => "Đã Xóa Danh Mục"]);
            \Model\Common::ToUrl("/options/index/" . $option->GroupsId);
        }
    }

    public function index()
    {

        if (\Model\Request::Post('op', [])) {
            try {
                $opPost = \Model\Request::Post('op', []);
                $options = new \Model\OptionsService();
                $opPost["IsPublic"] = 1;
                $options->Post($opPost);
            } catch (\Exception $ex) {
                new \Model\Error("danger", "Không Thể Thêm. Mã  Này");
            }
        }

        $options = new \Model\OptionsService();
        $params["keyword"] = isset($_GET["keyword"]) ? \Model\Common::TextInput($_GET["keyword"]) : "";
        $params["GroupsId"] = $_GET["GroupsId"] ?? "setting";
        $indexPage = isset($_GET["indexPage"]) ? intval($_GET["indexPage"]) : 1;
        $indexPage = max(1, $indexPage);
        $pageNumber = isset($_GET["pageNumber"]) ? intval($_GET["pageNumber"]) : 10;
        $pageNumber = max(1, $pageNumber);
        $total = 0;
        $items = $options->GetItems($params, $indexPage, $pageNumber, $total);
        $data["Items"] = $items;
        $data["indexPage"] = $indexPage;
        $data["pageNumber"] = $pageNumber;
        $data["params"] = $params;
        $data["total"] = $total;
        // $this->View($data);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "");
    }

    public function post()
    {
        if (\Model\Request::Post('op', [])) {
            $opPost = \Model\Request::Post('op', []);
            $options = new \Model\OptionsService();
            $opPost["STT"] = $opPost["STT"] ?? 1;
            $options->Post($opPost);
        }
        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "");
    }

    public function put()
    {

        if (\Model\Request::Post('op', [])) {
            $opPost = \Model\Request::Post('op', []);
            $options = new \Model\OptionsService();
            $opPost["Name"] = \Model\Common::TextInput($opPost["Name"]);
            $opPost["STT"] = $opPost["STT"] ?? 1;
            $options->Put($opPost);
        }
        $this->ViewTheme(["item" => $this->getParam()[0]], Model_ViewTheme::get_viewthene(), "page");
    }
}
