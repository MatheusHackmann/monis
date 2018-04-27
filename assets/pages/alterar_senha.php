<?php require_once("header.php"); ?>
<?php 

require_once("../classes/User.php");

if ($_POST) {
	$novaSenha = new User();

	$alteracao = $novaSenha->alterarSenha($_GET['id'], $_POST['nova_senha'], $_POST['confirmar_senha']);
}
?>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="offset-md-4 col-12 col-md-4 col-lg-4 py-5">
			<form class="form-registros" method="post">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<?php
						if (($_POST) && ($alteracao) === "2") {
							echo "
							<div class='alert alert-success alert-dismissible fade show' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							Senha alterada com sucesso.
							</div>
							";
						}
						?>
					</div>
				</div>

				<?php
				if (($_POST) && ($alteracao) === "1") {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_nova_senha'>Nova Senha: </label>
					<input class='form-control' type='password' name='nova_senha' id='id_nova_senha' required value='".$_POST['nova_senha']."'>
					</div>					
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_confirmar_senha'>Confirmar Senha: </label>
					<input class='form-control' type='password' name='confirmar_senha' id='id_confirmar_senha' required placeholder='As senhas devem ser iguais' style='border: 1px solid red;'>
					</div>					
					</div>
					";
				} else {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_nova_senha'>Nova Senha: </label>
					<input class='form-control' type='password' name='nova_senha' id='id_nova_senha' required>
					</div>					
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for='id_confirmar_senha'>Confirmar Senha: </label>
					<input class='form-control' type='password' name='confirmar_senha' id='id_confirmar_senha' required>
					</div>					
					</div>
					";					
				}
				?>

				<div class="row">
					<div class="col-6 col-md-1 col-lg-1">
						<button class="btn btn-success" type="submit">Alterar</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<?php require_once("footer.php"); ?>