<?php
require_once("../class/Conexao.php");
require_once("../class/ProdutosImagens.php");

//$_POST = file_get_contents('php://input');
//$_POST = json_decode($_POST,true);

$conexao = new Conexao();  
$produtosImagens = new ProdutosImagens();

$id = $_POST['idImagem'];
//echo var_dump($_POST);
echo $produtosImagens->excluirImagem($conexao->connect(),$id);


?>