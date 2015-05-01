<?php

namespace TDD\Componentes;

class LabetTest extends \PHPUnit_Framework_TestCase {

    private $label;

    public function setUp() {
        $this->label = new Label("nome", "Nome :");
    }

    public function testVerificaSeEInstanciaDeComponenteInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ComponenteInterface", $this->label);
    }

    public function testGetESetFor() {
        $this->label->setFor("nome");
        $this->assertEquals("nome", $this->label->getFor());
    }
    
    public function testGetESetLabel() {
        $this->label->setLabel("Nome Completo: ");
        $this->assertEquals("Nome Completo: ", $this->label->getLabel());
    }
    
    public function testRender() {
        $this->assertEquals("<label for='nome'>Nome :</label>", $this->label->render());
    }

}
