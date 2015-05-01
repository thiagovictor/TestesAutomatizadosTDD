<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface,
    TDD\Interfaces\ComponentePopulate;

class Select implements ComponenteInterface, ComponentePopulate {

    private $name;
    private $options;
    private $erro;
    private $default;

    public function __construct($name = "") {
        $this->name = $name;
    }

    public function render() {
        $render = "<select name='{$this->name}'>";
        if (NULL != $this->default) {
            foreach ($this->default as $key => $value) {
                $render .= "<option value='{$key}'>{$value}</option>";
            }
        }
        if (NULL != $this->options) {
            foreach ($this->options as $key => $value) {
                $render .= "<option value='{$key}'>{$value}</option>";
            }
        }
        $render .= "</select>";
        if ($this->erro) {
            $render .= "<ul><li>{$this->erro}</li></ul>";
        }
        return $render;
    }

    public function setName($nome) {
        $this->name = $nome;
    }

    public function setOption($chave, $valor) {
        $this->options[$chave] = $valor;
    }

    public function setOptions(array $options) {
        foreach ($options as $chave => $valor) {
            $this->setOption($chave, $valor);
        }
    }
    /*
     * Method Interface setDefault
     */
    public function setValue($value) {
        if(isset($this->options[$value])){
            $this->default = [$value => $this->options[$value]];
            unset($this->options[$value]);
            return true;
        }
        $this->setErro("Valor fornecido como Default não existe na lista de opcoes");
        return false;
    }

    public function setErro($mensagem) {
        $this->erro = $mensagem;
    }

    public function getName() {
        return $this->name;
    }

    public function getDefault() {
        return $this->default;
    }

    public function getValue() {
        return $this->options;
    }

    function getErro() {
        return $this->erro;
    }

}
