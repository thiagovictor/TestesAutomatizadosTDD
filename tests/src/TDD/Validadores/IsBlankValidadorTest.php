<?php

namespace TDD\Validadores;

class IsBlankValidadorTest extends \PHPUnit_Framework_TestCase {

    private $validador;

    public function setUp() {
        $this->validador = new IsBlankValidador();
    }

    public function testVerificaSeEUmaInstanciaValidaDeValidadorInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ValidadorInterface", $this->validador);
    }

    function testVerificaSeEUmValorVazio() {
        $this->assertTrue($this->validador->isValid("Esta e uma frase de teste"));
        $this->assertFalse($this->validador->isValid(""));
        $this->assertEquals("Este campo nao pode estar vazio", $this->validador->getMessageError());
    }

}
