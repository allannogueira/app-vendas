<?php
	require_once("class/Conexao.php");
	require_once("class/Produto.php");
	
	$_POST = file_get_contents('php://input');
  $_POST = json_decode($_POST,true);

  $conexao = new Conexao();  
  
  $produto = new Produto();
  echo $produto->listar($conexao->connect());  
    
?>