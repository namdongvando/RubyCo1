<?php

namespace lib;

class redDirectory {
    function redDirectoryByPath($dir, &$a) {
        if (!is_dir($dir)) {
            return;
        }
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $fileName = $dir . $file;
                    if (is_file($fileName)) {
                        $a[] = $file;
                    } else {
                        $this->redDirectoryByPath($dir . $file . "/", $a);
                    }
                }
            }
            closedir($dh);
        }
    }

}

?>