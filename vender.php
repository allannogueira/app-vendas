<?php
	require_once("class/Conexao.php");
	require_once("class/Cliente.php");
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$conexao = new Conexao();
	$cliente = new Cliente();

	$cliente->setTelefone($_POST['telefone']);

?>