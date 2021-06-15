<?php

namespace lib\images;

class images {

    //put your code here
    public function getImagesFromUrl($url) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $img = '/public/img/images/sanpham/' . md5($url) . '.jpg';
        file_put_contents(substr($img, 1), file_get_contents($url));
        return $img;
    }

}
