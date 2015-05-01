<?php

namespace TDD\Componentes;

class InputTest extends \PHPUnit_Framework_TestCase {

    private $input;

    public function setUp() {
        $this->input = new Input("nome", "text", "nome_id", "Raphael Mendes");
    }

    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("\TDD\Interfaces\ComponenteInterface", $this->input);
    }
    
    public function testVerificaGetESetName() {
        $this->input->setName("valor");
        $this->assertEquals("valor", $this->input->getName());
    }
    public function testVerificaGetESetValue() {
        $this->input->setValue(1.25);
        $this->assertEquals(1.25, $this->input->getValue());
    }
    public function testVerificaGetESetErro() {
        $this->input->setErro("O campo deve ser inteiro");
        $this->assertEquals("O campo deve ser inteiro", $this->input->getErro());
    }
      public function testVerificaGetESeType() {
        $this->input->setType("text");
        $this->assertEquals("text", $this->input->getType());
    }
    public function testVerificaGetESetId() {
        $this->input->setId("valor_id");
        $this->assertEquals("valor_id", $this->input->getId());
    }
    
    public function testVerificandoRetornoDoRender() {
        $this->input->setErro("Deve conter 15 caracteres");
        $this->assertEquals("<input type='text' name='nome' id='nome_id' value='Raphael Mendes' ><ul><li>Deve conter 15 caracteres</li></ul>", $this->input->render());
    }
    
        public function tearDown() {
        $this->input = NULL;
    }
}
