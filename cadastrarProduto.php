<?php
	require_once("class/Conexao.php");
	require_once("class/Produto.php");
	
	$_POST = file_get_contents('php://input');

  $conexao = new Conexao();  
  
  //envia as imagens do produto
  if(isset($_GET['codProduto'])){
    require_once("class/ProdutosImagens.php");
    $imagens = new ProdutosImagens();
    echo var_dump($_FILES);

  }else{//cadastra ou altera o produto    
    $_POST = json_decode($_POST,true);

    $produto = new Produto();
    $produto->setCod($_POST['codigo']);
    $produto->setNome($_POST['nome']);
    $produto->setPrecoCusto($_POST['precoCusto']);
    $produto->setPrecoVenda($_POST['precoVenda']);
    echo $produto->salvar($conexao->connect());   
  }
    
?>