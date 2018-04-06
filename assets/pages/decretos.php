<?php require_once("header.php"); ?>
<?php 

require_once("../classes/Registros.php");

if ($_POST) {
	$cadastroDeDecreto = new Registros();

	$cadastroDeDecreto->setTabela("decretos");
	$cadastroDeDecreto->setNmrRegistro($_POST['numero_decreto']);
	$cadastroDeDecreto->setAnoRegistro($_POST['ano_decreto']);
	$registroExiste = $cadastroDeDecreto->cadImagem($_FILES['imagem']);
	$cadastradoSucesso = $cadastroDeDecreto->novoCadastroLPD($_POST['data_decreto'], $_POST['assunto_decreto'], $_POST['numero_protocolo']);
}
?>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10 py-5">
			<form method="post" class="form-registros" enctype="multipart/form-data">
				<div class="row">
					<div class="col-12">
						<?php
						if ($_POST) {
							if ($cadastradoSucesso != "") {
								echo "
								<div class='alert alert-success alert-dismissible fade show' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								$cadastradoSucesso
								</div>
								";
							}else if ($registroExiste != "") {
								echo "
								<div class='alert alert-danger alert-dismissible fade show' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								$registroExiste
								</div>
								";
							}
						}
						?>
					</div>	
				</div>			
				
				<div class="row">
					<div class="form-group col-2">
						<label for="id_numero_decreto">Nº decreto: </label>
						<input class="form-control" type="text" name="numero_decreto" id="id_numero_decreto" required autocomplete="off" placeholder="Apenas números" pattern="[0-9]+$">
					</div>					
					<div class="form-group col-1">
						<label for="id_ano_decreto">&nbsp</label>
						<input class="form-control" type="text" name="ano_decreto" id="id_ano_decreto" required autocomplete="off" placeholder="Ano" pattern="[0-9]+$">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-2">
						<label for="id_data_decreto">Data: </label>
						<input class="form-control" type="date" name="data_decreto" id="id_data_decreto" required autocomplete="off">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-12">
						<label for="">Assunto: </label>
						<textarea class="form-control" name="assunto_decreto" id="id_assunto_decreto" rows="5" required autocomplete="off" style="resize: none;"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-2">
						<label for="">Nº Protocolo: </label>
						<input class="form-control" type="text" name="numero_protocolo" id="id_numero_protocolo" required autocomplete="off">
					</div>
					<div class="offset-4 col-6">
						<label>Anexar Imagem</label>
						<input class="form-control" type="file" name="imagem[]" multiple required> <!-- MULTIPLE -->
					</div>
				</div>
				

				<div class="row">
					<div class="col-1">
						<div class="dropdown-divider"></div>
						<button class="btn btn-success" type="submit">Cadastrar</button>
					</div>
				</div>


			</form>
		</div>
		<div class="col-1"></div>
	</div>
</div>

<?php require_once("footer.php"); ?>