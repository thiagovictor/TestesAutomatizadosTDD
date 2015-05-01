<?php

namespace TDD\Componentes;

class TextAreaTest extends \PHPUnit_Framework_TestCase {

    private $text_area;

    public function setUp() {
        $this->text_area = new TextArea("area_texto","Mensagem de conteudo de um TextArea");
    }

    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ComponenteInterface", $this->text_area);
    }

    public function testVerificaSetEGetNome() {
        $this->text_area->setName("Descricao");
        $this->assertEquals("Descricao", $this->text_area->getName());
    }

    public function testVerificaSetEGetTexto() {
        $this->text_area->setTexto("Esta e um texto");
        $this->assertEquals("Esta e um texto", $this->text_area->getTexto());
    }

    public function testVerificaSetEGetValue() {
        $this->text_area->setValue("Esta e um texto");
        $this->assertEquals("Esta e um texto", $this->text_area->getValue());
    }
    
    public function testVerificaSetEGetErro() {
        $this->text_area->setErro("Esta e uma mensagem de erro");
        $this->assertEquals("Esta e uma mensagem de erro", $this->text_area->getErro());
    }
    
    public function testRender() {
        $this->text_area->setErro("Esta e uma mensagem de erro");
        $this->assertEquals("<textarea name='area_texto'>Mensagem de conteudo de um TextArea</textarea> <ul><li>Esta e uma mensagem de erro</li></ul>", $this->text_area->render());
    }

}
