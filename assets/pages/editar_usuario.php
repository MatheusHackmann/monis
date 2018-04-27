<?php require_once("header.php") ?>

<style type="text/css">

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
		<div class='offset-md-4 col-12 col-md-2 col-lg-2'>
		<form action='gerenciar_usuarios.php' method='post' class='py-4'>
		<button class='btn btn-primary'>Buscar</button>
		</form>
		</div>
		"; ?>
	</div>



	<div class="row">
		<div class="offset-md-4 col-12 col-md-4 col-lg-4 py-2 bg-registros">

			<?php 
			require_once("../classes/User.php");
			require_once("../classes/Sql.php");

			$id = $_GET['id'];

			$usuario = new User();
			$registros = $usuario->buscarUsuario($id); 

			foreach ($registros as $registro) {
			}

			if ($registro['acesso'] == 1) 
			{
				$acesso = "Administrador";
			}
			else
			{
				$acesso = "Editor";
			}


			echo "
			<p><strong>NOME DE USUÁRIO</strong>: ".$registro['usuario']."</p>
			<p><strong>SENHA</strong>: ".$registro['senha']."</p>
			<p><strong>NÍVEL DE ACESSO</strong>: ".$acesso."</p>
			";

			?>
			
			<div class="row">
				<div class="col-8">
					<?php 
					echo "<a href='alterar_senha.php?id=$id'><button class='btn btn-primary'>Alterar Senha</button></a>"; 
					//Deletar Usuario
					echo " <button class='btn btn-danger' onclick=\"confirmDelete('".$id."')\">Deletar Usuário</button>";					
					?>					
				</div>
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">
	function confirmDelete(id) {
		var deletar = confirm("Deletar Usuário ?");

		if (deletar) {
			location.href = 'excluir_usuario.php?id='+id;
		}
		else {

		}
	}
</script>

<?php require_once("footer.php") ?>