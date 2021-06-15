<?php
class Controller_taofilemodule extends Application {
    public $param;
    function __construct() {
        $this->param = $this->getParam();
    }
    function index() {
        if (isset($_POST["taofile"])) {
            $a = new Model_Adapter();
            $conTroller  = "Controller/".$_POST["Name"].".php";
            $NoiDung = '<?php class Controller_'.$_POST["Name"].' extends Application { function __construct() { }function index() {}  } ?>';
            $a->_createFile($conTroller, $NoiDung);
            $conTroller  = "View/".$_POST["Name"]."/";
            $a->_createDir($conTroller);
            $conTroller  = "View/".$_POST["Name"]."/index.phtml";
            $a->_createFile($conTroller, "");
        }
        $this->AView("");
    }

}
?>

