<?php

namespace TDD\Factory;

class FieldFactoryTest extends \PHPUnit_Framework_TestCase {

    private $factory;

    public function setUp() {
        $this->factory = new FieldFactory();
    }

    public function testVerificaSeEUmaInstanciaValidaDeFactoryInterface() {
        $this->assertInstanceOf("TDD\Interfaces\FactoryInterface", $this->factory);
    }

    public function testVerificaCreateField() {
        $field = $this->factory->createField("TDD\Componentes\Input", array(
            "name" => "nome",
            "type" => "text",
            "id" => "nome_id",
            "value" => "Teste de valor"
        ));
        $this->assertInstanceOf("TDD\Componentes\Input", $field);
    }

    public function testFailVerificaCreateField() {
        $field = $this->factory->createField("TDD\Componentes\Input", array(
            "name" => "nome",
            "campo_inexistente" => "text",
            "id" => "nome_id",
            "value" => "Teste de valor"
        ));
        $this->assertFalse($field);
    }

    public function testFailInstanceOfVerificaCreateField() {
        $field = $this->factory->createField("TDD\Factory\FieldFactory", array(
            "name" => "nome",
            "campo_inexistente" => "text",
            "id" => "nome_id",
            "value" => "Teste de valor"
        ));
        $this->assertFalse($field);
    }

}
