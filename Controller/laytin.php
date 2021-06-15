<?php

class Controller_laytin extends Controller_backend {

    function __construct() {
        parent::__construct();
    }

    function getdatasformUrl($name, $link) {
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include 'simplehtmldom/simple_html_dom.php';
//        $name = "ban-go-cong-nghiep-athena";
//        $link = 'https://noithathoaphatsaigon.vn/danh-muc/ban-hoa-phat/ban-go-cong-nghiep-athena/';
        $html = file_get_contents($link);
//#main > ul > li.product
        $dom = new simple_html_dom();
        $htmlElement = $dom->load($html);
        $select = 'li.product';
        $d = [];
        foreach ($htmlElement->find($select) as $article) {
            $item['img'] = $article->find('img', 0)->src;
            $item['href'] = $article->find('a', 0)->href;
            $item['name'] = $article->find('.woocommerce-loop-product__title', 0)->plaintext;
            $item['price'] = 0;
            if ($article->find('.woocommerce-Price-amount', 0)) {
                $price = $article->find('.woocommerce-Price-amount', 0)->plaintext;
                $price = str_replace(",", "", $price);
                $price = intval($price);
                $item['price'] = $price;
            }
            $html1 = file_get_contents($item['href']);

            $dom1 = new simple_html_dom();
            $htmlElement1 = $dom1->load($html1);
            $select = '#tab-description';
            $string = $htmlElement1->find($select, 0)->innertext;
            $string = preg_replace("/<\\/?div(.|\\s)*?>/", "", $string);
            $string = preg_replace("/<\\/?a(.|\\s)*?>/", "", $string);
            $item["content"] = $string;
            $d[] = $item;
            var_dump($item);
            flush();
            echo "<br>===================";
        }

        $io = new lib\io();
        $io->writeFile("data/product/" . md5($link) . $name . ".json", json_encode($d, JSON_UNESCAPED_UNICODE));
    }

    function getByLink() {
        $link = $_POST["Link"];
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $link = urldecode($link);
        $link = trim($link);
        include 'simplehtmldom/simple_html_dom.php';
//        $link = 'http://noithathoaphat.com.vn/products/Gh%E1%BA%BF-xoay-da-h%C3%B2a-ph%C3%A1t-SG909.html';
        $html = file_get_contents($link);
//#main > ul > li.product
        //#ProductDescription > div
        $dom = new simple_html_dom();
        $htmlElement = $dom->load($html);
        $select = '#ProductDescription > div';
        $content = $htmlElement->find($select, 0)->innertext;
        $api = new \lib\APIs();
        echo $content;
    }

    function getByLinkName() {
        $link = $_POST["Link"];
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include 'simplehtmldom/simple_html_dom.php';
        $link = urldecode($link);

        $link = trim($link);

//        $link = 'http://noithathoaphat.com.vn/products/Gh%E1%BA%BF-xoay-da-h%C3%B2a-ph%C3%A1t-SG909.html';
        $html = file_get_contents($link);
//#main > ul > li.product
        //#ProductDescription > div
        $dom = new simple_html_dom();
        $htmlElement = $dom->load($html);
        $select = "#ProductDetails > div > h1";
        $Name = $htmlElement->find($select, 0)->innertext;
        $api = new \lib\APIs();
        echo $Name;
    }

    function getLinkByCode() {
        $Code = $_POST["Code"];
//        $Code = "SF02";
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include 'simplehtmldom/simple_html_dom.php';
        $link = 'http://noithathoaphat.com.vn/rss.php?action=searchproducts&type=rss&search_query=' . $Code;
        $html = file_get_contents($link);
        $xml = simplexml_load_string($html);
        echo $xml->channel->item->link;
    }

