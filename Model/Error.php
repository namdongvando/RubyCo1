<?php

namespace Model;

class Error {

    static public $type;
    static public $Content;

    function __construct($aContent) {
        $type = $aContent["type"];
        $content = $aContent["content"];
        self::$type = $type;
        self::$Content = $content;
        $_SESSION["Error"]["type"] = $type;
        $_SESSION["Error"]["content"] = $content;
    }

    function setError($content, $type) {
        self::$type = $type;
        self::$Content = $content;
        $_SESSION["Error"]["type"] = $type;
        $_SESSION["Error"]["content"] = $content;
    }

    static function getAllError() {
        $content = self::$Content;
        $type = self::$type;
        $type = isset($_SESSION["Error"]["type"]) ? $_SESSION["Error"]["type"] : "";
        $content = isset($_SESSION["Error"]["content"]) ? $_SESSION["Error"]["content"] : "";
        unset($_SESSION["Error"]);
        self::$Content = NULL;
        self::$type = NULL;
        if (!$type) {
            return null;
        }

        return [
            "Content" => $content
            , "Type" => $type
        ];
    }

    function getError() {
        $content = self::$Content;
        $type = self::$type;
        $type = $_SESSION["Error"]["type"];
        $content = $_SESSION["Error"]["content"];
        unset($_SESSION["Error"]);
        self::$Content = NULL;
        self::$type = NULL;
        return [
            "Content" => $content
            , "Type" => $type
        ];
    }

//put your code here
}
