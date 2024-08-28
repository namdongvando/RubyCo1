<?php

namespace Model;

use PFBC\Element;

class FormRender extends Element
{

    public $element;

    const readonly = "readonly";
    const required = "required";
    const autofocus = "autofocus";
    const checked = "checked";

    function __construct($element)
    {
        $this->element = $element;
    }

    public function render()
    {
        return $this->element->render();
    }

    public function renderHTML($class = null)
    {
        $label = $this->element->getLabel();
        $startTag = "";
        $endTag = "";
        if ($class) {
            $startTag = "<div class='{$class}' >";
            $endTag = "</div>";
        }
        $htmlTemplate = <<<HTML
            {$startTag}
                <div class="form-group">
                    <label >$label</label>
            
HTML;
        echo $htmlTemplate;
        $this->element->render();
        echo "</div>" . $endTag;
    }

}