    function form() {
        if (isset($_POST["Save"])) {
            $name = lib\Common::bodautv($_POST["name"]);
            $link = $_POST["link"];


            if ($link != "" && $name != "")
                $this->getdatasformUrl($name, $link);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="">name</label>
                <input type="text" style="width: 100%;" class="form-control" name="name" >
            </div>
            <div class="form-group">
                <label for="">link</label>
                <input type="text" style="width: 100%" class="form-control" name="link" >
            </div>
            <button name="Save" >Save</button>
        </form>
        <?php
    }

    function index() {
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $io = new lib\io();
        $filename = "data/category/cat.json";
        $CatContent = $io->readFile($filename);
        $cat = json_decode($CatContent, JSON_OBJECT_AS_ARRAY);
        $Product = new Model\Products();
        $dir = new lib\redDirectory();
        $a = [];
        $b = [];
        $dirPath = "data/product/";
        $dir->redDirectoryByPath($dirPath, $a);
        foreach ($a as $key => $value) {
//            var_dump("----");
            $c[$value] = 0;
            $fileName = $dirPath . $value;
            $b = json_decode($io->readFile($fileName), JSON_OBJECT_AS_ARRAY);
        }
        $filename = "data/category/cat1.json";
        $CatContent = $io->writeFile($filename, json_encode($b, JSON_UNESCAPED_UNICODE));

//        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function importbyname() {
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $io = new lib\io();
        $id = $this->getParam()[0];

        $fileName = "data/product/" . $_POST["fileName"];
        $b = json_decode($io->readFile($fileName), JSON_OBJECT_AS_ARRAY);
        $this->CreateProduct($b, $_POST["catid"]);

        echo "done";
    }

    function importbycatid() {
        set_time_limit(0);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $io = new lib\io();
        $id = $this->getParam()[0];
        $filename = "data/category/cat.json";
        $CatContent = $io->readFile($filename);
        $cat = json_decode($CatContent, JSON_OBJECT_AS_ARRAY);
        $dirPath = "data/product/";
        foreach ($cat as $key => $value) {
            if ($value == $id) {
                $fileName = $dirPath . $key;
                $b = json_decode($io->readFile($fileName), JSON_OBJECT_AS_ARRAY);
                $this->CreateProduct($b, $cat[$key]);
            }
        }
        echo "done";
    }

    private function CreateProduct($b, $catid) {
        $Product = new Model\Products();
        if ($b)
            foreach ($b as $k => $v) {
                $id = md5($v["name"]);
                $p = $Product->ProductsByID($id, FALSE);
                var_dump($p);
                if (!$p) {
                    $img = $this->layhinh($v["img"]);
                    $img = explode("/images/sanpham/", $img);
                    $note = ["img" => $v["img"]];
                    $note = json_encode($note);
                    $P["ID"] = $id;
                    $P["Username"] = "auto";
                    $P["catID"] = $catid;
                    $P["nameProduct"] = $v["name"];
                    $P["Alias"] = $id;
                    $P["Price"] = $v["price"];
                    $P["oldPrice"] = "0";
                    $P["Summary"] = "";
                    $P["Content"] = $v["content"];
                    $P["UrlHinh"] = $img[1];
                    $P["DateCreate"] = date("Y-m-d H:i:s");
                    $P["Number"] = 100;
                    $P["Note"] = $note;
                    $P["BuyTimes"] = "0";
                    $P["Views"] = "0";
                    $P["isShow"] = "1";
                    $P["Serial"] = "1";
                    $P["lang"] = "vi";
                    //                $kt = $Product->ProductsByID($id);
                    //                if (!$kt)
                    $Product->AddProducts($P);
                }
            }
    }

    function tinchodanhmuc() {

        include_once 'Model/simple_html_dom.php';
        $this->QView("");
    }

    private function layhinh($url) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
//        $url = 'https://noithathoaphatsaigon.vn/wp-content/uploads/2018/11/ban-sofa-cao-cap-BSF11-300x300.jpg';
        $img = '/public/img/images/sanpham/' . md5($url) . '.jpg';
        file_put_contents(substr($img, 1), file_get_contents($url));
        return $img;
    }

}
