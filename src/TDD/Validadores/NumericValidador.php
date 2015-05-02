<?php

namespace TDD\Validadores;

use TDD\Interfaces\ValidadorInterface;

class NumericValidador implements ValidadorInterface {

    private $message;

    public function isValid($data) {
        if (!is_numeric($data)) {
            $this->message = "Este nao e um valor numerico";
            return false;
        }
        $this->message = "";
        return true;
    }

    public function getMessageError() {
        return $this->message;
    }

}
