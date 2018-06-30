<?php 
session_start();

require_once("header.php") 
?>

<?php
if ($_POST) {
	require_once("../classes/Registros.php");
	$cadastroDeOficio = new Registros();

	$cadastroDeOficio->setTabela("frenteoficios");
	$cadastroDeOficio->setNmrRegistro($_POST['numero_oficio']);
	$cadastroDeOficio->setAnoRegistro($_POST['ano_oficio']);
	$registroExiste = $cadastroDeOficio->uploadPdf($_FILES['pdf']);
	$cadastradoSucesso = $cadastroDeOficio->novoCadastroOficio($_POST['data_oficio'], $_POST['data_recebida'], $_POST['assunto_oficio'], $_POST['origem'], $_POST['destino'], $_POST['data_envio'], $_POST['data_responder']);	
}
?>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-sm-12 col-md-10 col-lg-10 py-5">
			<form class="form-registros" enctype="multipart/form-data" method="post">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<?php
						if ($_POST) {		
							if ($cadastradoSucesso != "1" && $cadastradoSucesso != "2" && $cadastradoSucesso != "3" && $cadastradoSucesso != "4") {
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

				<?php 
				if (($_POST && $cadastradoSucesso == "1") || ($_POST && $cadastradoSucesso == "2") || ($_POST && $cadastradoSucesso == "3") || ($_POST && $cadastradoSucesso == "4")) {

					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-4'>
					<label for='id_numero_oficio'>Ofício - SMGPC Nº </label>
					<input class='form-control' type='text' name='numero_oficio' id='id_numero_oficio' required autocomplete='off' placeholder='Apenas números' pattern='[0-9]+$' value='".$_POST['numero_oficio']."'>
					</div>					
					<div class='form-group col-12 col-md-2 col-lg-1'>
					<label for='id_ano_oficio'>&nbsp</label>
					<input class='form-control' type='text' name='ano_oficio' id='id_ano_oficio' required autocomplete='off' placeholder='Ano' pattern='[0-9]+$' value='".$_POST['ano_oficio']."'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_oficio'>Data do Ofício: </label>
					<input class='form-control' type='date' name='data_oficio' id='id_data_oficio' required autocomplete='off' style='border: 1px solid red;'>
					</div>
					</div>
					";
					if ($cadastradoSucesso == "1") {
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_recebida'>Data Recebida: <br><strong>Data recebida não pode ser menor que a data do ofício!</strong></label>
						<input class='form-control' type='date' name='data_recebida' id='id_data_recebida' required autocomplete='off' style='border: 1px solid red;'>
						</div>	
						</div>
						";
					}else{
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_recebida'>Data Recebida: </label>
						<input class='form-control' type='date' name='data_recebida' id='id_data_recebida' required autocomplete='off' style='border: 1px solid red;'>
						</div>	
						</div>
						";
					}					

					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for=''>Assunto: </label>
					<textarea class='form-control' name='assunto_oficio' id='id_assunto_oficio' rows='5' required autocomplete='off' style='resize: none;'>".$_POST['assunto_oficio']."</textarea>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-6 col-lg-6'>
					<label for='id_origem'>Origem: </label>
					<input class='form-control' type='text' name='origem' id='id_origem' required autocomplete='off' value='".$_POST['origem']."'>
					</div>	


					<div class='form-group col-12 col-md-6 col-lg-6'>
					<label for='id_destino'>Destino: </label>
					<input class='form-control' type='text' name='destino' id='id_destino' required autocomplete='off' value='".$_POST['destino']."'>
					</div>
					</div>	
					";			

					if ($cadastradoSucesso == "2") {
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_envio'>Data De Envio: <br><strong>Data de envio não pode ser menor que a data do ofício!</strong></label>
						<input class='form-control' type='date' name='data_envio' id='id_data_envio' required autocomplete='off' style='border: 1px solid red;'>
						</div>
						";	
					}
					else if ($cadastradoSucesso == "3"){
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_envio'>Data De Envio: <br><strong>Data de envio não pode ser menor que a data recebida!</strong></label>
						<input class='form-control' type='date' name='data_envio' id='id_data_envio' required autocomplete='off' style='border: 1px solid red;'>
						</div>
						";	
					}
					else {
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_envio'>Data De Envio: </label>
						<input class='form-control' type='date' name='data_envio' id='id_data_envio' required autocomplete='off' style='border: 1px solid red;'>
						</div>
						";						
					}	

					if ($cadastradoSucesso == "4") {					

						echo "
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_responder'>Responder Até: <br><strong>Data de resposta não pode ser menor que a data recebida!</strong></label>
						<input class='form-control' type='date' name='data_responder' id='id_data_responder' required autocomplete='off' style='border: 1px solid red;'>
						</div>	
						";
					}else {
						echo "
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_responder'>Responder Até: </label>
						<input class='form-control' type='date' name='data_responder' id='id_data_responder' required autocomplete='off' style='border: 1px solid red;'>
						</div>	
						";						
					}

					echo "
					<div class='col-12 col-md-4 col-lg-6'>
					<label>Anexar PDF</label>
					<input class='form-control' type='file' name='pdf[]'  accept='.pdf' multiple required style='border: 1px solid red;'>
					</div>
					</div>
					";
					

				}
				else {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-4'>
					<label for='id_numero_oficio'>Ofício - SMGPC Nº </label>
					<input class='form-control' type='text' name='numero_oficio' id='id_numero_oficio' required autocomplete='off' placeholder='Apenas números' pattern='[0-9]+$'>
					</div>					
					<div class='form-group col-12 col-md-2 col-lg-1'>
					<label for='id_ano_oficio'>&nbsp</label>
					<input class='form-control' type='text' name='ano_oficio' id='id_ano_oficio' required autocomplete='off' placeholder='Ano' pattern='[0-9]+$'>
					</div>
					</div>	

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_oficio'>Data do Ofício: </label>
					<input class='form-control' type='date' name='data_oficio' id='id_data_oficio' required autocomplete='off'>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_recebida'>Data Recebida: </label>
					<input class='form-control' type='date' name='data_recebida' id='id_data_recebida' required autocomplete='off'>
					</div>	
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for=''>Assunto: </label>
					<textarea class='form-control' name='assunto_oficio' id='id_assunto_oficio' rows='5' required autocomplete='off' style='resize: none;'></textarea>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-6 col-lg-6'>
					<label for='id_origem'>Origem: </label>
					<input class='form-control' type='text' name='origem' id='id_origem' required autocomplete='off'>
					</div>	


					<div class='form-group col-12 col-md-6 col-lg-6'>
					<label for='id_destino'>Destino: </label>
					<input class='form-control' type='text' name='destino' id='id_destino' required autocomplete='off'>
					</div>
					</div>				

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_envio'>Data De Envio: </label>
					<input class='form-control' type='date' name='data_envio' id='id_data_envio' required autocomplete='off'>
					</div>	

					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_responder'>Responder Até: </label>
					<input class='form-control' type='date' name='data_responder' id='id_data_responder' required autocomplete='off'>
					</div>	

					<div class='col-12 col-md-4 col-lg-6'>
					<label>Anexar PDF</label>
					<input class='form-control' type='file' name='pdf[]'  accept='.pdf' multiple required>
					</div>
					</div>
					";
				}
				?>				


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