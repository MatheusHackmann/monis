<?php
require_once("Sql.php");

class Registros{

	private $nomeTabela;
	private $nmrRegistro;
	private $anoRegistro;
	private $pdf;

	public function setTabela($nomeTabela)
	{
		$this->nomeTabela = $nomeTabela;
	}


	public function setNmrRegistro($nmrRegistro)
	{
		$this->nmrRegistro = $nmrRegistro;
	}

	public function setAnoRegistro($ano)
	{
		$this->anoRegistro = $ano;
	}


	public function novoCadastroLPD($data, $assunto, $nmrProtocolo)
	{

		$sql = new Sql();

		$existeRegistro = $sql->select("SELECT * FROM ".$this->nomeTabela." WHERE numero_registro = :EXISTE_REGISTRO AND ano_registro = :ANO_REGISTRO;", 
			$param = array(
				":EXISTE_REGISTRO" => $this->nmrRegistro,
				":ANO_REGISTRO" => $this->anoRegistro
			));
		
		if (count($existeRegistro) == 0) {
			$sql->query("INSERT INTO " . $this->nomeTabela . " (
				numero_registro,
				ano_registro, 
				data_registro,
				assunto, 
				numero_protocolo, 
				pdf
			) 
			VALUES (
				:NMR_REGISTRO,
				:ANO_REGISTRO, 
				:DATA, 
				:ASSUNTO, 
				:NMR_PROTOCOLO, 
				:PDF
			);", 
			$params = array(
				":NMR_REGISTRO" => $this->nmrRegistro,
				":ANO_REGISTRO" => $this->anoRegistro,
				":DATA" => utf8_decode($data),
				":ASSUNTO" => utf8_decode($assunto),
				":NMR_PROTOCOLO" => utf8_decode($nmrProtocolo),
				":PDF" => $this->pdf
			));	

			$sucess = "Registro cadastrado!";
			return $sucess;	
			exit();
		}
	}

	public function novoCadastroRI($dataRegistro, $dataRecebida, $assunto, $vereadores, $secretarias, $numeroProtocolo, $dataEnvio)
	{

		$dataCriacao = explode("-", $dataRegistro);
		$dataRec = explode("-", $dataRecebida);
		$dataEnv = explode("-", $dataEnvio);

		//Se a data de recebimento for menor que a data de criação
		if (($dataRec[2] < $dataCriacao[2]) && ($dataRec[0] <= $dataCriacao[0])) {
			//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));

			return "1";
			exit();
		}
		//Se a data de envio for menor que a data de criação
		else if (($dataEnv[2] < $dataCriacao[2]) && ($dataEnv[0] <= $dataCriacao[0])){
		//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));	

			return "2";
			exit();
		}
		//Se a data de envio for menor que a data de recebimento
		else if(($dataEnv[2] < $dataRec[2]) && ($dataEnv[0] <= $dataRec[0])) {
		//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));

			return "3";
			exit();
		}
		else {
			$secs = implode(";", $secretarias);
			
			$sql = new Sql();

			$existeRegistro = $sql->select("SELECT * FROM ".$this->nomeTabela." WHERE numero_registro = :EXISTE_REGISTRO AND ano_registro = :ANO_REGISTRO;", 
				$param = array(
					":EXISTE_REGISTRO" => $this->nmrRegistro,
					":ANO_REGISTRO" => $this->anoRegistro
				));
			
			if (count($existeRegistro) == 0) {
				$sql->query("INSERT INTO " . $this->nomeTabela . " (
					numero_registro, 
					ano_registro,
					data_registro,
					data_recebida,
					assunto, 
					vereadores,
					secretarias,
					numero_protocolo,
					data_envio, 
					pdf
				) 
				VALUES (
					:NMR_REGISTRO, 
					:ANO_REGISTRO,
					:DATA_REGISTRO,
					:DATA_RECEBIDA, 
					:ASSUNTO, 
					:VEREADORES,
					:SECRETARIAS,
					:NMR_PROTOCOLO,
					:DATA_ENVIO, 
					:PDF
				);", 
				$params = array(
					":NMR_REGISTRO" => $this->nmrRegistro,
					":ANO_REGISTRO" => $this->anoRegistro,
					":DATA_REGISTRO" => utf8_decode($dataRegistro),
					":DATA_RECEBIDA" => utf8_decode($dataRecebida),
					":ASSUNTO" => utf8_decode($assunto),
					":VEREADORES" => utf8_decode($vereadores),
					":SECRETARIAS" => utf8_decode($secs),
					":NMR_PROTOCOLO" => $numeroProtocolo,
					"DATA_ENVIO" => utf8_decode($dataEnvio),
					":PDF" => $this->pdf
				));	

				$sucess = "Registro cadastrado!";
				return $sucess;	
				exit();
			}
		}

	}		

	public function novoCadastroOficio($dataRegistro, $dataRecebida, $assunto, $origem, $destino, $dataEnvio, $dataResponder)
	{

		$dataCriacao = explode("-", $dataRegistro);
		$dataRec = explode("-", $dataRecebida);
		$dataEnv = explode("-", $dataEnvio);
		$dataRes = explode("-", $dataResponder);

		//Se a data de recebimento for menor que a data de criação
		if (($dataRec[2] < $dataCriacao[2]) && ($dataRec[0] <= $dataCriacao[0])) {
			//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));

			return "1";
			exit();
		}
		//Se a data de envio for menor que a data de criação
		else if (($dataEnv[2] < $dataCriacao[2]) && ($dataEnv[0] <= $dataCriacao[0])){
			//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));	

			return "2";
			exit();
		}
		//Se a data de envio for menor que a data de recebimento
		else if(($dataEnv[2] < $dataRec[2]) && ($dataEnv[0] <= $dataRec[0])) {
			//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));

			return "3";
			exit();
		}
		//Se a data de resposta for menor que a data de recebimento
		else if(($dataRes[2] < $dataRec[2]) && ($dataRes[0] <= $dataRec[0])) {
			//Deleto a pasta criada com os arquivos PDF
			$dir = "../arquivos/".$this->nomeTabela."/".$this->nmrRegistro.$this->anoRegistro;
			exec(sprintf("rd /s /q %s", escapeshellarg($dir)));

			return "4";
			exit();
		}		
		else {		

			$sql = new Sql();

			$existeRegistro = $sql->select("SELECT * FROM ".$this->nomeTabela." WHERE numero_registro = :EXISTE_REGISTRO AND ano_registro = :ANO_REGISTRO;", 
				$param = array(
					":EXISTE_REGISTRO" => $this->nmrRegistro,
					":ANO_REGISTRO" => $this->anoRegistro
				));

			if (!count($existeRegistro)>0) {
				$sql->query("INSERT INTO " . $this->nomeTabela . " (
					numero_registro, 
					ano_registro,
					data_registro,
					data_recebida,
					assunto, 
					origem,
					destino,
					data_envio, 
					data_responder,
					pdf
				) 
				VALUES (
					:NMR_REGISTRO, 
					:ANO_REGISTRO,
					:DATA_REGISTRO,
					:DATA_RECEBIDA, 
					:ASSUNTO, 
					:ORIGEM,
					:DESTINO,
					:DATA_ENVIO, 
					:DATA_RESPONDER,
					:PDF
				);", 
				$params = array(
					":NMR_REGISTRO" => $this->nmrRegistro,
					":ANO_REGISTRO" => $this->anoRegistro,
					":DATA_REGISTRO" => $dataRegistro,
					":DATA_RECEBIDA" => $dataRecebida,
					":ASSUNTO" => utf8_decode($assunto),
					":ORIGEM" => utf8_decode($origem),
					":DESTINO" => utf8_decode($destino),
					"DATA_ENVIO" => $dataEnvio,
					":DATA_RESPONDER" => $dataResponder,
					":PDF" => $this->pdf
				));	

				$sucess = "Registro cadastrado!";
				return $sucess;	
				exit();
			}
		}
	}			



	public function uploadPdf($pdf)
	{	
		//Verifica se existe o Número do Registro já está cadastrado, caso sim, não cria a pasta nem o registro
		$sql = new Sql();

		$nomePasta = $this->nmrRegistro.$this->anoRegistro;

		$existeRegistro = $sql->select("SELECT * FROM ".$this->nomeTabela." WHERE numero_registro = :EXISTE_REGISTRO AND ano_registro = :ANO_REGISTRO;", 
			$param = array(
				":EXISTE_REGISTRO" => $this->nmrRegistro,
				":ANO_REGISTRO" => $this->anoRegistro
			));	

		if (count($existeRegistro) == 0) {
			if (!is_dir($nomePasta)) {
				mkdir("../arquivos/".$this->nomeTabela."/".$nomePasta, 0777, true);

				for ($i=0; $i < count($pdf['name']); $i++) { 

					//Analisa qual a extensao da pdf
					preg_match("/\.(pdf){1}$/i", $pdf["name"][$i], $ext);
					//Cria um nome unico pra pdf
					$nome_pdf[$i] = md5(uniqid(time())) . "." . $ext[1];
					//Cria o caminho que a foto deve ser gravada
					$caminho_pdf = "../arquivos/".$this->nomeTabela."/".$nomePasta."/".$nome_pdf[$i];
					//Grava a foto no caminho
					move_uploaded_file($pdf["tmp_name"][$i], $caminho_pdf);

					$this->pdf = implode(";", $nome_pdf);
				}				
			}	
		}
		else{
			$registroExiste = "Número de Registro já cadastrado!";
			return $registroExiste;
			exit();
		} 	

	}

	public function buscarRegistros()
	{
		$sql = new Sql();

		$registros = $sql->select("SELECT * FROM " . $this->nomeTabela . " WHERE numero_registro = :NMR_REGISTRO AND ano_registro = :ANO_REGISTRO;", 
			$param = array(
				":NMR_REGISTRO" => $this->nmrRegistro,
				":ANO_REGISTRO" => $this->anoRegistro
			));

		foreach ($registros as $registro) {

		}
		return $registro;
	}

	public function buscarRegistro()
	{
		$sql = new Sql();

		$registros = $sql->select("SELECT * FROM " . $this->nomeTabela . " WHERE numero_registro LIKE '".$this->nmrRegistro."%' ORDER BY data_registro DESC;");

		if (count($registros) == 0)  {
			$nenhumRegistro = true;
			return $nenhumRegistro;
			exit();
		}
		else {
			return $registros;	
		}		
	}


	public function buscarTodosRegistros()
	{	
		$sql = new Sql();

		$todosRegistros = $sql->select("SELECT * FROM ".$this->nomeTabela." ORDER BY data_registro DESC;");

		if (count($todosRegistros) == 0)  {
			$nenhumRegistro = true;
			return $nenhumRegistro;
			exit();
		}
		else {
			return $todosRegistros;	
		}
	}


	public function excluirRegistro($nmrRegistro, $anoRegistro)
	{
		$dir = "../arquivos/".$this->nomeTabela."/".$nmrRegistro.$anoRegistro;

		exec(sprintf("rd /s /q %s", escapeshellarg($dir)));

		$sql = new Sql();

		$sql->select("DELETE FROM " . $this->nomeTabela . " WHERE numero_registro = :NMR_REGISTRO AND ano_registro = :ANO_REGISTRO", 
			$param = array(
				":NMR_REGISTRO" => $nmrRegistro,
				":ANO_REGISTRO" => $anoRegistro
			));
	}

}