<?php
	require_once("class/Conexao.php");
	require_once("class/Cliente.php");
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$conexao = new Conexao();
	$cliente = new Cliente();

	$cliente->setTelefone($_POST['telefone']);
	$cliente->setEndereco($_POST['endereco']);
	$cliente->setNumero($_POST['numero']);
	$cliente->setBairro($_POST['bairro']);
	$cliente->setEstado($_POST['estado']);
	$cliente->setCidade($_POST['cidade']);
	$cliente->setNome($_POST['nome']);
	$cliente->setCpf($_POST['cpf']);  	
	
	echo $cliente->salvar($conexao->connect()); 	
?>