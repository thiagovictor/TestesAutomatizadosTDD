<?php

namespace TDD\Formulario;

use TDD\Factory\FieldFactory;

class FormularioTest extends \PHPUnit_Framework_TestCase {

    private $formulario;
    private $factory;

    public function setUp() {
        $this->factory = new FieldFactory;
        $this->formulario = new Formulario($this->factory);
    }

    public function testVerificaRender() {
        $this->formulario->setParametros("name", "Cadastro")
                ->setParametros("action", "")
                ->setParametros("method", "POST")
                ->setParametros("id", "form_cad_clientes");
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Cadastro Clientes"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "cliente", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "endereco", "type" => "text"]);
        $this->assertEquals("<form name='Cadastro' action='' method='POST' id='form_cad_clientes' ><input type='text' name='nome'  value='' ><fieldset><legend>Cadastro Clientes</legend><input type='text' name='cliente'  value='' ><input type='text' name='endereco'  value='' ></fieldset></form>", $this->formulario->render());
    }

    public function testVerificaSetEGetParametros() {
        $this->formulario->setParametros("method", "POST");
        $this->assertEquals("POST", $this->formulario->getParametros("method"));
        $this->assertFalse($this->formulario->getParametros("inexistente"));
    }

    public function testVerificaCriacaoDeFields() {
        $input = $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $this->assertInstanceOf("TDD\Componentes\Input", $input);
        $fieldset = $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Cadastro"]);
        $this->assertInstanceOf("TDD\Componentes\Fieldset", $fieldset);
        $input_in_fieldset = $this->formulario->createField("TDD\Componentes\Input", ["name" => "cliente", "type" => "text"]);
        $this->assertInstanceOf("TDD\Componentes\Input", $input_in_fieldset);
    }

    public function testFailVerificaCriacaoDeFields() {
        $this->assertFalse($this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "inexistente" => "text"]));
    }

    public function testVerificaFieldsetClose() {
        $this->formulario->setParametros("name", "Cadastro")
                ->setParametros("action", "")
                ->setParametros("method", "POST")
                ->setParametros("id", "form_cad_clientes");
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Cadastro Clientes"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "cliente", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "endereco", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Dados Pessoais"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "cpf", "type" => "text"]);
        $this->formulario->fieldsetClose();
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "telefone", "type" => "text"]);
        $this->formulario->fieldsetClose();
        $this->assertFalse($this->formulario->getFieldsetAtivo());
    }

    public function testFailVerificaFieldsetClose() {
        $this->assertFalse($this->formulario->fieldsetClose());
    }

    public function testVerificaSeteGetValidadores() {
        $this->formulario->setParametros("name", "Cadastro")
                ->setValidadores(new \TDD\Validadores\IsBlankValidador(), array("name"));
        $this->assertInstanceOf("TDD\Interfaces\ValidadorInterface", $this->formulario->getValidadores("name"));
        $this->assertFalse($this->formulario->getValidadores("inexistente"));
    }

    public function testFailVerificaValidadoresVazio() {
        $this->formulario->setParametros("name", "Cadastro");
        $this->assertFalse($this->formulario->getValidadores("inexistente"));
    }

    public function testSetValorEmComponentesJaCriados() {
        $this->formulario->createField("TDD\Componentes\Label", ["for" => "nome", "label" => "Nome :"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Cadastro Clientes"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "cliente", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "endereco", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Dados Pessoais"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "cpf", "type" => "text"]);
        $this->assertTrue($this->formulario->setValueFieldPopulateByName("nome", "Thiago Santos"));
        $this->assertTrue($this->formulario->setValueFieldPopulateByName("endereco", "Rua passa vinte"));
    }

    public function testFailSetValueEmComponentesJaCriados() {
        $this->assertFalse($this->formulario->setValueFieldPopulateByName("inexistente", "Vai falhar"));
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $this->formulario->createField("TDD\Componentes\Fieldset", ["legenda" => "Cadastro Clientes"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "endereco", "type" => "text"]);
        $this->formulario->fieldsetClose();
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "cpf", "type" => "text"]);
        $this->assertFalse($this->formulario->setValueFieldPopulateByName("inexistente", "Vai falhar"));
    }

    public function testSetValueInvalido() {
        $this->formulario->setValidadores(new \TDD\Validadores\LimitCaracterValidador(5), ["nome"]);
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        //Ira gerar mensagem de erro para exibir no formulario
        $this->assertTrue($this->formulario->setValueFieldPopulateByName("nome", "Vai falhar"));
    }

    public function testVerificaPopular() {
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $data = array("nome" => "Teste de nome");
        $this->assertTrue($this->formulario->popular($data));
        $this->assertFalse($this->formulario->popular(array()));
    }
    
        public function testFailVerificaPopular() {
        $this->formulario->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
        $data = array("nao_existe" => "Teste de nome");
        $this->assertFalse($this->formulario->popular($data));
    }
}
