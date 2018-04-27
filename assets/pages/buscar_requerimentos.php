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
		<div class="offset-md-2 col-12 col-md-2 col-lg-2">
			<form action="buscar_requerimentos.php" method="post" class="py-4">
				<input class="form-control" type="text" name="buscarRequerimento" placeholder="Buscar Requerimentos" autocomplete="off" pattern="[0-9]+$">
					
				<div class="dropdown-divider"></div>
				<button class="btn btn-primary">Buscar</button>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="offset-md-2 col-12 col-md-8 col-lg-8 py-2">

			<?php 
			require_once("../classes/Registros.php");

			if ($_POST && $_POST['buscarRequerimento'] === "") {
				$todosOsRequerimentos = new Registros();
				$todosOsRequerimentos->setTabela("requerimentos");
				$registro = $todosOsRequerimentos->buscarTodosRegistros();	

				if ($registro === true) {
					echo "
					<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					Não há nenhum registro cadastrado!
					</div>
					";					
				}
				else{
					$suffix = "...";

					echo "<div class='col-12 bg-registros'>";			

					echo "
					<table class='table table-striped' style='text-align: center;'>

					<tr>
					<th>Nº Registro</th>
					<th>Data Registro</th>
					<th>Assunto</th>
					<th>Nº Protocolo</th>
					</tr>	
					";

					for ($i=0; $i < count($registro); $i++) { 
						$assunto = substr($registro[$i]['assunto'], 0, 150 + 1) . $suffix;
						$data = date("d/m/Y", strtotime($registro[$i]['data_registro']));

						$nmrRegistro = $registro[$i]['numero_registro'];
						$anoRegistro = $registro[$i]['ano_registro'];						

						echo "
						<tr>
						<td>"."<a href='buscar_registroRI.php?buscar=Requerimento&nomeTabela=requerimentos&nmrRegistro=$nmrRegistro&anoRegistro=$anoRegistro'>".$nmrRegistro."/".$anoRegistro."</a></td>
						<td>".$data."</td>	
						<td>".$assunto."</td>
						<td>".$registro[$i]['numero_protocolo']."</td>
						</tr>
						";
						
					}	
					echo "
					</table>
					</div>";				
				}					
			}
			else if ($_POST && $_POST['buscarRequerimento'] != "") {
				$buscarRequerimento = new Registros();
				$buscarRequerimento->setTabela("requerimentos");
				$buscarRequerimento->setNmrRegistro($_POST['buscarRequerimento']);
				$registro = $buscarRequerimento->buscarRegistro(); 

				if ($registro === true) {
					echo "
					<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					Não há nenhum registro com esse número cadastrado!
					</div>
					";					
				}
				else{
					$suffix = "...";

					echo "<div class='col-12 bg-registros'>";			

					echo "
					<table class='table table-striped' style='text-align: center;'>

					<tr>
					<th>Nº Registro</th>
					<th>Data Registro</th>
					<th>Assunto</th>
					<th>Nº Protocolo</th>
					</tr>	
					";

					for ($i=0; $i < count($registro); $i++) { 
						$assunto = substr($registro[$i]['assunto'], 0, 150 + 1) . $suffix;
						$data = date("d/m/Y", strtotime($registro[$i]['data_registro']));

						$nmrRegistro = $registro[$i]['numero_registro'];
						$anoRegistro = $registro[$i]['ano_registro'];						

						echo "
						<tr>
						<td>"."<a href='buscar_registroRI.php?buscar=Requerimento&nomeTabela=requerimentos&nmrRegistro=$nmrRegistro&anoRegistro=$anoRegistro'>".$nmrRegistro."/".$anoRegistro."</a></td>
						<td>".$data."</td>	
						<td>".$assunto."</td>
						<td>".$registro[$i]['numero_protocolo']."</td>
						</tr>
						";
						
					}	
					echo "
					</table>
					</div>";				
				}	
			}
			?>			
		</div>
	</div>
</div>

<script type="text/javascript">
	function confirmDelete(nmrRegistro) {
		var deletar = confirm("Excluir arquivo ?");

		if (deletar) {
			location.href = 'excluir_registro.php?nome_tabela=requerimentos&nmr_registro='+nmrRegistro;
		} else {

		}
	}
</script>					

<?php require_once("footer.php") ?>