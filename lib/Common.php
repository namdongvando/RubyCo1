<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lib;

class Common
{

    static function ToUrl($url = null)
    {
        if ($url == null)
            $url = $_SERVER["HTTP_REFERER"];
        header("Location: " . $url);
    }

    static function MapArray($array, &$array1)
    {
        foreach ($array1 as $k => $v) {
            $array1[$k] = $array[$k];
        }
    }

    static function bodautv($str)
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

    public static function MoneyFomat($a)
    {
        if ($a > 0)
            return number_format($a, 2, '.', ',') . "";
        return "Liên Hệ";
    }

    public static function DateFormat()
    {
        return "Y-m-d H:i:s";
    }

    public static function ShowDateFormat()
    {
        return "H:i:s d-m-Y";
    }

    static function getGUID()
    {
        mt_srand((float) microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);

        return $uuid;
    }

    static function PhanTrangIndex($index, $number, $indexPages)
    {
        $indexPages = $indexPages - 1;
        $indexPages = max($indexPages, 0);
        return $number * ($indexPages) + $index + 1;
    }

    /**
     * Phân Trang Datatable
     * @param {type} parameter
     */
    static function PhanTrang($TongTrang, $TrangHienTai, $DuongDan = '[i]')
    {
        $PhanTrang = ' <ul class="pagination">';
        $PhanTrang .= " <li ><a>{$TrangHienTai}/{$TongTrang}</a></li>";

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
}
