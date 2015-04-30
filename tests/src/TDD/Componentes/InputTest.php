<?php

namespace TDD\Componentes;

class InputTest extends \PHPUnit_Framework_TestCase {

    private $input;

    public function setUp() {
        $this->input = new Input();
    }

    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("\TDD\Interfaces\ComponenteInterface", $this->input);
    }

}
