<?php
	require_once("class/Conexao.php");
	require_once("class/Cliente.php");
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$conexao = new Conexao();
	$cliente = new Cliente();

	$sql = "SELECT * FROM ddc_app_vendas.cliente";
    $result = mysqli_query($conexao->connect(),$sql);
    while($row = mysqli_fetch_array($result)){
    	$retorno[] = array("id"=>$row["id"],"nome"=>$row["nome"]);    
    }
    echo json_encode($retorno);
?>