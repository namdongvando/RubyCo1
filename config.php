<?php

define("DEFAULT_CONTROLLER", "index");
define("DEFAULT_ACTION", "index");
define("BASE_URL", "https://rubyads.com.vn/");
define("DOMAIN", ".rubyads.com.vn/");
define("BASE_DIR", "/");
define("ROOT_DIR", __DIR__);
define("NgonNgu", "NgonNgu");
define("Password", "@NguyenVanDo1");
define("QuanTri", "QuanTri_PGV");
define("table_prefix", "bakcodt_");
$_SESSION['TenHienThi'] = 0;
global $INI;
define("ENV", "product");
$config = parse_ini_file("ENV.ini", true);
$INI['host'] = $config[ENV]["database"]["host"];
$INI['username'] = $config[ENV]["database"]["username"];
$INI['password'] = $config[ENV]["database"]["password"];
$INI['DBname'] = $config[ENV]["database"]["DBname"];

spl_autoload_register(function($class) {
    $class = str_replace("\\", "_", $class);
    $class = str_replace("_", "/", $class) . ".php";
    if (file_exists($class)) {
        include_once $class;
    }
});
?>

