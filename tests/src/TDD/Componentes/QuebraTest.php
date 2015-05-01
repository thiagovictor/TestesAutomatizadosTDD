<?php

namespace TDD\Componentes;

class QuebraTest extends \PHPUnit_Framework_TestCase{
    private $quebra;
    
    public function setUp() {
        $this->quebra = new Quebra();
    }
    
    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ComponenteInterface", $this->quebra);        
    }
    
    public function testRender() {
        $this->assertEquals("<br>", $this->quebra->render());
    }
}

