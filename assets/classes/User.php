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

	public function cadastrarUsuario($acesso, $usuario, $senha, $confirmarSenha)
	{

		if ($senha !== $confirmarSenha) {
			return "1";
			exit();
		}

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios where usuario = :USUARIO;",
			array(
				":USUARIO" => $usuario
			));

		if (count($results) == 0) {
			$sql->query("INSERT INTO usuarios (acesso, usuario, senha) VALUES (:ACESSO, :USUARIO, :SENHA);",
				array(
					":ACESSO" => $acesso,
					":USUARIO" => $usuario,
					":SENHA" => $senha
				));

			return "Usuário cadastrado!";
		}
		else {
			return "Esse nome de usuário já está em uso!";
			exit();
		}
	}
}
