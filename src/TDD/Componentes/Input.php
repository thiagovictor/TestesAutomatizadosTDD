<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface,
    TDD\Interfaces\ComponentePopulate;

class Input implements ComponenteInterface, ComponentePopulate {

    private $name;
    private $value;
    private $erro;

    public function render() {
        
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setErro($mensagem) {
        $this->erro = $mensagem;
        return $this;
    }

}
