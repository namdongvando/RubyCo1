<?php

namespace lib;

class io {

    function __construct() {
        
    }

    function writeFile($filename, $content) {
        $myfile = fopen($filename, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
        return true;
    }

    function readFile($filename) {
        $myfile = fopen($filename, "r") or die("Unable to open file!");
        $a = fread($myfile, filesize($filename));
        fclose($myfile);
        return $a;
    }
    

}
