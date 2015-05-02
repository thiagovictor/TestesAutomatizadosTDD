<?php

namespace TDD\Validadores;

use TDD\Interfaces\ValidadorInterface;

class LimitCaracterValidador implements ValidadorInterface {
    private $limit;
    private $message;
    
    public function __construct($limit) {
        $this->limit = $limit;
    }
    public function isValid($data){
        if(strlen($data) > $this->limit ){
            $this->message = "Este campo excedeu o Limite permitido: max. {$this->limit} caracteres.";
            return false;
        }
       $this->message = "";
       return true;
    }

    public function getMessageError() {
        return $this->message;
    }

}
