<?php

namespace Model\News;

/**
 *
 * @author MSI
 */
interface NewsIform {

    public static function ID($val = null, $name = null);

    public static function PageID($val = null, $name = null);

    public static function Name($val = null, $name = null);

    public static function Alias($val = null, $name = null);

    public static function Summary($val = null, $name = null);

    public static function Content($val = null, $name = null);

    public static function title($val = null, $name = null);

    public static function keyword($val = null, $name = null);

    public static function description($val = null, $name = null);

    public static function AnHien($val = null, $name = null);

    public static function NgayDang($val = null, $name = null);

    public static function UrlHinh($val = null, $name = null);

    public static function TinNoiBat($val = null, $name = null);

    public static function SoLanXem($val = null, $name = null);

    public static function Stt($val = null, $name = null);
}
