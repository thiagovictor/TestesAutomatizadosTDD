<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface,
    TDD\Interfaces\ComponentePopulate;

class Input implements ComponenteInterface, ComponentePopulate {

    private $name;
    private $value;
    private $erro;
    private $type;
    private $id;

    public function __construct($name = "", $type = "", $id = "", $value = "") {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->id = $id;
    }

    public function render() {
        $id = $this->id;
        if ($this->id != "") {
            $id = "id='{$this->id}'";
        }

        if ($this->erro) {
            $this->erro = "<ul><li>{$this->erro}</li></ul>";
        }
        return "<input type='{$this->type}' name='{$this->name}' {$id} value='{$this->value}' >{$this->erro}";
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

    public function getType() {
        return $this->type;
    }

    public function getId() {
        return $this->id;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getErro() {
        return $this->erro;
    }

}
