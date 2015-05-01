<?php

namespace TDD\Componentes;

class FieldsetTest extends \PHPUnit_Framework_TestCase {

    private $fieldset;

    public function setUp() {
        $this->fieldset = new Fieldset("Cadastro");
    }

    public function testVerificaSeEUmaInstanciaValidaDeComponentesDeInterface() {
        $this->assertInstanceOf("TDD\Interfaces\ComponenteInterface", $this->fieldset);
    }

    public function testVerificaSetEGetLegenda() {
        $this->fieldset->setLegenda("Cadastro de produtos");
        $this->assertEquals("Cadastro de produtos", $this->fieldset->getLegenda());
    }

    public function testVerificaGetFieldNaRaiz() {
        $this->fieldset->setField(new Input("nome_alimento"));
        $this->assertEquals("nome_alimento", $this->fieldset->getFieldPopulateByName("nome_alimento")->getName());
    }

    public function testVerificaGetFieldDentroDeOutroFieldSet() {
        $fieldsetPai = new Fieldset("FieldsetPai");
        $this->assertFalse($fieldsetPai->getFieldPopulateByName("nome"));
        $this->fieldset->setField(new Input("nome_alimento"));
        $fieldsetPai->setField($this->fieldset);
        $fieldsetPai->setField(new Input("nome_produto"));
        $this->assertEquals("nome_alimento", $fieldsetPai->getFieldPopulateByName("nome_alimento")->getName());
        $this->assertEquals("nome_produto", $fieldsetPai->getFieldPopulateByName("nome_produto")->getName());
    }
    
    public function testVerificaSetValueByNameNaRaiz() {
        $this->fieldset->setField(new Input("nome_alimento"));
        $this->assertTrue($this->fieldset->setValueFieldPopulateByName("nome_alimento", "Teste"));
    }
    
    public function testFailVerificaSetValueByNameNaRaiz() { 
        $this->assertFalse($this->fieldset->setValueFieldPopulateByName("nome_alimento", "Teste"));
        $this->fieldset->setField(new Input("nome_alimento"));
        $this->assertFalse($this->fieldset->setValueFieldPopulateByName("nome_inexistente", "Teste"));
    }
    
    public function testVerificaSeEstaPassandoQuandoOComponenteNaoEPopulate() {
        $this->fieldset->setField(new Quebra());
        $this->fieldset->setField(new Input("nome_alimento"));
        $this->assertFalse($this->fieldset->setValueFieldPopulateByName("nome_inexistente", "Teste"));
    }
    
    public function testVerificaSetValueByNameDentroDeOutrosFieldsets() {
        $fieldsetPai = new Fieldset("FieldsetPai");
        $this->fieldset->setField(new Input("nome_alimento"));
        $fieldsetPai->setField($this->fieldset);
        $fieldsetPai->setField(new Input("nome_produto"));
        $this->assertTrue($fieldsetPai->setValueFieldPopulateByName("nome_produto", "Sorvete"));
        $this->assertTrue($fieldsetPai->setValueFieldPopulateByName("nome_alimento", "Banana"));
    }
    
    public function testRender() {
        $this->fieldset->setField(new Input("nome_alimento"));
        $this->assertEquals("<fieldset><legend>Cadastro</legend><input type='' name='nome_alimento'  value='' ></fieldset>", $this->fieldset->render());
    }

}
