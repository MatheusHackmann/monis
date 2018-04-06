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
}
</style>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="offset-2 col-2">
			<form action="buscar_oficios.php" method="post" class="py-4">
				<input class="form-control" type="text" name="buscarOficio" placeholder="Buscar Ofícios" autocomplete="off">	
				<div class="dropdown-divider"></div>
				<button class="btn btn-primary">Buscar</button>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="offset-2 col-8 py-2">

			<?php 
			require_once("../classes/Registros.php");

			if ($_POST && $_POST['buscarOficio'] === "") {
				$todosOsOficios = new Registros();
				$todosOsOficios->setTabela("oficios");
				$registro = $todosOsOficios->buscarTodosRegistros();	

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

					echo "
					<div class='col-4'>
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					".count($registro)." registro(s) encontrados.
					</div>
					</div>			
					";		

					echo "<div class='col-12 bg-registros'>";				

					echo "
					<table class='table table-striped' style='text-align: center;'>

					<tr>
					<th>Nº Registro</th>
					<th>Data Registro</th>
					<th>Assunto</th>
					<th>Origem</th>
					</tr>	
					";

					for ($i=0; $i < count($registro); $i++) { 
						$assunto = substr($registro[$i]['assunto'], 0, 150 + 1) . $suffix;
						$data = date("d/m/Y", strtotime($registro[$i]['data_registro']));

						echo "
						<tr>
						<td>".$registro[$i]['numero_registro']."</td>
						<td>".$data."</td>	
						<td>".$assunto."</td>
						<td>".$registro[$i]['origem']."</td>
						</tr>
						";
						
					}	
					echo "
					</table>
					</div>";				
				}					
			}
			else if ($_POST && $_POST['buscarOficio'] != "") {
				$buscarOficio = new Registros();
				$buscarOficio->setTabela("oficios");
				$buscarOficio->setNmrRegistro($_POST['buscarOficio']);
				$registro = $buscarOficio->buscarRegistros(); 

				if ($registro === true) {
					echo "
					<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					Não há nenhum cadastro com esse número de registro!
					</div>
					";					
				}else{
					$imagem = explode(";", $registro['imagem']);

					echo "
					<div class='col-12 bg-registros'>";

					echo "
					<p><strong>Nº DE REGISTRO</strong>: ".$registro['numero_registro']."</p>
					<p><strong>DATA</strong>: ".date("d/m/Y", strtotime($registro['data_registro']))."</p>
					<p><strong>DATA RECEBIDA</strong>: ".date("d/m/Y", strtotime($registro['data_recebida']))."</p>
					<p><strong>ASSUNTO</strong>: ".utf8_encode($registro['assunto'])."</p>
					<p><strong>Origem</strong>: ".utf8_encode($registro['origem'])."</p>
					<p><strong>Destino</strong>: ".utf8_encode($registro['destino'])."</p>
					<p><strong>DATA ENVIADA</strong>: ".date("d/m/Y", strtotime($registro['data_envio']))."</p>
					<p><strong>RESPONDER ATÉ</strong>: ".date("d/m/Y", strtotime($registro['data_responder']))."</p>

					";

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
						<a href='../images/oficios/".$registro['numero_registro']."/".$imagem[$i]."' target='_blank'><img src='../images/oficios/".$registro['numero_registro']."/".$imagem[$i]."'
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
					echo "<button class='btn btn-danger' onclick='confirmDelete(".$_POST['buscarOficio'].")'>Deletar Registro</button>";					
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
			location.href = 'excluir_registro.php?nome_tabela=oficios&nmr_registro='+nmrRegistro;
		} else {

		}
	}
</script>

<?php require_once("footer.php") ?>