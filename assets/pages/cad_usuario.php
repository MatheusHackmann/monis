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
		<div class="offset-md-3 col-12 col-md-6 col-lg-6">
			<form class="form-registros" enctype="multipart/form-data" method="post">

				<?php 

				if(($_POST) && ($cadastrado != "1") && ($cadastrado != "2") && ($cadastrado != "3")) {
					echo "
					<div class='col-12 col-md-12 col-lg-12'>
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>	
					$cadastrado	
					</div>
					</div>						
					";
				} 

				?>				

				<?php

				if (($_POST) && ($cadastrado == "1")) {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_usuario'>Nome de usuário: </label>
					<input class='form-control' type='text' name='usuario' id='id_usuario' value='".$_POST['usuario']."' autocomplete='none'>
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
					<option>SELECIONE UMA OPÇÃO</option>
					<option value='1'>Administrador</option>
					<option value='0'>Editor</option>
					</select>
					</div>
					</div>
					";						
				}

				else if (($_POST) && ($cadastrado == "2")) {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_usuario'>Nome de usuário: </label>
					<input class='form-control' type='text' name='usuario' id='id_usuario' value='".$_POST['usuario']."' autocomplete='none'>
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
					<input class='form-control' type='password' name='confirmar_senha' id='id_confirmar_senha' value='".$_POST['confirmar_senha']."'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_acesso'>Tipo de acesso:</label>
					<select class='form-control' name='acesso' id='id_acesso' style='border:1px solid red;'>
					<option>SELECIONE UMA OPÇÃO</option>
					<option value='1'>Administrador</option>
					<option value='0'>Editor</option>
					</select>
					</div>
					</div>
					";						
				}

				else if (($_POST) && ($cadastrado == "3")) {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_usuario'>Nome de usuário: </label>
					<input class='form-control' type='text' name='usuario' id='id_usuario' placeholder='Esse nome de usuário já está em uso!' autocomplete='none' style='border:1px solid red;'>
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
					<input class='form-control' type='password' name='confirmar_senha' id='id_confirmar_senha' value='".$_POST['confirmar_senha']."'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_acesso'>Tipo de acesso:</label>
					<select class='form-control' name='acesso' id='id_acesso'>
					<option>SELECIONE UMA OPÇÃO</option>
					<option value='1'>Administrador</option>
					<option value='0'>Editor</option>
					</select>
					</div>
					</div>
					";						
				}

				else
				{
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_usuario'>Nome de usuário: </label>
					<input class='form-control' type='text' name='usuario' id='id_usuario' autocomplete='none'>
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
					<option>SELECIONE UMA OPÇÃO</option>
					<option value='1'>Administrador</option>
					<option value='0'>Editor</option>
					</select>
					</div>
					</div>	

					";
				}
				?>

				<div class="row">

					<div class="col-12 col-md-12 col-lg-12">
						<button class="btn btn-success" type="submit">Cadastrar Usuário</button>
					</div>

				</div>										

			</form>
		</div>

	</div>
</div>

<?php require_once("footer.php") ?>