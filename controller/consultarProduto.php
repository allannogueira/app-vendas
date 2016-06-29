<?php
	require_once("../class/Conexao.php");
	require_once("../class/Produto.php");

	$_POST = file_get_contents('php://input');
	$_POST = json_decode($_POST,true);

	$conexao = new Conexao();  
	$produto = new Produto();
	
    $id = "";    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }   

    $cod = "";    
    if(isset($_POST['cod'])){
        $cod = $_POST['cod'];
    }   

    $tamanho = "";
    if(isset($_POST['tamanho'])){
        $tamanho = $_POST['tamanho'];
    }

    $sql = "SELECT 
    			P.*,
    			(select imagem from ddc_app_vendas.produto_imagens PI where PI.produto_id = P.id LIMIT 1) as imagem 
    		FROM ddc_app_vendas.produto P
            where
                (
                    (P.cod = '".$cod."' or '".$cod."' = '')
                    AND (P.tamanho = '".$tamanho."' or '".$tamanho."' = '')
                    AND '".$id."' = ''
                )
                OR id = '".$id."'

    		";
   // echo $sql;		
    $result = mysqli_query($conexao->connect(),$sql);
    while($row = mysqli_fetch_array($result)){
        $retorno[] = array(
            "id" => $row["id"]
    		,"nome" => $row["nome"]
    		,"imagem" => $row["imagem"]
            ,"precoCusto"=>$row["preco_custo"]
    		,"precoVenda"=>$row["preco_venda"]
    		,"tamanho" => $row["tamanho"]
    		,"cod" => $row["cod"]
    		,"id" => $row["id"]
            ,"estoque" => intval($row["estoque"])
            ,"promocao" => (boolean)$row["promocao"]
    	);
    }
    echo json_encode($retorno);
?>