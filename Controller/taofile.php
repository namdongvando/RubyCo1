<?php

class Controller_taofile extends Application {

    public $param;

    function __construct() {
        $this->param = $this->getParam();
    }

    function code($Ten) {
        $NoiDungController = <<<CONTROLLER
                        app.controller("{$Ten}Controller", function(\$scope, \$rootScope, \$http, \$routeParams) {
                            });
CONTROLLER;
        return $NoiDungController;
    }

    function index() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = <<<CONTROLLER
                        app.controller("{$Ten}Controller", function(\$scope, \$rootScope, \$http, \$routeParams) {
                            });
CONTROLLER;
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function common() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/common/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = $this->code($Ten);
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function backend() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/backend/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = 'app.controller("' . $Ten . 'Controller", ' . $Ten . 'Controller);
                '
                        . ' function ' . $Ten . 'Controller($scope, $rootScope, $http, $routeParams) {

                }';
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function mproduct() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/mproduct/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = 'app.controller("' . $Ten . 'Controller", ' . $Ten . 'Controller);
                '
                        . ' function ' . $Ten . 'Controller($scope, $rootScope, $http, $routeParams) {

                }';
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function mmenu() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/mmenu/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = 'app.controller("' . $Ten . 'Controller", ' . $Ten . 'Controller);
                '
                        . ' function ' . $Ten . 'Controller($scope, $rootScope, $http, $routeParams) {

                }';
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function mpage() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/mpage/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = 'app.controller("' . $Ten . 'Controller", ' . $Ten . 'Controller);
                '
                        . ' function ' . $Ten . 'Controller($scope, $rootScope, $http, $routeParams) {

                }';
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function mnews() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/mnews/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = 'app.controller("' . $Ten . 'Controller", ' . $Ten . 'Controller);
                '
                        . ' function ' . $Ten . 'Controller($scope, $rootScope, $http, $routeParams) {

                }';
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function mtheme() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/mtheme/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = 'app.controller("' . $Ten . 'Controller", ' . $Ten . 'Controller);
                '
                        . ' function ' . $Ten . 'Controller($scope, $rootScope, $http, $routeParams) {

                }';
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

    function home() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["Name"] = str_replace(" ", "", $_POST["Name"]);
            $_POST["Name"] = strip_tags($_POST["Name"]);
            $path = "public/partials/home/" . $_POST["Name"];
            if (!is_dir($path)) {
                $subPath = explode("/", $path);
                $Ten = end($subPath);
                $NoiDungController = $this->code($Ten);
                try {
                    $a->_createDir($path);
                } catch (Exception $ex) {
                    echo $ex . error_reporting();
                }
                $a->_createFile($path . "/{$Ten}Controller.js", $NoiDungController);
                $a->_createFile($path . "/{$Ten}.css", "");
                $a->_createFile($path . "/{$Ten}.html", "");
                $a->_createFile($path . "/{$Ten}Filter.js", "");
                $a->_createFile($path . "/{$Ten}Library.js", "");
                $a->_createFile($path . "/{$Ten}Services.js", "");
            }
        }
        $this->AView("");
    }

}
?>

