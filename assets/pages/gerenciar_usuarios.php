<?php require_once("header.php") ?>

<style type="text/css">

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
		<div class="offset-2 col-8 py-5">

			<?php 
			require_once("../classes/User.php");

				$todosOsUsuarios = new User();
				$registro = $todosOsUsuarios->usuarios();			

					echo "<div class='col-12 bg-registros'>";				

					echo "
					<table class='table table-striped' style='text-align: center;'>

					<tr>
					<th>NOME DE USUÁRIO</th>
					</tr>	
					";

					for ($i=0; $i < count($registro); $i++) { 

						$id = $registro[$i]['id'];

						echo "
						<tr>
						<td><a href='editar_usuario.php?id=$id'>".$registro[$i]['usuario']."</a></td>
						</tr>
						";
						
					}	
					echo "
					</table>
					</div>";								
			?>			
		</div>
	</div>
</div>

<?php require_once("footer.php") ?>