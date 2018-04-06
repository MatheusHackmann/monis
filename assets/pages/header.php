<?php 
session_start();

if (!$_SESSION['usuario']) {
	session_destroy();
	header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/popper.min.js"></script>
</head>
<body>
	<nav class="navbar fixed-top navbar-toggleable-sm navbar-expand-lg bg-modify">

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav">
				<li class="nav-item">
					<a href="index.php" class="nav-link">Home</a>
				</li>					
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Leis
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="leis.php" style="color: #000;">Cadastrar Leis</a>
						<a class="dropdown-item" href="buscar_leis.php" style="color: #000;">Buscar Leis</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Portarias
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="portarias.php" style="color: #000;">Cadastrar Portarias</a>
						<a class="dropdown-item" href="buscar_portarias.php" style="color: #000;">Buscar Portarias</a>
					</div>
				</li>					
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Decretos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="decretos.php" style="color: #000;">Cadastrar Decretos</a>
						<a class="dropdown-item" href="buscar_decretos.php" style="color: #000;">Buscar Decretos</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Requerimentos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="requerimentos.php" style="color: #000;">Cadastrar Requerimentos</a>
						<a class="dropdown-item" href="buscar_requerimentos.php" style="color: #000;">Buscar Requerimentos</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Indicações
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="indicacoes.php" style="color: #000;">Cadastrar Indicações</a>
						<a class="dropdown-item" href="buscar_indicacoes.php" style="color: #000;">Buscar Indicações</a>
					</div>
				</li>	

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Ofícios
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="oficios.php" style="color: #000;">Cadastrar Ofícios</a>
						<a class="dropdown-item" href="buscar_oficios.php" style="color: #000;">Buscar Ofícios</a>
					</div>
				</li>													

				<li class="nav-item">
					<a class="nav-link" href="logout.php" style="color: #fff;"><strong>Sair</strong></a>
				</li>															
			</ul>
		</div>
	</nav>