<?php require_once("header.php") ?>

<style type="text/css">

.img-registros{
	height: 70vh; 
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
	height: 60vh; 
	overflow: auto;
}
</style>

<div class="container-fluid bg-fundo">
	<div class="row">
		
		<?php echo "
		<div class='offset-2 col-2'>
		<form action='buscar_".$_GET['nomeTabela'].".php' method='post' class='py-4'>
		<input class='form-control' type='text' name='buscar".$_GET['buscar']."' placeholder='Buscar Registro' autocomplete='off' pattern='[0-9]+$'>

		<div class='dropdown-divider'></div>
		<button class='btn btn-primary'>Buscar</button>
		</form>
		</div>
		"; ?>
	</div>



	<div class="row">
		<div class="offset-2 col-8 py-2">

			<?php 
			require_once("../classes/Registros.php");

			$buscarRegistro = new Registros();
			$buscarRegistro->setTabela($_GET['nomeTabela']);
			$buscarRegistro->setNmrRegistro($_GET['nmrRegistro']);
			$buscarRegistro->setAnoRegistro($_GET['anoRegistro']);
			$registro = $buscarRegistro->buscarRegistros(); 

			$imagem = explode(";", $registro['imagem']);

			echo "
			<div class='col-12 bg-registros'>";

			echo "
			<p><strong>Nº DE REGISTRO</strong>: ".$registro['numero_registro']."/".$registro['ano_registro']."</p>
			<p><strong>DATA</strong>: ".date("d/m/Y", strtotime($registro['data_registro']))."</p>
			<p><strong>ASSUNTO</strong>: ".utf8_encode($registro['assunto'])."</p>
			<p><strong>PROTOCOLO</strong>: ".$registro['numero_protocolo']."</p>";

			echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLong'>
			Ver Documentos
			</button>

			<!-- Modal -->
			<div class='modal fade' id='exampleModalLong' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
			<div class='modal-dialog' role='document'>
			<div class='modal-content'>
			<div class='modal-body' style='text-align: center;'>
			";

			for ($i=0; $i < count($imagem); $i++) { 

				echo "
				<a href='../images/".$_GET['nomeTabela']."/".$registro['numero_registro'].$registro['ano_registro']."/".$imagem[$i]."' target='_blank'><img src='../images/".$_GET['nomeTabela']."/".$registro['numero_registro'].$registro['ano_registro']."/".$imagem[$i]."'
				class='img-fluid img-registros'>
				</a>
				";

			}

			echo "
			</div>
			</div>
			</div>
			</div>";

				//Deletar Registro
			echo "<button class='btn btn-danger' onclick=\"confirmDelete('".$_GET['nomeTabela']."','".$_GET['nmrRegistro']."','".$_GET['anoRegistro']."')\">Deletar Registro</button>";					

			?>	
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