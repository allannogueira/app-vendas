<?php
// Chama o arquivo com a classe WideImage
require('../wideimage/lib/WideImage.php');
require_once("../class/Conexao.php");
require_once("../class/Produto.php");

$_POST = file_get_contents('php://input');

$conexao = new Conexao();  

//envia as imagens do produto
if(isset($_GET['idProduto'])) {
	$idProduto = $_GET['idProduto'];

	require_once("../class/ProdutosImagens.php");
	$imagens = new ProdutosImagens();
	$imagens->setProduto($_GET['idProduto']);

	$path = $_FILES['files']['tmp_name'];
	$name = $_FILES['files']['name'];
	$tam = sizeof($path);
	$thumbnail = "";

	

	for($i = 0;$i < $tam; $i++) {        

	    //$type = pathinfo($name[$i], PATHINFO_EXTENSION);
		$dir = "../img/produtos/";

		move_uploaded_file($path[$i], $dir. $name[$i] );

		// Carrega a imagem a ser manipulada
		$image = wideImage::load($dir. $name[$i]);
		// Redimensiona a imagem
		$image = $image->resize(800,600);
		// Salva a imagem com 80% da qualidade
		$image->saveToFile($dir.$name[$i]);
		// Redimensiona a imagem
		$image = $image->resize(50,50);
		// Salva a thumbmail
		$image->saveToFile($dir."thumb_".$name[$i]);

		if($i==0){
			$thumbnail = "thumb_".$name[$i];
		}
	    //$getContents = file_get_contents($path[$i]);

	    //$imgBase64 = 'data:image/' . $type . ';base64, ' . base64_encode($getContents);   
		$imagens->setImagem($name[$i]);
		$imagens->salvar($conexao->connect());

	}
  }

  	
	$_POST = json_decode($_POST,true);

  	$produto = new Produto();

  	if(!isset($_POST['id']))
  	{
  		$_POST['id'] = $idProduto;  		
  	}
  	$produto->setId($_POST['id']);
  	$produto->setCod($_POST['cod']);
  	$produto->setNome($_POST['nome']);    
  	$produto->setPrecoCusto($_POST['precoCusto']);
  	$produto->setPrecoVenda($_POST['precoVenda']);
  	$produto->setEstoque($_POST['estoque']);
  	$produto->setPromocao($_POST['promocao']);
  	$produto->setTamanho($_POST['tamanho']);
  	$produto->setReserva($_POST['reserva']);
  	$produto->setThumbnail($thumbnail);
  	echo $produto->salvar($conexao->connect());   
  
  ?>