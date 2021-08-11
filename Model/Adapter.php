<?php

class Model_Adapter {

    static public $_conn = "";
    static protected $_result = "";
    static protected $_Query = "";

    public function __construct() { // Kết nối csdl đầu tiên
        global $INI;
        self::$_conn = mysqli_connect($INI['host'], $INI['username'], $INI['password'], $INI['DBname']) or mysqli_errno("Can't connect database");
        mysqli_query(self::$_conn, "SET NAMES utf8"); // Chuyển dữ liệu trả về sang kiểu utf8
    }

    public function ThemTable($tablename, $row) {
        $sql = "INSERT INTO `$tablename` SET ";
        $content = null;
        $table = $this->Table($tablename, $row);

        foreach ($table as $k => $v) {
            $v_str = null;
            if (is_numeric($v))
                $v_str = "'{$v}'";
            else if (is_null($v))
                $v_str = 'NULL';
            else
                $v_str = "'{$v}'";

            $content .= "`$k`=$v_str,";
        }

        $content = trim($content, ',');
        $sql .= $content;
        self::$_Query = $sql;
    }

    public function _createDir($StringPath, $SubString = '/') {

        $Dir = explode($SubString, $StringPath);
        $root = reset($Dir) . $SubString;
        if (!is_dir($root)) {
            mkdir($root, 0777);
        }
        unset($Dir[0]);
        foreach ($Dir as $NDir) {
            if ($NDir) {
                $root .= $NDir . $SubString;
                if (!is_dir($root)) {
                    mkdir($root, 0777);
                }
            }
        }
    }

    public function _createFile($StringPathFile, $NoiDung) {
        $myfile = fopen($StringPathFile, "w") or die("Unable to open file!");
        fwrite($myfile, $NoiDung);
        fclose($myfile);
    }

    public function Query($sql) {
        self::$_Query = $sql;
    }

    public function Bokytusql($str) {
        $str = addslashes($str);
        return $str;
    }

