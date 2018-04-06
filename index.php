<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script type="text/javascript" src="assets/js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="offset-4 col-4" style="margin-top: 200px;">
				<form class="form-control" action="index.php" method="post">
					<div class="form-group">
						<label for="idUsuario">Usuário: </label>
						<input class="form-control" type="text" name="usuario" id="idUsuario" autocomplete="off">
					</div>

					<div class="form-group">
						<label for="idSenha">Senha: </label>
						<input class="form-control" type="password" name="senha" id="idSenha">
					</div>
					<button class="btn btn-primary" type="submit">Entrar</button>

					<?php require_once("assets/classes/User.php");

					if ($_POST) {						
						$login = new User();
						$login->setData($_POST['usuario'], $_POST['senha']);
						$logar = $login->validarUsuario();

						if ($logar == false) {
							echo "
							<div class='alert alert-danger alert-dismissible fade show' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							Usuário ou senha inválido!
							</div>
							";	

							exit();						
						}						
					}
					?>
				</form>				
			</div>
		</div>
	</div>

</body>
</html>