<?php

class Conexao{
	private $host;
	private $user;
	private $pass;
	private $database;

	public function __construct(){
		$this->host = "192.185.176.178";
		$this->user = "ddc_allan2";
		$this->pass = "Aa@123456";
		$this->database = "ddc_app_vendas";	
	}

	public function connect(){
		$conexao = mysqli_connect(
			$this->host
			,$this->user
			,$this->pass
			,$this->database
		);		
		return $conexao;
	}

}

?>