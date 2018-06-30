<?php	// <!-- ============================== HEADER 156 ================================= -->

	include ("./../in.funcoes.php");
	include ("./../config.banco.php");
	
   //$msgInicial = "javascript:void(0);";
   $msgInicial = "";   
   if(isset($_POST['mi_msg'])){
	  if($_POST['mi_msg']!=""){$msgInicial = "javascript:toast('".$_POST['mi_msg']."','".$_POST['mi_type']."');";}
   }
    if(!isset($db_user) && isset($_SESSION['pmsPkUser']) ){ // GUARDA DADOS DO USUARIO LOGADO
		$sql = 'SELECT id,nome,sec,setor,cel FROM usuarios WHERE id = "'.$_SESSION['pmsPkUser'].'" ORDER BY id ASC;';
		$str = mysqli_query($conx, $sql);
		if (mysqli_num_rows($str) > 0) {
			while($db_rows = mysqli_fetch_assoc($str)){
				//$db_user = json_encode($db_rows);
				break;
			}
		}
	}
?>	