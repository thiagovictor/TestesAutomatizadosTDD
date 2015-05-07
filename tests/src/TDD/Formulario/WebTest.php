<?php

namespace TDD\Formulario;

class WebTest extends \PHPUnit_Extensions_Selenium2TestCase {

    protected function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost:8080/');
    }

    public function testVerificaTituloDaPagina() {
        $this->url('/');
        $this->assertEquals("Testes Automatizados com PHPUnit / Selenium", $this->title());
    }

    public function testVerificaIndividualmenteSeSubmitVazioRetornaErroNoCampoNome() {
        $this->url('/');
        $form = $this->byId("form_cad_clientes");
        $form->submit();
        $erro = $this->byCssSelector("li")->text();
        $this->assertEquals("Este campo nao pode estar vazio", $erro);
    }

    public function testVerificaIdividualmenteORetornoDoValidarDeCampoLimitIgualA15ParaCliente() {
        $this->url('/');
        $form = $this->byId("form_cad_clientes");
        $this->byName("nome")->value("NOME DO CLIENTE");
        $this->byName("cliente")->value("NOME DE TESTE DE CLIENTE PARA EXEDER O LIMITE");
        $form->submit();
        $erro = $this->byCssSelector("li")->text();
        $this->assertEquals("Este campo excedeu o Limite permitido: max. 15 caracteres.", $erro);
    }

    public function testVerificaIdividualmenteORetornoDoValidarDeCampoLimitIgualA15() {
        $this->url('/');
        $form = $this->byId("form_cad_clientes");
        $this->byName("nome")->value("NOME DO CLIENTE");
        $this->byName("endereco")->value("ENDERECO EXCEDE O LIMIT ");
        $form->submit();
        $erro = $this->byCssSelector("li")->text();
        $this->assertEquals("Este campo excedeu o Limite permitido: max. 15 caracteres.", $erro);
    }

    public function testVerificaTodosOsErros() {
        $this->url('/');
        $form = $this->byId("form_cad_clientes");
        $this->byName("cliente")->value("NOME DE TESTE DE CLIENTE PARA EXCEDER O LIMITE");
        $this->byName("endereco")->value("ENDERECO EXCEDE O LIMIT ");
        $form->submit();
        $body = $this->byCssSelector("body")->text();
        $this->assertContains("Este campo excedeu o Limite permitido: max. 15 caracteres.", $body);
        $this->assertContains("Este campo nao pode estar vazio", $body);
    }
    /*
     * @expectedException Exception
     */
    public function testVerificaTodosPreenchidosCorretamente() {
        $this->url('/');
        $form = $this->byId("form_cad_clientes");
        $this->byName("nome")->value("NOME");
        $this->byName("cliente")->value("NOME CLIENTE");
        $this->byName("endereco")->value("ENDERECO");
        $form->submit();
        $this->assertNotContains("<li>", $this->source());
    }

}
