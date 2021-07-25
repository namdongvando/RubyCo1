<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("X-XSS-Protection: 1; mode=block");

function minify_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s'
        , '/<!--(.|\s)*?-->/'
    );
    $replace = array(
        '>',
        '<',
        '\\1'
        , ''
    );
    if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
        $buffer = preg_replace($search, $replace, $buffer);
    }
    return $buffer;
}

$url = $_SERVER['REQUEST_URI'];
session_start();
ob_start();

if (file_exists("./vendor/autoload.php")) {
    include './vendor/autoload.php';
}
include 'config.php';
define("GioHang", "GioHang");
$_SESSION[GioHang] = isset($_SESSION[GioHang]) ? $_SESSION[GioHang] : [];
$host = $_SERVER["HTTP_HOST"];
$user = explode(DOMAIN, $host);
Model_Subdomail::setSubdoamin($user[0]);
Model_Tableprefix::setTableprefix(Model_Subdomail::getSubdoamin() . "_");
$Application = new Application($url);
if (isset($_GET["ctrl"])) {
    $Module = null;
    $cnameV = $_GET["ctrl"];
    $Application->setController($cnameV);
    $cname = "Controller_" . $cnameV;
    $action = $_GET["action"];
    $Application->setAction($action);
    $Application->setParam($_GET["param"]);
} else {
    $Module = $Application->getModule();
    $cnameV = $Application->getController();
    $cname = "Controller_" . $Application->getController();
    $action = $Application->getAction();
}

if ($Module) {
    $cname = $Application->getController();
//    Module_minfor_Controller_index
    $class = sprintf("Module\\%s\\Controller\\%s", $Module, $cname);
    if (class_exists($class, TRUE)) {
        $Class = new $class();
        $Class->$action();
    }
} else {
//    không module
    if (class_exists($cname, TRUE)) {
        if (method_exists($cname, $action)) {
            $c = new $cname();
            $c->$action();
        } else {
            $Application->setParam($action);
            $Application->getParam();
            $Application->setAction("index");
            $Application->getAction();
            $c = new $cname();
            $c->index();
        }
    } else {
        $Ctrl = $Application->PTURL($TieuDeKD);
        $Application->setController("index");
        $Application->setAction($Ctrl);
        $action = $Ctrl;
        $c = new Controller_index();
        $c->$action($TieuDeKD);
//    controler mặc định lấy
    }
}
if (isset($_GET["debug"])) {
    echo $Application->getController();
    echo $Application->getAction();
}
//echo $etime - $stime;
?>
