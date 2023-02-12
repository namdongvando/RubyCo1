<?php

namespace Model;

class pathCkFinder
{

    const pathCkFinder = "pathCkFinder";
    const isProduct = "isProduct";

    public function __construct()
    {
    }

    static function set($path)
    {
        $_SESSION[self::pathCkFinder] = $path;
    }

    static function SetIsProduct($path)
    {
        $_SESSION[self::isProduct] = $path;
    }

    static function GetIsProduct()
    {
        if (isset($_SESSION[self::isProduct]))
            return $_SESSION[self::isProduct];
        return FALSE;
    }

    static function get()
    {
        return $_SESSION[self::pathCkFinder] ?? "/public/img/";
    }

    function getPath()
    {
        return $_SESSION[self::pathCkFinder];
    }
}
