<?php

namespace TDD\Componentes;

class TextTest extends \PHPUnit_Framework_TestCase {

    private $text;

    public function setUp() {
        $this->text = new Text("Texto Livre");
    }

    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ComponenteInterface", $this->text);
    }

    public function testVerificaFuncionamentoSetTextEGetText() {
        $this->text->setText("Novo texto de teste");
        $this->assertEquals("Novo texto de teste", $this->text->getText());
    }

    public function testRender() {
        $this->assertEquals("Texto Livre", $this->text->render());
    }

}
