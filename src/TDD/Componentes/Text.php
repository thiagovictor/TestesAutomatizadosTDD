<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface;

class Text implements ComponenteInterface {

    private $text;

    public function __construct($text = "") {
        $this->text = $text;
    }

    public function render() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    
    public function getText() {
        return $this->text;
    }
}
