<?php
	require_once("class/Conexao.php");
	require_once("class/Produto.php");
	
	$_POST = file_get_contents('php://input');

  $conexao = new Conexao();  
  
  //envia as imagens do produto
  if(isset($_GET['codProduto'])){
    require_once("class/ProdutosImagens.php");
    $imagens = new ProdutosImagens();
    $imagens->setProduto($_GET['codProduto']);

    $path = $_FILES['files']['tmp_name'];
    $name = $_FILES['files']['name'];
    $tam = sizeof($path);

    for($i = 0;$i < $tam; $i++);
    {        
      $type = pathinfo($name[$i], PATHINFO_EXTENSION);
      $getContents = file_get_contents($path[$i]);
 
      $imgBase64 = 'data:image/' . $type . ';base64, ' . base64_encode($getContents);   

      $imagens->setImagem($imgBase64);
      echo $imagens->salvar($conexao->connect());      
    }
  }else{//cadastra ou altera o produto    
    $_POST = json_decode($_POST,true);

    $produto = new Produto();
    $produto->setCod($_POST['codigo']);
    $produto->setNome($_POST['nome']);
    $produto->setPrecoCusto($_POST['precoCusto']);
    $produto->setPrecoVenda($_POST['precoVenda']);
    $produto->setEstoque($_POST['estoque']);
    echo $produto->salvar($conexao->connect());   
  }
    
?>