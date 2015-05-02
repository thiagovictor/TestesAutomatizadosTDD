<?php

namespace TDD\Factory;

use TDD\Interfaces\ComponenteInterface,
    TDD\Interfaces\FactoryInterface;

class FieldFactory implements FactoryInterface {

    public function createField($tipo, array $parametros = array()) {
        $field = new $tipo;
        if (!$field instanceof ComponenteInterface) {
            return false;
        }
        foreach ($parametros as $metodo => $valor) {
            $metodo = 'set' . ucfirst($metodo);
            if (!method_exists($field, $metodo)) {
                return false;
            }
            $field->$metodo($valor);
        }
        return $field;
    }

}
