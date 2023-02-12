<?php

namespace Model;

class Common
{

    public function __construct()
    {
    }

    static function getslug($string)
    {

        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }

    public static function NumberToStringFomatZero($value, $numString = 6)
    {
        return str_pad($value, $numString, '0', STR_PAD_LEFT);
    }

    public static function ToUrl($url)
    {
        header("Location: " . $url);
        exit();
    }

    public static function TextInput($text)
    {
        $text = trim($text);
        $text = htmlspecialchars($text);
        $text = addslashes($text);
        return $text;
    }

    public static function uuid()
    {
        $namespace = rand(11111, 99999);
        $guid = hash("sha256", time() . $namespace);
        $uid = uniqid(time(), true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash,  0,  8) . '-' .
            substr($hash,  8,  4) . '-' .
            substr($hash, 12,  4) . '-' .
            substr($hash, 16,  4) . '-' .
            substr($hash, 20, 12);
        return $guid;
    }

    public static function IsEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function DateTimeFomatDatabase()
    {
        return "Y-m-d H:i:s";
    }
    public static function DateTimeFomat()
    {
        return "d-m-Y H:i:s";
    }

    public static function DateTimeFomatView()
    {
        return "d-m-Y";
    }

    public static function DateFomatDatabase()
    {
        return "Y-m-d";
    }

    public static function StrToDateDB($strdate)
    {
        return date(\Model\Common::DateFomatDatabase(), strtotime($strdate));
    }

    public static function ForMatDMY($strdate)
    {
        return date(\Model\Common::DateFomatView(), strtotime($strdate));
    }

    public static function ForMatDMYHIS($strdate)
    {
        return date(\Model\Common::DateTimeFomat(), strtotime($strdate));
    }

    public static function DateFomatView()
    {
        return "d-m-Y";
    }

    public static function PhanTrang($TongSoDong, $TrangThuBaoNhieu, $SoDong, $LinkPhanTrang)
    {
        $SoDong = max(1, intval($SoDong));
        $TrangThuBaoNhieu = max(1, intval($TrangThuBaoNhieu));
        $SoTrang = ceil($TongSoDong / $SoDong);
        $SoTrang = max(0, $SoTrang);
        $TrangTrai = $TrangThuBaoNhieu - 1;
        $TrangTrai = max(1, $TrangTrai);
        $TrangPhai = $TrangThuBaoNhieu + 1;
        $TrangPhai = min($TrangPhai, $SoTrang);
        $TrangMin = $TrangThuBaoNhieu - 3;
        $TrangMin = $TrangThuBaoNhieu - 3;
        $TrangMin = max(1, $TrangMin);
        $TrangMax = $TrangThuBaoNhieu + 3;
        $TrangMax = min($TrangMax, $SoTrang);
        $TrangTraiCham = $TrangThuBaoNhieu - 7;
        $TrangTraiCham = max(1, $TrangTraiCham);
        $TrangPhaiCham = $TrangThuBaoNhieu + 7;
        $TrangPhaiCham = min($TrangPhaiCham, $SoTrang);

        $_linkTrangDau = str_replace("[i]", 1, $LinkPhanTrang);
        $_linkTrangTrai = str_replace("[i]", $TrangTrai, $LinkPhanTrang);
        $_linkTrangCuoi = str_replace("[i]", $SoTrang, $LinkPhanTrang);
        $_linkTrangPhai = str_replace("[i]", $TrangPhai, $LinkPhanTrang);
        $_linkTrangTraiCham = str_replace("[i]", $TrangTraiCham, $LinkPhanTrang);
        $_linkTrangPhaiCham = str_replace("[i]", $TrangPhaiCham, $LinkPhanTrang);
 
        ob_start();
?>
        <ul class="pagination pagination-md no-margin">
            <li><a><?php echo $TrangThuBaoNhieu . "/" . $SoTrang; ?></a></li>
            <li><a href="<?php echo $_linkTrangDau ?>"><i class="fa fa-angle-double-left"></i></a></li>
            <li><a href="<?php echo $_linkTrangTrai ?>"><i class="fa fa-angle-left"></i></a></li>
            <li class="hidden-xs"><a href="<?php echo $_linkTrangTraiCham ?>">...</a></li>
            <?php
            for ($index = $TrangMin; $index <= $TrangMax; $index++) {
                $_link = str_replace("[i]", $index, $LinkPhanTrang);
            ?>
                <li class="<?php echo $TrangThuBaoNhieu == $index ? 'active' : ''; ?>">
                    <a href="<?php echo $_link; ?>"><?php echo $index; ?></a>
                </li>
            <?php
            }
            ?>
            <li class="hidden-xs"><a href="<?php echo $_linkTrangPhaiCham ?>">...</a></li>
            <li><a href="<?php echo $_linkTrangPhai ?>"><i class="fa fa-angle-right"></i></a></li>
            <li><a href="<?php echo $_linkTrangCuoi ?>"><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
<?php
        $str = ob_get_clean();
        return $str;
    }

    public static function BoDauTienViet($str)
    {
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

    public static function ViewPrice($number)
    {
        return number_format($number, 0, ".", ".") . " đ";
    }

    public static function ViewNumber($number)
    {
        return number_format($number, 0, ".", ".");
    }

    public static function CheckName($param)
    {
        return strip_tags($param);
    }

    public static function DateTime()
    {
        return date("Y-m-d H:i:s", time());
    }

    public static function TextInputNoHtml($text)
    {
        $text = strip_tags($text);
        $text = trim($text);
        $text = addslashes($text);
        return $text;
    }

    public static function Index($index, $indexPage, $pageNumber)
    {
        return ($indexPage - 1) * $pageNumber + $index + 1;
    }

    public static function DaysInMonth($month, $year)
    {
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    public static function NameDateByDate($ngayThanhNam, $isvalue = false)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $weekday = date("l", strtotime($ngayThanhNam));
        $weekday = strtolower($weekday);

        $a = [
            "monday" => "Thứ Hai",
            "tuesday" => "Thứ ba",
            "wednesday" => "Thứ Tư",
            "thursday" => "Thứ Năm",
            "friday" => "Thứ Sáu",
            "saturday" => "Thứ Bảy",
            "sunday" => "Chủ Nhật",
        ];
        if ($isvalue == FALSE)
            return $a[$weekday];
        return $weekday;
    }

    public static function FromDateToDateToList($begin, $end)
    {
        $begin = new \DateTime($begin);
        $end = new \DateTime($end);
        $end->setTime(0, 0, 1);
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);
        $dateList = [];
        foreach ($period as $dt) {
            $dateList[] = $dt->format("Y-m-d");
        }
        return $dateList;
    }

    public static function NgayTrongTuan()
    {
        $a = [
            "monday" => "Thứ Hai",
            "tuesday" => "Thứ ba",
            "wednesday" => "Thứ Tư",
            "thursday" => "Thứ Năm",
            "friday" => "Thứ Sáu",
            "saturday" => "Thứ Bảy",
            "sunday" => "Chủ Nhật",
        ];
        return $a;
    }

    function convert_number_to_words($number)
    {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười năm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
}
