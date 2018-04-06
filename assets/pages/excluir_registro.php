<?php

require_once("../classes/Registros.php");

$excluirRegistro = new Registros();
$excluirRegistro->setTabela($_GET['nome_tabela']);
$excluirRegistro->excluirRegistro($_GET['nmr_registro']);

$location = $_GET['nome_tabela']; 
header("Location: buscar_".$location.".php");


?>