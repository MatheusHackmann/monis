<?php 
session_start();

require_once("header.php") 
?>

<?php
if ($_POST) {
	require_once("../classes/Registros.php");
	$cadastroDeRequerimento = new Registros();

	$cadastroDeRequerimento->setTabela("frenterequerimentos");
	$cadastroDeRequerimento->setNmrRegistro($_POST['numero_requerimento']);
	$cadastroDeRequerimento->setAnoRegistro($_POST['ano_requerimento']);
	$registroExiste = $cadastroDeRequerimento->uploadPdf($_FILES['pdf']);
	$cadastradoSucesso = $cadastroDeRequerimento->novoCadastroRI($_POST['data_requerimento'], $_POST['data_recebida'], $_POST['assunto_requerimento'], $_POST['vereadores'], $_POST['secs'], $_POST['numero_protocolo'], $_POST['data_envio']);	
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
							if ($cadastradoSucesso != "1" && $cadastradoSucesso != "2" && $cadastradoSucesso != "3" ) {
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
				if (($_POST && $cadastradoSucesso == "1") || ($_POST && $cadastradoSucesso == "2") || ($_POST && $cadastradoSucesso == "3")) {
					echo "
					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-4'>
					<label for='id_numero_requerimento'>Nº Requerimento: </label>
					<input class='form-control' type='text' name='numero_requerimento' id='id_numero_requerimento' required autocomplete='off' placeholder='Apenas números' pattern='[0-9]+$' value='".$_POST['numero_requerimento']."'>
					</div>					
					<div class='form-group col-12 col-md-2 col-lg-1'>
					<label for='id_ano_requerimento'>&nbsp</label>
					<input class='form-control' type='text' name='ano_requerimento' id='id_ano_requerimento' required autocomplete='off' placeholder='Ano' pattern='[0-9]+$' value='".$_POST['ano_requerimento']."'>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_requerimento'>Data Requerimento:</label>
					<input class='form-control' type='date' name='data_requerimento' id='id_data_requerimento' required autocomplete='off' style='border: 1px solid red;'>
					</div>
					</div>
					";

					if ($cadastradoSucesso == "1") {
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_recebida'>Data Recebida: <br><strong>Data recebida não pode ser menor que a data do requerimento!</strong></label>
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

					echo"
					<div class='row'>
					<div class='form-group col-12 col-md-12 col-lg-12'>
					<label for=''>Assunto: </label>
					<textarea class='form-control' name='assunto_requerimento' id='id_assunto_requerimento' rows='5' required autocomplete='off' style='resize: none;'>".$_POST['assunto_requerimento']."</textarea>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-8 col-lg-6'>
					<label for=''>Vereadores: &nbsp&nbsp&nbsp<span style='color: #6A6A66;'><i><u>ADICIONE ';' (PONTO E VÍRGULA) AO FINAL DE CADA NOME</u></i></span></label>
					<textarea class='form-control' name='vereadores' id='id_vereadores' rows='2' required autocomplete='off' style='resize: none;'>".$_POST['vereadores']."</textarea>
					</div>	
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-8 col-lg-6'>
					<label for='idSecs'>Secretarias: </label>
					</div>
					</div>
					<div class='row'>
					<div class='col-12 col-md-8 col-lg-6 form-control' style='height: 150px; overflow: auto; border: 1px solid red;'>
					";


					$secretarias = array('Administração e Recursos Humanos', 'Cultura, Esportes e Lazer', 'Controle Interno E Transparência', 'Comunicação Social', 'Defesa, Proteção e Preservação do Meio Ambiente', 'Educação', 'Financas e Orçamento', 'Gabinete / Vice-Gabinete', 'Governo E Participação Cidadã', 'Habitação', 'Inclusão, Assistência e Desenvolvimento Social', 'Mobilidade Urbana E Rural', 'Obras', 'Planejamento E Gestão Estratégica', 'Procuradoria Geral do Município', 'Saúde', 'Segurança E Defesa Civil', 'Serviços Públicos', 'Trabalho, Emprego E Desenvolvimento Econômico');

					for ($i=0; $i < count($secretarias); $i++) { 
						echo "
						<input type='checkbox' name='secs[]' value='".$secretarias[$i]."' style='padding: 5px;' />
						".$secretarias[$i]."<br>
						";
					}

					echo "
					</div>	
					</div>
					";

					if ($cadastradoSucesso == "2") {
						echo "
						<div class='row'>
						<div class='form-group col-12 col-md-4 col-lg-3'>
						<label for='id_data_envio'>Data De Envio: <br><strong>Data de envio não pode ser menor que a data do requerimento!</strong></label>
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

					echo "
					<div class='form-group col-12 col-md-4 col-lg-2'>
					<label for=''>Nº Protocolo Geral: </label>
					<input class='form-control' type='text' name='numero_protocolo' id='id_numero_protocolo' required autocomplete='off' pattern='[0-9]+$' value='".$_POST['numero_protocolo']."'>
					</div>

					<div class='form-group col-12 col-md-4 col-lg-7' >
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
					<label for='id_numero_requerimento'>Nº Requerimento: </label>
					<input class='form-control' type='text' name='numero_requerimento' id='id_numero_requerimento' required autocomplete='off' placeholder='Apenas números' pattern='[0-9]+$'>
					</div>					
					<div class='form-group col-12 col-md-2 col-lg-1'>
					<label for='id_ano_requerimento'>&nbsp</label>
					<input class='form-control' type='text' name='ano_requerimento' id='id_ano_requerimento' required autocomplete='off' placeholder='Ano' pattern='[0-9]+$'>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_requerimento'>Data Requerimento: </label>
					<input class='form-control' type='date' name='data_requerimento' id='id_data_requerimento' required autocomplete='off'>
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
					<textarea class='form-control' name='assunto_requerimento' id='id_assunto_requerimento' rows='5' required autocomplete='off' style='resize: none;'></textarea>
					</div>
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-8 col-lg-6'>
					<label for=''>Vereadores: &nbsp&nbsp&nbsp<span style='color: #6A6A66;'><i><u>ADICIONE ';' (PONTO E VÍRGULA) AO FINAL DE CADA NOME</u></i></span></label>
					<textarea class='form-control' name='vereadores' id='id_vereadores' rows='2' required autocomplete='off' style='resize: none;'></textarea>
					</div>	
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-8 col-lg-6'>
					<label for='idSecs'>Secretarias: </label>
					</div>
					</div>
					<div class='row'>
					<div class='col-12 col-md-8 col-lg-6 form-control' style='height: 150px; overflow: auto; border:'>
					";

					$secretarias = array('Administração e Recursos Humanos', 'Cultura, Esportes e Lazer', 'Controle Interno E Transparência', 'Comunicação Social', 'Defesa, Proteção e Preservação do Meio Ambiente', 'Educação', 'Financas e Orçamento', 'Gabinete / Vice-Gabinete', 'Governo E Participação Cidadã', 'Habitação', 'Inclusão, Assistência e Desenvolvimento Social', 'Mobilidade Urbana E Rural', 'Obras', 'Planejamento E Gestão Estratégica', 'Procuradoria Geral do Município', 'Saúde', 'Segurança E Defesa Civil', 'Serviços Públicos', 'Trabalho, Emprego E Desenvolvimento Econômico');

					for ($i=0; $i < count($secretarias); $i++) { 
						echo "
						<input type='checkbox' name='secs[]' value='".$secretarias[$i]."' style='padding: 5px;' />
						".$secretarias[$i]."<br>
						";
					}

					echo "							
					</div>	
					</div>

					<div class='row'>
					<div class='form-group col-12 col-md-4 col-lg-3'>
					<label for='id_data_envio'>Data De Envio: </label>
					<input class='form-control' type='date' name='data_envio' id='id_data_envio' required autocomplete='off'>
					</div>						

					<div class='form-group col-12 col-md-4 col-lg-2'>
					<label for=''>Nº Protocolo Geral: </label>
					<input class='form-control' type='text' name='numero_protocolo' id='id_numero_protocolo' required autocomplete='off' pattern='[0-9]+$'>
					</div>

					<div class='form-group col-12 col-md-4 col-lg-7'>
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