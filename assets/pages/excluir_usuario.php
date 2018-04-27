<?php

require_once("../classes/User.php");
session_start();

$deletarUsuario = new User();
$local = $deletarUsuario->deletarUsuario($_GET['id']);

if ($local === "1") 
{
	header("Location: ../../index.php");
}
else
{
	header("Location: gerenciar_usuarios.php");
}


?>