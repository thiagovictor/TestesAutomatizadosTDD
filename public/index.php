<?php
chdir(dirname(__DIR__));
require 'autoloader.php';

$form = new \TDD\Formulario\Formulario(new \TDD\Factory\FieldFactory());
$form->setParametros("name", "Cadastro")
        ->setParametros("action", "")
        ->setParametros("method", "POST")
        ->setParametros("id", "form_cad_clientes");
$form->setValidadores(new \TDD\Validadores\LimitCaracterValidador("15"), ["cliente", "endereco"])
        ->setValidadores(new \TDD\Validadores\IsBlankValidador(), ["nome"]);
$form->createField("TDD\Componentes\Fieldset", ["legenda" => "Cadastro Clientes"]);
$form->createField("TDD\Componentes\Label", ["for" => "nome", "label" => "Nome :"]);
$form->createField("TDD\Componentes\Input", ["name" => "nome", "type" => "text"]);
$form->createField("TDD\Componentes\Quebra");
$form->createField("TDD\Componentes\Label", ["for" => "cliente", "label" => "Cliente :"]);
$form->createField("TDD\Componentes\Input", ["name" => "cliente", "type" => "text"]);
$form->createField("TDD\Componentes\Quebra");
$form->createField("TDD\Componentes\Label", ["for" => "endereco", "label" => "Endereco :"]);
$form->createField("TDD\Componentes\Input", ["name" => "endereco", "type" => "text"]);
$form->createField("TDD\Componentes\Quebra");
$form->createField("TDD\Componentes\Fieldset", ["legenda" => "Dados Pessoais"]);
$form->createField("TDD\Componentes\Label", ["for" => "cpf", "label" => "Documento :"]);
$form->createField("TDD\Componentes\Input", ["name" => "cpf", "type" => "text"]);
$form->createField("TDD\Componentes\Quebra");
$form->createField("TDD\Componentes\Label", ["for" => "telefone", "label" => "Tel :"]);
$form->createField("TDD\Componentes\Input", ["name" => "telefone", "type" => "text"]);
$form->automaticClosedFieldset();
$form->createField("TDD\Componentes\Input", ["name" => "enviar", "type" => "submit", "value" => "Enviar"]);
?>

<html>
    <head>
        <title>Testes Automatizados com PHPUnit / Selenium</title>
    </head>
    <body>

                <?php
                if (!empty($_POST)) {
                    $form->popular($_POST);
                    echo $form->render();
                } else {
                    echo $form->render();
                }
                ?>

    </body>
</html>



