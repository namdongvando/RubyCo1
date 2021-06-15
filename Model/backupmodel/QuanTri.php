<?php

class Model_QuanTri extends Model_Adapter {

    public $email;
    public $HoTen;
    public $SDT;
    public $DiaChi;
    public $Nhom;
    public $usrname;
    public $TenNhom;
    static public $LisNhom = array("0" => "Tổng Tư Lệnh", "1" => "Quản Lý", "2" => "Biên Tập Viên");

    function __construct($NhanVien = NULL) {
        if ($NhanVien) {
            $this->email = isset($NhanVien['email']) ? $NhanVien['email'] : '';
            $this->HoTen = isset($NhanVien['HoTen']) ? $NhanVien['HoTen'] : '';
            $this->SDT = isset($NhanVien['SDT']) ? $NhanVien['SDT'] : '';
            $this->DiaChi = isset($NhanVien['DiaChi']) ? $NhanVien['DiaChi'] : '';
            $this->Nhom = isset($NhanVien['Nhom']) ? $NhanVien['Nhom'] : 2;
            $this->TenNhom = $this->HienTenNhom($this->Nhom);
            $this->usrname = $NhanVien['username'];
        }
        parent::__construct();
    }

    function getListNhom() {
        return self::$LisNhom;
    }

    function NhanVienHienTai() {
        return $_SESSION[QuanTri];
    }

    function HienTenNhom($idNhom) {
        $a = self::$LisNhom;
        return $a[$idNhom];
    }

    function ThongTinUser() {
        $sql = "SELECT * FROM `" . table_prefix . "quantri` where `username` = '{$_SESSION[QuanTri]['username']}'";
        $this->Query($sql);
        return $this->fetchRow($kq);
    }

    function KienTraDangNhap($KhachHang) {
        $sql = "SELECT * FROM `" . table_prefix . "quantri` where `username` = '{$KhachHang['Username']}' and `password` = SHA1(concat('{$KhachHang['Password']}',`random`))";
        $this->Query($sql);
        return $this->fetchRow($kq);
    }

    function SuaThongTin($User) {
        $sql = "UPDATE `" . table_prefix . "quantri` SET "
                . "`HoTen` = '{$User['HoTen']}',"
                . "`email` = '{$User['email']}',"
                . "`SDT` = '{$User['SDT']}',"
                . "`DiaChi` = '{$User['DiaChi']}'"
                . " WHERE `username` = '{$_SESSION[QuanTri]['username']}'";
        die();
        $this->Query($sql);
        return $this->Luu();
    }

    function SuaThongTin4User($User) {
        $nvht = $this->NhanVienHienTai();
        $User['ghichu'] = $this->Bokytusql("[" . $nvht['username'] . "__" . date("Y-m-d H:i:s") . "]");
        $sql = "UPDATE `" . table_prefix . "quantri` SET "
                . "`HoTen` = '{$User['HoTen']}', "
                . "`email` = '{$User['email']}', "
                . "`SDT` = '{$User['SDT']}', "
                . "`DiaChi` = '{$User['DiaChi']}', "
                . "`ghichu` = concat(`ghichu`,'{$User['ghichu']}')"
                . " WHERE `username` = '{$User['username']}'";

        $this->Query($sql);
        return $this->Luu();
    }

    function SuaPass($User) {
        $sql = "UPDATE  `" . table_prefix . "quantri` SET  `password` = SHA1(concat('{$User['newpassword']}',`random`)) WHERE  `username` =  '{$_SESSION[QuanTri]['username']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function SuaPass4Username($username, $password) {
        $sql = "UPDATE  `" . table_prefix . "quantri` SET  `password` = SHA1(concat('{$password}',`random`)) WHERE  `username` =  '{$username}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function XoaNhanVien($UserName, $Quyen = FALSE) {
        if ($Quyen) {
            $sql = "DELETE FROM `" . table_prefix . "quantri` WHERE `username` = '{$UserName}'";
            $this->Query($sql);
            return $this->Luu();
        }
    }

    function ThemNhanVien($UserName) {
        $sql = "INSERT INTO `" . table_prefix . "quantri` SET "
                . "`random` =  '{$UserName['random']}',"
                . "`password` =  '{$UserName['password']}',"
                . "`HoTen` =  '{$UserName['HoTen']}',"
                . "`email` =  '{$UserName['email']}',"
                . "`SDT` =  '{$UserName['SDT']}',"
                . "`DiaChi` =  '{$UserName['DiaChi']}',"
                . "`Nhom` =  '{$UserName['Nhom']}',"
                . "`username` =  '{$UserName['username']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function DSNhanVien() {
        $sql = "SELECT * FROM `" . table_prefix . "quantri`";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function DSDMCuaHang($MaKhacHang) {
        $sql = "SELECT `MaDanhMuc` FROM `" . table_prefix . "sanpham` where `ChuSanPham` = '{$MaKhacHang}' group by `MaDanhMuc` limit 0,6";
        $this->Query($sql);
        return $this->fetchAll();
    }

    function ThemQuyenNhom($QuenNhom) {
        $sql = "INSERT INTO `" . table_prefix . "quantri_chitiet` SET "
                . "`TenAction` = '{$QuenNhom['TenAction']}',"
                . " `MaNhom` = '{$QuenNhom['MaNhom']}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function XoaQuyenNhom($MaNhom) {
        $sql = "DELETE FROM `" . table_prefix . "quantri_chitiet` WHERE `MaNhom` = '{$MaNhom}'";
        $this->Query($sql);
        return $this->Luu();
    }

    function TimUser($Username) {
        $sql = "SELECT * FROM `" . table_prefix . "quantri` where `username`  = '{$Username}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

    function DanhSachQuenNhom($MaNhom) {
        $sql = "SELECT `TenAction` FROM `" . table_prefix . "quantri_chitiet` where `MaNhom`  = '{$MaNhom}'";
        $this->Query($sql);
        $kq = $this->Tim();

        $kq = $this->fetchAll();
        foreach ($kq as $TenAction) {
            $DS[] = $TenAction['TenAction'];
        }
        return $DS;
    }

}

?>
