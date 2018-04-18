<?php require_once("header.php") ?>

<?php

require_once("../classes/User.php");

if ($_POST) {
	$cadUsuario = new User();
	$cadastrado = $cadUsuario->cadastrarUsuario($_POST['acesso'], $_POST['usuario'], $_POST['senha'], $_POST['confirmar_senha']);
}
?>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="col-2" style="height: 93vh;background-color: #fff">
			<button class="btn btn-primary col-12" style="margin-top: 20px;">Cadastrar Usuários</button>
			<button class="btn btn-primary col-12" style="margin-top: 20px;">Gerenciar Usuários</button>
		</div>

		<div class="offset-md-2 col-6">
			<form class="form-registros" enctype="multipart/form-data" method="post">

				<?php

				if (($_POST) && ($cadastrado == "1")) {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_usuario'>Nome de usuário: </label>
					<input class='form-control' type='text' name='usuario' id='id_usuario' value='".$_POST['usuario']."'>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_senha'>Senha: </label>
					<input class='form-control' type='password' name='senha' id='id_senha' value='".$_POST['senha']."'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_confirmar_senha'>Confirmar Senha: </label>
					<input class='form-control' type='password' name='confirmar_senha' id='id_confirmar_senha' placeholder='As senhas não correspondem' style='border: 1px solid red;'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_acesso'>Tipo de acesso:</label>
					<select class='form-control' name='acesso' id='id_acesso'>
					<option value='1'>Administrador</option>
					<option value='0'>Editor</option>
					</select>
					</div>
					</div>
					";						
				}
				else{
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_usuario'>Nome de usuário: </label>
					<input class='form-control' type='text' name='usuario' id='id_usuario'>
					</div>		
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_senha'>Senha: </label>
					<input class='form-control' type='password' name='senha' id='id_senha'>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_confirmar_senha'>Confirmar Senha: </label>
					<input class='form-control' type='password' name='confirmar_senha' id='id_confirmar_senha'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_acesso'>Tipo de acesso:</label>
					<select class='form-control' name='acesso' id='id_acesso'>
					<option value='1'>Administrador</option>
					<option value='0'>Editor</option>
					</select>
					</div>
					</div>					
					";
				}
				?>

				<div class="row">
					<div class="col-1">
						<button class="btn btn-success" type="submit">Cadastrar Usuário</button>
					</div>
				</div>										

			</form>
		</div>

	</div>
</div>

<?php require_once("footer.php") ?>