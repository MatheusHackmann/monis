<?php require_once("header.php") ?>
<style type="text/css">
	body{
		overflow: hidden;
	}
</style>

<div class="container-fluid bg-fundo">
	<div class="row">
		<div class="offset-1 col-2">
			<form action="teste.php" method="post" class="py-4">
				<input class="form-control" type="text" name="buscarLei" placeholder="Buscar Leis" autocomplete="off">	
				<div class="dropdown-divider"></div>
				<button class="btn btn-primary">Buscar</button>
			</form>
		</div>
	</div>

	<div class="row">
		<?php 
		require_once("../classes/Registros.php");

		if ($_POST && $_POST['buscarLei'] != "") {
			$buscarLei = new Registros();
			$buscarLei->setTabela("leis");
			$buscarLei->setNmrRegistro($_POST['buscarLei']);
			$registro = $buscarLei->buscarRegistros(); 

			if ($registro === true) {
				echo "
				<div class='offset-1 col-7 py-4'>
				<div class='alert alert-danger alert-dismissible fade show' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
				Não há nenhum cadastro com esse número de registro!
				</div>
				</div>
				";					
			}else{
				echo "<div class='offset-1 col-7 py-4' style='border:1px solid #000; padding: 10px;border-radius: 5px; text-align: justify; background-color: #fff;height: 60vh; overflow: auto;'>";


				echo "
				<p><strong>Nº DE REGISTRO</strong>: ".$registro['numero_registro']."</p>
				<p><strong>DATA</strong>: ".date("d/m/Y", strtotime($registro['data_registro']))."</p>
				<p><strong>ASSUNTO</strong>: ".utf8_encode($registro['assunto'])."</p>
				<p><strong>PROTOCOLO</strong>: ".$registro['numero_protocolo']."</p>";
				echo "
				<form action='excluir_registro' method='post' style='margin-top:20px;'>
				<input type='hidden' name='nome_tabela' value='leis'>
				<input type='hidden' name='nmr_registro' value='".$_POST['buscarLei']."'>
				<input type='hidden' name='nome_imagem' value='".$registro['imagem']."'>
				<button class='btn btn-primary'>Deletar</button>
				</form>";

				echo "</div>";


					//DIV DAS IMAGENS
				echo "<div class='col-3 py-4' style='margin-left: 5px; border:1px solid #000; padding: 10px;border-radius: 5px; text-align: justify; background-color: #fff;height: 60vh; overflow: auto;'>";

				$imagem = explode(";", $registro['imagem']);

				for ($i=0; $i < count($imagem); $i++) {
					echo "
					<a href='../images/leis/".$_POST['buscarLei']."/".$imagem[$i]."' download>

					<img src='../images/leis/".$registro['numero_registro']."/".$imagem[$i]."'
					style='height: 50vh; width: 50vh; border: 1px solid #ccc; border-radius:5px; margin-top: 3px;'
					class='img-fluid'>

					</a>
					";
				}					

				echo "</div>";
			}		
		}
		?>			

	</div>
</div>

<?php require_once("footer.php") ?>