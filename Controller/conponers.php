<?php

use Model\ChamSocKhachHang\NhanVien;

class Controller_conponers extends Controller_index
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function btnGroupSocial()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function HuongDanThongTin()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function ChinhSach()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function Menu()
    {
        $_menu = new \Model\Menu();
        $menuName = $this->getParam()[0];
        $a = $_menu->MenuByGroupThemeParent("home", $menuName, 0, FALSE);
        $this->ViewTheme(["ItemsMenu" => $a], Model_ViewTheme::get_viewthene(), "non");
    }
    public function HopTacTaiTro()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function NhanVien()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme(["NhanViens" => NhanVien::GetToArray()["NhanVien"]], Model_ViewTheme::get_viewthene(), "non");
    }
    public function TagsHtml()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme(["NhanViens" => NhanVien::GetToArray()["NhanVien"]], Model_ViewTheme::get_viewthene(), "non");
    }
    public function Hotline()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function Address()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function About()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function DoiTac()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function SanPhamPhoBien()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
    public function TaiSaoChonChungToi()
    {
        // var_dump(NhanVien::GetToArray());
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "non");
    }
}