    function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"
            return $uuid;
        }
    }

    public function fetchArrayByColum($colum) {
        $list = $this->Tim();
        $data = NULL;
        if ($list) {
            while ($row = mysqli_fetch_assoc($list)) {
                $data[] = $row[$colum];
            }
        }
        return $data;
    }

    public function fetchAll() {
        $list = $this->Tim();
        $data = NULL;
        if ($list) {
            while ($row = mysqli_fetch_assoc($list)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function fetchAllObj($classname) {
        $list = $this->Tim();
        $data = NULL;
        if ($list) {
            while ($row = mysqli_fetch_assoc($list)) {
                $data[] = new $classname($row);
            }
        }
        return $data;
    }

    public function fetchArray() {
        $list = $this->Tim();
        $data = NULL;
        if ($list) {
            while ($row = mysqli_fetch_array($list)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function ToOption($col, $data) {
        $d = [];
        foreach ($data as $value) {
            if (isset($columns[2])) {
                $d[$value[$columns[0]]] = $value[$columns[1]] . " _ " . $value[$columns[2]];
            } else {
                $d[$value[$columns[0]]] = $value[$columns[1]];
            }
        }
    }

    public function fetch2Option($columns) {
        $data = $this->fetchAll();
        $d = [];
        foreach ($data as $value) {
            if (isset($columns[2])) {
                $d[$value[$columns[0]]] = $value[$columns[1]] . " _ " . $value[$columns[2]];
            } else {
                $d[$value[$columns[0]]] = $value[$columns[1]];
            }
        }
        return $d;
    }

    public function fetchRow() {
        $list = $this->Tim();
        if ($list)
            return mysqli_fetch_assoc($list);
        return FALSE;
    }

    public static function Luu() {
        if (self::$_conn) { // nếu đã kết nối csdl
            self::$_result = mysqli_query(self::$_conn, self::$_Query);
            if (self::$_result) {
                return self::$_result;
            } else {
                echo mysqli_error(self::$_conn);
//                echo self::$_Query;
//                header("Location: " . $_SERVER["HTTP_REFERER"]);
//                die();
                return FALSE;
            }
            return FALSE;
        }
    }

    public static function SaveInsert() {
        if (self::$_conn) { // nếu đã kết nối csdl
            self::$_result = mysqli_query(self::$_conn, self::$_Query);
            if (self::$_result) {
                return mysqli_insert_id(self::$_conn);
            } else {
                throw new Exception(mysqli_error(self::$_conn));
            }
            return FALSE;
        }
    }

    public static function Tim() {
        if (self::$_conn) { // nếu đã kết nối csdl
            self::$_result = mysqli_query(self::$_conn, self::$_Query);
            if (self::$_result) {
                return self::$_result;
            }
            return FALSE;
        }
    }

    public function GetID() {
        if (self::$_result) {
            return intval(mysqli_insert_id());
        }
    }

    public function GetQuery() {
        print_r(self::$_Query);
    }

    public function GetNumRow() {
        if (self::$_Query) {
//            echo self::$_Query;
            $kq = mysqli_query(self::$_conn, self::$_Query) or mysqli_errno(self::$_conn);
            return intval($kq->num_rows);
        }
        return 0;
    }

    public function LuuXoa() {
        if (self::$_conn) { // nếu đã kết nối csdl
            self::$_result = mysqli_query(self::$_conn, self::$_Query); /* Gán kết quả trả về của câu truy
              vấn cho biến $_result */
        }
        if (self::$_result) {
            return TRUE;
        }

        return FALSE;
    }

    function guimail($NoiDungMail) {
//      $tennguoigui = trim(strip_tags($NoiDungMail['tennguoigui']));
        $tennguoigui = $NoiDungMail['NguoiGui'];
        // mail nguoi nhan
        $to_email = $NoiDungMail['ToMail'];
//      $from_email = trim(strip_tags($NoiDungMail['emailgui']));
//      mail gửi/
        $from_email = $NoiDungMail['FromMail'];

//      Tiêu đề mail
        $tieude = $NoiDungMail['TieuDe'];
//      nội dung mail
        $noidung = $NoiDungMail['NoiDung'];
//
        $username = $NoiDungMail['FromMail']; // Tài khoản gmail dùng để gửi thư
        $password = $NoiDungMail['PassWord']; // mật khẩu của tài khoản gửi mail
        require_once 'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP(); //Tell PHPMailer to use SMTP
        $mail->SMTPDebug = 2; //0=off,1=client messages,2=client and server messages
        $mail->Debugoutput = 'html';
        $mail->CharSet = 'UTF-8';
        $mail->ContentType = 'text/html; charset=utf-8';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;  //25,465 or 587
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->setFrom($from_email, $tennguoigui);
        $mail->addAddress($to_email);
        $mail->Subject = $tieude;
        $mail->msgHTML($noidung);
        //$mail->addAttachment('images/phpmailer_mini.gif');
        if (!$mail->send())
            return "Lỗi: " . $mail->ErrorInfo;
        else
            return "Đã gửi mail";
    }

    function _header($url) {
        header("Location: " . $url);
    }

    function bodautv($str) {
        if (!$str)
            return false;

        $str = str_replace(array(',', '<', '>', '&', '{', '}', "[", "]", '*', '?', '/', '+', '@', '%', '"'), array(' '), $str);
        $str = str_replace(array("'"), array(' '), $str);
        while (strpos($str, "  ") > 0) {
            $str = str_replace("  ", " ", $str);
        }
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
        foreach ($unicode as $khongdau => $codau) {
            $str = preg_replace("/($codau)/i", $khongdau, $str);
        }
        $str = strtolower($str);
        $str = trim($str);
        $str = preg_replace('/[^a-zA-Z0-9\ ]/', '', $str);
        $str = str_replace(" ", "-", $str);
        return $str;
    }

    function _decode($stringJSon) {
        return json_decode($stringJSon);
    }

    function _encode($array) {
        $a = json_encode($array, JSON_UNESCAPED_UNICODE);
        return html_entity_decode($a);
    }

    function _subStringUnicode($str, $SL) {
        return mb_substr($str, 0, $SL, 'UTF-8');
    }

    function PhanTrang($TongTrang = 3, $TrangHienTai, $DuongDan) {
        $PhanTrang = ' <ul class="pagination">';

        $tu = $TrangHienTai - 4;
        $den = $TrangHienTai + 4;
        $tu = $tu <= 0 ? 1 : $tu;
        if ($tu > 1) {
            $DuongDan1 = str_replace("[i]", 1, $DuongDan);
            $PhanTrang .= '<li><a href="' . $DuongDan1 . '"><<</a></li>';
        }
        if ($tu > 1) {
            $DuongDan1 = str_replace("[i]", $TrangHienTai - 1, $DuongDan);
            $PhanTrang .= '<li><a href="' . $DuongDan1 . '"><</a></li>';
        }

        $den = $den >= $TongTrang ? $TongTrang : $den;
        for ($i = $tu; $i <= $den; $i++) {
            $DuongDan1 = str_replace("[i]", $i, $DuongDan);
            if ($i == $TrangHienTai)
                $PhanTrang .= '<li class="active" ><a href="' . $DuongDan1 . '">' . $i . '</a></li>';
            else
                $PhanTrang .= '<li><a href="' . $DuongDan1 . '">' . $i . '</a></li>';
        }

        if ($den < $TongTrang) {
            $DuongDan1 = str_replace("[i]", $TrangHienTai + 1, $DuongDan);
            $PhanTrang .= '<li><a href="' . $DuongDan1 . '">></a></li>';
        }
        if ($den < $TongTrang) {
            $DuongDan1 = str_replace("[i]", $TongTrang, $DuongDan);
            $PhanTrang .= '<li><a href="' . $DuongDan1 . '">>></a></li>';
        }

        $PhanTrang .= '</ul>';
        return $PhanTrang;
    }

    function getconn() {
        return self::$_conn;
    }

    function BoHieuUngSQL($v) {
        return $v;
    }

    function upload_image($file, $extension, $folder, $tienTo) {
        $ext = trim(substr($file["type"], 6, strlen($file["type"])));
        $name = basename($file['name'], '.' . $ext);
        $extension = "jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF";
        if (strpos($extension, $ext) === false) {
            return false;
        }
        if (file_exists($folder . $name))
            for ($i = 0; $i < 100; $i++) {
                if (!file_exists($folder . $name . $i . '.' . $ext)) {
                    $file['name'][$k] = $name . $i . '.' . $ext;
                    break;
                }
            }
        $file['name'] = $folder . $tienTo . "." . $ext;
        copy($file["tmp_name"], $file['name']);
        move_uploaded_file($file["tmp_name"], $file['name']);
        return $file['name'];
    }

    function mkdir_r($dirName, $rights = 0777) {
        $dirs = explode('/', $dirName);
        $dir = '';
        foreach ($dirs as $part) {
            $dir .= $part . '/';
            if (!is_dir($dir) && strlen($dir) > 0)
                mkdir($dir, $rights);
        }
    }

    function upload_image1($file, $folder, $tt = "sp-", $isNameFile = false) {
        $this->mkdir_r($folder);
        if (!is_dir($folder)) {
            mkdir($folder, 0777);
        }
        if ($isNameFile == FALSE) {
            $tienTo = $tt . time() . rand(1, 2000);
        } else {
            $tienTo = $tt;
        }
        $ext = trim(substr($file["type"], 6, strlen($file["type"])));
        $name = basename($file['name'], '.' . $ext);
        $extension = "jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF";
        if (strpos($extension, $ext) === false) {
            return false;
        }
        if (file_exists($folder . $name))
            for ($i = 0; $i < 100; $i++) {
                if (!file_exists($folder . $name . $i . '.' . $ext)) {
                    $file['name'][$k] = $name . $i . '.' . $ext;
                    break;
                }
            }
        $file['name'] = $folder . $tienTo . "." . $ext;
        copy($file["tmp_name"], $file['name']);
        move_uploaded_file($file["tmp_name"], $file['name']);
        return $file['name'];
    }

    function upload_multi_image($file, $folder, $tt = "sp-", $isNameFile = false) {
        $this->mkdir_r($folder);
        $extension = "jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF";
        $listName = array();
        foreach ($file['name'] as $k => $name) {
            if ($name) {
                if (!$isNameFile) {
                    $tienTo = $tt . time() . rand(1, 2000);
                } else {
                    $tienTo = $tt;
                }
                $ext = trim(substr($file["type"][$k], 6, strlen($file["type"][$k])));
                $name = basename($file['name'][$k], '.' . $ext);
                if (strpos($extension, $ext) === false) {
                    break;
                }
                if (file_exists($folder . $file['name'][$k]))
                    for ($i = 0; $i < 100; $i++) {
                        if (!file_exists($folder . $name . $i . '.' . $ext)) {
                            $file['name'][$k] = $name . $i . '.' . $ext;
                            break;
                        }
                    }
                $listName[$k] = $file['name'][$k] = $folder . $tienTo . "-" . $k . '.' . $ext;
                copy($file["tmp_name"][$k], $file['name'][$k]);
                move_uploaded_file($file["tmp_name"][$k], $file['name'][$k]);
            }
        }
        return $listName;
    }

    function RandomString($a) {
        $md5_hash = md5(rand(0, 9999) . time());
        $security_code = substr($md5_hash, 2, 10);
        return $security_code;
    }

}

?>
