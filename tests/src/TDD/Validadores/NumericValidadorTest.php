<?php

namespace TDD\Validadores;

class NumericValidadorTest  extends \PHPUnit_Framework_TestCase{
    private $validador;
    
    public function setUp() {
        $this->validador = new NumericValidador();
    }
    public function providerNumber() {
        return [
            [10.2,true],
            ['10,2', false],
            ['string', false],
            ['10.2', true],
            [10, true]
            
        ];
    }
    /**
     * @dataProvider providerNumber
     */
    public function testVerificarSeORetornoENumerico($valor, $resultado) {
        $this->assertEquals($resultado, $this->validador->isValid($valor));
        if(!$resultado){
            $this->assertEquals("Este nao e um valor numerico", $this->validador->getMessageError());
        }
    }
}
