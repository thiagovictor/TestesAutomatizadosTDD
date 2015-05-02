<?php

namespace TDD\Formulario;

use TDD\Factory\FieldFactory;
use TDD\Componentes\Fieldset;
use TDD\Interfaces\ValidadorInterface,
    TDD\Interfaces\ComponentePopulate;

class Formulario {

    private static $METHOD = "METHOD";
    private $componentes = array();
    private $validadores = array();
    private $factory;
    private $fieldset = array();
    private $params = array();

    public function __construct(FieldFactory $factory) {
        $this->factory = $factory;
    }

    public function setParametros($indice, $valor) {
        $this->params[$indice] = $valor;
        return $this;
    }

    public function getParametros($indice) {
        if (isset($this->params[$indice])) {
            return $this->params[$indice];
        }
        return false;
    }

    public function setValidadores(ValidadorInterface $validador, array $for = array()) {
        $this->validadores[] = ["validador" => $validador, "for" => $for];
        return $this;
    }

    public function getValidadores($for) {
        if (!empty($this->validadores)) {
            foreach ($this->validadores as $validador) {
                foreach ($validador["for"] as $for_) {
                    if ($for == $for_) {
                        return $validador["validador"];
                    }
                }
            }
            return false;
        }
        return false;
    }

    public function render() {
        $this->automaticClosedFieldset();
        $cabecalho_form = "<form ";
        foreach ($this->params as $key => $value) {
            $cabecalho_form .= "{$key}='{$value}' ";
        }
        $cabecalho_form .= ">";

        foreach ($this->componentes as $componente) {
            $cabecalho_form .= $componente->render();
        }
        $rodape = "</form>";
        return $cabecalho_form . $rodape;
    }

    public function createField($tipo, array $parametros = array()) {
        $field = $this->factory->createField($tipo, $parametros);
        if (!$field) {
            return false;
        }
        if ($field instanceof Fieldset) {
            $this->fieldset[] = $field;
            return $field;
        }
        if (!$this->getFieldsetAtivo()) {
            $this->componentes[] = $field;
            return $field;
        }
        $this->getFieldsetAtivo()->setField($field);
        return $field;
    }

    public function fieldsetClose() {
        $fieldset = $this->getFieldsetAtivo();
        if ($fieldset) {
            unset($this->fieldset[sizeof($this->fieldset) - 1]);
            $fieldset_ativo = $this->getFieldsetAtivo();
            if ($fieldset_ativo) {
                $this->fieldset[sizeof($this->fieldset) - 1]->setField($fieldset);
                return true;
            }
            $this->componentes[] = $fieldset;
            return true;
        }
        return false;
    }

    public function getFieldsetAtivo() {
        return end($this->fieldset);
    }

    public function automaticClosedFieldset() {
        while ($this->getFieldsetAtivo()) {
            $this->fieldsetClose();
        }
    }

    public function validar($name, $value) {
        $validador = $this->getValidadores($name);
        $mensagem = "";
        if ($validador) {
            if (!$validador->isValid($value)) {
                $mensagem = $validador->getMessageError();
            }
        }
        return $mensagem;
    }

    function setValueFieldPopulateByName($name, $value) {
        $this->automaticClosedFieldset();
        if (empty($this->componentes)) {
            return false;
        }
        foreach ($this->componentes as $field) {
            if ($field instanceof Fieldset) {
                if ($field->setValueFieldPopulateByName($name, $value, $this->validar($name, $value))) {
                    return true;
                }
            }
            if (!$field instanceof ComponentePopulate) {
                continue;
            }

            if ($field->getName() == $name) {
                $field->setValue($value);
                $field->setErro($this->validar($name, $value));
                return true;
            }
        }
        return false;
    }
    
    public function popular($data) {
        foreach ($data as $key => $value) {
            return $this->setValueFieldPopulateByName($key, $value);
        }
        return false;
    }

}
