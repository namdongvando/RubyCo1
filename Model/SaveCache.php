<?php

class Model_SaveCache extends Model_Adapter {

    function __construct() {
        
    }

    static function minify_output($buffer) {
        $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);
        $buffer = str_replace(array("\n", "\r", "\t"), '', $buffer);
        $search = array(
            '/\>[^\S ]+/s',
            '/[^\S ]+\</s',
            '/(\s)+/s'
        );
        $replace = array(
            '>',
            '<',
            '\\1'
        );

        if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
            $buffer = preg_replace($search, $replace, $buffer);
        }
        return $buffer;
    }

    static function startCache($time = 30) {
        $io = new \lib\io();
        $cacheFile = "data/cache/" . sha1($_SERVER['REQUEST_URI']) . ".txt";
        if (file_exists($cacheFile)) {
            if (time() - filemtime($cacheFile) < $time) {
                echo file_get_contents($cacheFile);
//                echo $io->readFile($cacheFile);
                flush();
                exit();
            }
        }
    }

    static public function endCache($str) {
        if (!is_dir("data/cache/")) {
            mkdir("data/cache/", 0777);
        }
        $cacheFile = "data/cache/" . sha1($_SERVER['REQUEST_URI']) . ".txt";
        $io = new \lib\io();
        $str = self::minify_output($str);
        $io->writeFile($cacheFile, $str);
    }

}

?>