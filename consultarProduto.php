<?php
	require_once("class/Conexao.php");
	require_once("class/Produto.php");
	
	$_POST = file_get_contents('php://input');
	$_POST = json_decode($_POST,true);


	$conexao = new Conexao();  
	$produto = new Produto();
	
    $sql = "SELECT 
    			P.*,
    			(select imagem from ddc_app_vendas.produto_imagens PI where PI.produto_id = P.id LIMIT 1) as imagem 
    		FROM ddc_app_vendas.produto P
    		";
    		
    $result = mysqli_query($conexao->connect(),$sql);
    while($row = mysqli_fetch_array($result)){
        $retorno[] = array(
    		"nome" => $row["nome"]
    		,"imagem" => $row["imagem"]
    		, "precoVenda"=>$row["preco_venda"]
    		,"tamanho" => $row["tamanho"]
    		,"cod" => $row["cod"]
    		,"id" => $row["id"]
    	);
    }
    echo json_encode($retorno);
    
    
?>