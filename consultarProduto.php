<?php
	require_once("class/Conexao.php");
	require_once("class/Produto.php");
	
	$_POST = file_get_contents('php://input');
	$_POST = json_decode($_POST,true);

	$conexao = new Conexao();  
	$produto = new Produto();
	
    $sql = "SELECT P.*,PI.imagem FROM ddc_app_vendas.produto P
    		LEFT JOIN ddc_app_vendas.produto_imagens PI on PI.produto_id = P.id";
    $result = mysqli_query($conexao->connect(),$sql);
    while($row = mysqli_fetch_array($result)){
        $retorno[] = array("nome" => $row["nome"],"imagem" => $row["imagem"], "precoVenda"=>$row["preco_venda"]);
    }
    echo json_encode($retorno);
    
	
    
?>