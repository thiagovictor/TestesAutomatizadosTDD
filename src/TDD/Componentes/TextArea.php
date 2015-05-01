<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface,
    TDD\Interfaces\ComponentePopulate;

class TextArea implements ComponenteInterface, ComponentePopulate {

    private $texto;
    private $name;
    private $erro;

    public function __construct($name = "", $texto = "") {
        $this->texto = $texto;
        $this->name = $name;
    }

    public function render() {
        if ($this->erro) {
            $this->erro = "<ul><li>{$this->erro}</li></ul>";
        }
        return "<textarea name='{$this->name}'>{$this->texto}</textarea> {$this->erro}";
    }

    public function setTexto($texto) {
        $this->texto = $texto;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setValue($value) {
        $this->texto = $value;
    }

    public function setErro($mensagem) {
        $this->erro = $mensagem;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->texto;
    }

    public function getTexto() {
        return $this->texto;
    }

    function getErro() {
        return $this->erro;
    }

}
