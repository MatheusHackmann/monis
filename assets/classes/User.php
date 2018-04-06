<?php
require_once("Sql.php");

class User{

	private $login;
	private $password;

	public function getLogin(){
		return $this->login;
	}
	public function getPassword(){
		return $this->password;
	}

	public function setData($login, $password){
		$this->login = $login;
		$this->password = $password;
	}			

	public function validarUsuario(){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE usuario = :LOGIN AND senha = :PASSWORD", $params = array(
			":LOGIN" => $this->login,
			":PASSWORD" => $this->password
		));
		
		if(count($results) > 0){
			session_start();
			$_SESSION['usuario'] = $this->login;			
			header("Location: assets/pages/index.php");
		}else{
			$login = false;
		}
	}
}
