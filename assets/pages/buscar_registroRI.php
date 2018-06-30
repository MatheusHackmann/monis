<?php 
session_start();

require_once("header.php") 
?>

<style type="text/css">

.img-registros{
	height: 20vh; 
	border: 1px solid #000; 
	border-radius:5px;
	margin-top: 3px;
}

.bg-registros {
	border: 1px solid #000; 
	padding: 10px;
	border-radius: 5px;
	text-align: justify; 
	background-color: #fff;
}
</style>

<div class="container-fluid bg-fundo">
	<div class="row">
		
		<?php echo "
		<div class='offset-md-2 col-12 col-md-2 col-lg-2'>
		<form action='buscar_".$_GET['nomeTabela'].".php' method='post' class='py-4'>
		<input class='form-control' type='text' name='buscar".$_GET['buscar']."' placeholder='Buscar Registro' autocomplete='off' pattern='[0-9]+$'>

		<div class='dropdown-divider'></div>
		<button class='btn btn-primary'>Buscar</button>
		</form>
		</div>
		"; ?>
	</div>

	<div class="row">
		<div class="offset-md-2 col-12 col-md-8 col-lg-8 py-2">

			<?php 
			require_once("../classes/Registros.php");

			$buscarRegistro = new Registros();
			$buscarRegistro->setTabela($_GET['nomeTabela']);
			$buscarRegistro->setNmrRegistro($_GET['nmrRegistro']);
			$buscarRegistro->setAnoRegistro($_GET['anoRegistro']);
			$registro = $buscarRegistro->buscarRegistros();

			$pdf = explode(";", $registro['pdf']);
			$vereadores = explode(";", $registro['vereadores']);
			$secretarias = explode(";", $registro['secretarias']);

			echo "<div class='col-12 bg-registros'>";

			echo "
			<p><strong>Nº DE REGISTRO</strong>: ".$registro['numero_registro']."/".$registro['ano_registro']."</p>
			<p><strong>DATA DO REGISTRO</strong>: ".date("d/m/Y", strtotime($registro['data_registro']))."</p>
			<p><strong>DATA RECEBIDA</strong>: ".date("d/m/Y", strtotime($registro['data_recebida']))."</p>
			<p><strong>ASSUNTO</strong>: ".utf8_encode($registro['assunto'])."</p>";

			echo "<p><strong>VEREADORES</strong>: ";
			for ($i=0; $i < count($vereadores); $i++) { 
				echo "<br>".utf8_encode($vereadores[$i]);
			}
			echo "</p>";

			echo "<p><strong>SECRETARIAS</strong>: ";
			for ($i=0; $i < count($secretarias); $i++) { 
				echo "<br>".utf8_encode($secretarias[$i]);
			}						
			echo "</p>";

			echo "<p><strong>PROTOCOLO</strong>: ".$registro['numero_protocolo']."</p>

			<p><strong>DATA ENVIADA</strong>: ".date("d/m/Y", strtotime($registro['data_envio']))."</p>
			";
			?>

			<div class="row">
				<div class="col-12">
					<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLong'>
						Ver Documentos
					</button>

					<!-- Modal -->
					<div class='modal fade' id='exampleModalLong' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
						<div class='modal-dialog' role='document'>
							<div class='modal-content'>
								<div class='modal-body' style='text-align: center;'>

									<?php
									for ($i=0; $i < count($pdf); $i++) { 

										echo "
										<a href='../arquivos/".$_GET['nomeTabela']."/".$registro['numero_registro'].$registro['ano_registro']."/".$pdf[$i]."' target='_blank'><img src='../icons/pdf.png' class='img-fluid img-registros'>
										</a>
										";
									}
									?>

								</div>
							</div>
						</div>
					</div>			

					<?php
					if ($_SESSION['pmsUsPerm'] == "FRENTE_ADM") {
						//Deletar Registro
						echo "<button class='btn btn-danger' onclick=\"confirmDelete('".$_GET['nomeTabela']."','".$_GET['nmrRegistro']."','".$_GET['anoRegistro']."')\">Deletar Registro</button>";					
					}	
					?>					
				</div>
			</div>			

		</div>
	</div>
</div>


<script type="text/javascript">
	function confirmDelete(nomeTabela, nmrRegistro, anoRegistro) {
		var deletar = confirm("Excluir Registro ?");

		if (deletar) {
			location.href = 'excluir_registro.php?nome_tabela='+nomeTabela+'&nmr_registro='+nmrRegistro+'&ano_registro='+anoRegistro;
		}
		else {

		}
	}
</script>

<?php require_once("footer.php") ?>