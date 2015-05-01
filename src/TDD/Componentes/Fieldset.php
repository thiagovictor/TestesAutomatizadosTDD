<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface,
    TDD\Interfaces\ComponentePopulate;

class Fieldset implements ComponenteInterface {

    private $legenda;
    private $fields;

    public function __construct($legenda = "") {
        $this->legenda = $legenda;
    }

    public function render() {
        $render = "<fieldset>";
        if ($this->legenda != NULL) {
            $render .= "<legend>{$this->legenda}</legend>";
        }
        if (!$this->emptyFields()) {
            foreach ($this->fields as $field) {
                $render .= $field->render();
            }
        }
        return $render .= "</fieldset>";
    }

    public function emptyFields() {
        if (NULL == $this->fields) {
            return true;
        }
        return false;
    }

    function getLegenda() {
        return $this->legenda;
    }

    function setLegenda($legenda) {
        $this->legenda = $legenda;
    }

    function setField(ComponenteInterface $field) {
        $this->fields[] = $field;
    }
    function setValueFieldPopulateByName($name,$value,$mensagem="") {
        if ($this->emptyFields()) {
            return false;
        }
        foreach ($this->fields as $field) {
            if ($field instanceof Fieldset) {
                if ($field->setValueFieldPopulateByName($name,$value,$mensagem)) {
                    return true;
                }
            }
            if (!$field instanceof ComponentePopulate) {
                continue;
            }
            if ($field->getName() == $name) {
                $field->setValue($value);
                $field->setErro($mensagem);
                return true;
            }
        }
        return false;
    }
    function getFieldPopulateByName($name) {
        if ($this->emptyFields()) {
            return false;
        }
        foreach ($this->fields as $field) {
            if ($field instanceof Fieldset) {
                $retorno = $field->getFieldPopulateByName($name);
                if ($retorno) {
                    return $retorno;
                }
            }
            if (!$field instanceof ComponentePopulate) {
                continue;
            }
            if ($field->getName() == $name) {
                return $field;
            }
        }
        return false;
    }

}
