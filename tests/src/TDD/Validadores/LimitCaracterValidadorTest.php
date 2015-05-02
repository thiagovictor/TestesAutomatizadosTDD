<?php

namespace TDD\Validadores;

class LimitCaracterValidadorTest extends \PHPUnit_Framework_TestCase {

    private $validador;
    private $limit = 5;

    public function setUp() {
        $this->validador = new LimitCaracterValidador($this->limit);
    }

    public function providerStrings() {
        return [
            ["", true],
            ["Mais de 5 caracteres", false],
            ["cinco", true],
            ["test", true],
            ["menina", false]
        ];
    }

    /**
     * @dataProvider providerStrings
     */
    public function testVerificaSeORetornoDoLimitadorEstaCorreto($valor, $resultado) {
        $this->assertEquals($resultado, $this->validador->isValid($valor));
        if(!$resultado){
            $this->assertEquals("Este campo excedeu o Limite permitido: max. {$this->limit} caracteres.", $this->validador->getMessageError());
        }
    }

}
