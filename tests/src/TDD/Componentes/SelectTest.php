<?php

namespace TDD\Componentes;

class SelectTest extends \PHPUnit_Framework_TestCase {

    private $select;

    public function setUp() {
        $this->select = new Select("centro_custo");
        $this->select->setOption(1, "ALIMENTACAO");
        $this->select->setOption(2, "TRANSPORTE");
    }

    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ComponenteInterface", $this->select);
    }

    public function testVerificaGetValue() {
        $this->assertEquals("ALIMENTACAO", $this->select->getValue()[1]);
        $this->assertEquals("TRANSPORTE", $this->select->getValue()[2]);
    }

    public function testVerificaSetEGetDefaultESetValue() {
        $this->select->setValue(2);
        $this->assertEquals("TRANSPORTE", $this->select->getDefault()[2]);
    }
    
    public function testFailSetValue() {
        $this->assertFalse($this->select->setValue(5));
    }

    public function testSetEGetName() {
        $this->select->setName("CentroCusto");
        $this->assertEquals("CentroCusto", $this->select->getName());
    }

    public function testGetESetErro() {
        $this->select->setErro("Mensagem de erro");
        $this->assertEquals("Mensagem de erro", $this->select->getErro());
    }

    public function testSetOptions() {

        $this->select->setOptions(array(
            0 => "ALIMENTACAO",
            1 => "TRANSPORTE",
            2 => "PESSOAL",
            3 => "LAZER",
        ));
        $this->assertArrayHasKey(3, $this->select->getValue());
    }
    
    public function testFailRender() {
        $this->select->setValue(6);
        $this->assertEquals("<select name='centro_custo'><option value='1'>ALIMENTACAO</option><option value='2'>TRANSPORTE</option></select><ul><li>Valor fornecido como Default não existe na lista de opcoes</li></ul>", $this->select->render());
    }
    
    public function testRender() {
        $this->select->setValue(1);
        $this->assertEquals("<select name='centro_custo'><option value='1'>ALIMENTACAO</option><option value='2'>TRANSPORTE</option></select>", $this->select->render());
    }
}
