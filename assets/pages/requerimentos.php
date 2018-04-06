<?php require_once("header.php"); ?>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10 py-5">
			<form class="form-registros" enctype="multipart/form-data" method="post">
				<div class="row">
					<div class="col-12">
						<?php
						if ($_POST) {
							require_once("../classes/Registros.php");
							$cadastroDeRequerimento = new Registros();

							$cadastroDeRequerimento->setTabela("requerimentos");
							$cadastroDeRequerimento->setNmrRegistro($_POST['numero_requerimento']);
							$cadastroDeRequerimento->setAnoRegistro($_POST['ano_requerimento']);
							$registroExiste = $cadastroDeRequerimento->cadImagem($_FILES['imagem']);
							$cadastradoSucesso = $cadastroDeRequerimento->novoCadastroRI($_POST['data_requerimento'], $_POST['data_recebida'], $_POST['assunto_requerimento'], $_POST['vereadores'], $_POST['secs'], $_POST['numero_protocolo'], $_POST['data_envio']);		


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
						<label for="id_numero_requerimento">Nº Requerimento: </label>
						<input class="form-control" type="text" name="numero_requerimento" id="id_numero_requerimento" required autocomplete="off" placeholder="Apenas números" pattern="[0-9]+$">
					</div>					
					<div class="form-group col-1">
						<label for="id_ano_requerimento">&nbsp</label>
						<input class="form-control" type="text" name="ano_requerimento" id="id_ano_requerimento" required autocomplete="off" placeholder="Ano" pattern="[0-9]+$">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-2">
						<label for="id_data_requerimento">Data Requerimento: </label>
						<input class="form-control" type="date" name="data_requerimento" id="id_data_requerimento" required autocomplete="off">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-2">
						<label for="id_data_recebida">Data Recebida: </label>
						<input class="form-control" type="date" name="data_recebida" id="id_data_recebida" required autocomplete="off">
					</div>	
				</div>	

				<div class="row">
					<div class="form-group col-12">
						<label for="">Assunto: </label>
						<textarea class="form-control" name="assunto_requerimento" id="id_assunto_requerimento" rows="5" required autocomplete="off" style="resize: none;"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-6">
						<label for="">Vereadores: &nbsp&nbsp&nbsp<span style="color: #6A6A66;"><i><u>ADICIONE ";" (PONTO E VÍRGULA) AO FINAL DE CADA NOME</u></i></span></label>
						<textarea class="form-control" name="vereadores" id="id_vereadores" rows="2" required autocomplete="off" style="resize: none;"></textarea>
					</div>	
				</div>

				<div class="row">
					<div class="form-group col-12">
						<label for="idSecs">Secretarias: </label>
					</div>

					<div class="form-group col-12">
						<select multiple="multiple" name="secs[]" id="idSecs" size="6" required>
							<?php

							$secretarias = array('Administração e Recursos Humanos', 'Cultura, Esportes e Lazer', 'Controle Interno E Transparência', 'Comunicação Social', 'Defesa, Proteção e Preservação do Meio Ambiente', 'Educação', 'Financas e Orçamento', 'Gabinete / Vice-Gabinete', 'Governo E Participação Cidadã', 'Habitação', 'Inclusão, Assistência e Desenvolvimento Social', 'Mobilidade Urbana E Rural', 'Obras', 'Planejamento E Gestão Estratégica', 'Procuradoria Geral do Município', 'Saúde', 'Segurança E Defesa Civil', 'Serviços Públicos', 'Trabalho, Emprego E Desenvolvimento Econômico');

							for ($i=0; $i < count($secretarias); $i++) { 
								echo "

								<option value='".$secretarias[$i]."' style='padding: 5px;'>
								".$secretarias[$i]."
								</option>
								";
							}

							?>							
						</select>
					</div>	
				</div>

				<div class="row">
					<div class="form-group col-2">
						<label for="id_data_envio">Data De Envio: </label>
						<input class="form-control" type="date" name="data_envio" id="id_data_envio" required autocomplete="off">
					</div>						

					<div class="col-2">
						<label for="">Nº Protocolo Geral: </label>
						<input class="form-control" type="text" name="numero_protocolo" id="id_numero_protocolo" required autocomplete="off">
					</div>
					
					<div class="offset-2 col-6">
						<label>Anexar Imagem</label>
						<input class="form-control" type="file" name="imagem[]" multiple required> <!-- MULTIPLE -->
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="dropdown-divider"></div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-1">
						<button class="btn btn-success" type="submit">Cadastrar</button>
					</div>
				</div>

			</form>
		</div>
		<div class="col-1"></div>
	</div>
</div>

<?php require_once("footer.php"); ?>