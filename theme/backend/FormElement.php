<?php

namespace \theme\backend;

class FormElement extends PFBC\Form {

    function __construct() {

    }

    function functionName($var) {
        return new PFBC\Element\Textbox($label, $name);
    }

}

?>