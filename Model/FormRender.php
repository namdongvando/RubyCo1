<?php

namespace Model;

use PFBC\Element;

class FormRender extends Element {

    public $element;

    function __construct($element) {
        $this->element = $element;
    }

    public function render() {
        return $this->element->render();
    }

    public function renderHTML() {
        $label = $this->element->getLabel();
        $htmlTemplate = <<<HTML
                <div class="form-group">
                                    <label >$label</label>
HTML;
        echo $htmlTemplate;
        $this->element->render();
        echo "</div>";
    }

}
