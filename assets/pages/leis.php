<?php require_once("header.php"); ?>
<?php 

require_once("../classes/Registros.php");

if ($_POST) {
	$cadastroDeLei = new Registros();

	$cadastroDeLei->setTabela("leis");
	$cadastroDeLei->setNmrRegistro($_POST['numero_lei']);
	$cadastroDeLei->setAnoRegistro($_POST['ano_lei']);
	$registroExiste = $cadastroDeLei->cadImagem($_FILES['imagem']);
	$cadastradoSucesso = $cadastroDeLei->novoCadastroLPD($_POST['data_lei'], $_POST['assunto_lei'], $_POST['numero_protocolo']);
}
?>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="col-12 col-md-1 col-lg-1"></div>
		<div class="col-12 col-md-10 col-lg-10 py-5">
			<form class="form-registros" enctype="multipart/form-data" method="post">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
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
					<div class="form-group col-12 col-md-4 col-lg-4">
						<label for="id_numero_lei">Nº Lei: </label>
						<input class="form-control" type="text" name="numero_lei" id="id_numero_lei" required autocomplete="off" placeholder="Apenas números" pattern="[0-9]+$">
					</div>					
					<div class="form-group col-12 col-md-2 col-lg-1">
						<label for="id_ano_lei">&nbsp</label>
						<input class="form-control" type="text" name="ano_lei" id="id_ano_lei" required autocomplete="off" placeholder="Ano" pattern="[0-9]+$">
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-12 col-md-4 col-lg-2">
						<label for="id_data_lei">Data: </label>
						<input class="form-control" type="date" name="data_lei" id="id_data_lei" required autocomplete="off">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-12 col-md-12 col-lg-12">
						<label for="">Assunto: </label>
						<textarea class="form-control" name="assunto_lei" id="id_assunto_lei" rows="5" required autocomplete="off" style="resize: none;"></textarea>
					</div>
				</div>

				
				<div class="row">
					<div class="col-12 col-md-4 col-lg-2">
						<label for="">Nº Protocolo: </label>
						<input class="form-control" type="text" name="numero_protocolo" id="id_numero_protocolo" required autocomplete="off" pattern="[0-9]+$">
					</div>
					<div class="offset-md-2 col-12 col-md-6 col-lg-6">
						<label>Anexar Imagem</label>
						<input class="form-control" type="file" name="imagem[]"  accept="image/*" multiple required> <!-- MULTIPLE -->
					</div>
				</div>
				

				<div class="row">
					<div class="col-6 col-md-1 col-lg-1">
						<div class="dropdown-divider"></div>
						<button class="btn btn-success" type="submit">Cadastrar</button>
					</div>
				</div>

			</form>
		</div>
		<div class="col-sm-12 col-md-1 col-lg-1"></div>
	</div>
</div>

<?php require_once("footer.php"); ?>