<?php

namespace Model;

interface IPagesForm {

    public static function idPa($value = null);

    public static function idGroup($value = null, $name = null);

    public static function Name($value = null);

    public static function Alias($value = null);

    public static function Title($value = null);

    public static function Des($value = null);

    public static function Keyword($value = null);

    public static function Summary($value = null);

    public static function Content($value = null);

    public static function Urlimages($value = null);

    public static function isShow($value = null);

    public static function Type($value = null);

    public static function Note($value = null);

    public static function OrderBy($value = null);
}
?>

