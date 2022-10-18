<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define("ENV", "dev");
$config = parse_ini_file("ENV.ini", true);
define("DEFAULT_CONTROLLER", $config["DEFAULT_CONTROLLER"]);
define("DEFAULT_ACTION", $config["DEFAULT_ACTION"]);
define("BASE_URL", $config["BASE_URL"]);
define("reCAPTCHA", $config["reCAPTCHA"]);
define("DOMAIN", $config["DOMAIN"]);
define("BASE_DIR", $config["BASE_DIR"]);
define("ROOT_DIR", __DIR__);
define("NgonNgu", $config["NgonNgu"]);
define("QuanTri", $config["QuanTri"]);
define("table_prefix", $config["table_prefix"]);
$_SESSION['TenHienThi'] = 0;
global $INI;
$INI['host'] = $config[ENV]["database"]["host"];
$INI['username'] = $config[ENV]["database"]["username"];
$INI['password'] = $config[ENV]["database"]["password"];
$INI['DBname'] = $config[ENV]["database"]["DBname"];

spl_autoload_register(function($class) {
    $class = str_replace("\\", "_", $class);
    $class = str_replace("_", "/", $class) . ".php";
    $class = __DIR__ . "/" . $class;
    if (file_exists($class)) {
        include_once $class;
    }
});
?>

