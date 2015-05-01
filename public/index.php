<?php
chdir(dirname(__DIR__));
require 'autoloader.php';


$label = new TDD\Componentes\Label("nome", "Nome :");
$input = new TDD\Componentes\Input("nome", "text", "nome_id", "Raphael Mendes");
$input->setErro("Deve conter 15 caracteres");
$text_area = new \TDD\Componentes\TextArea("area_texto","Mensagem de conteudo de um TextArea");
$text_area->setErro("Esta e uma mensagem de erro");

?>

<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php echo $text_area->render();?>
    </body>
</html>



