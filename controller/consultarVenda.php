<?php
  require_once("../class/Conexao.php");
  require_once("../class/Venda.php");
  require_once("../class/VendaProduto.php");

  $_POST = file_get_contents('php://input');
  $_POST = json_decode($_POST,true);

  $conexao = new Conexao();    

  //consulta os produtos da venda
  if(isset($_POST['idVenda'])){
    $idVenda = $_POST['idVenda'];
    $vendaProduto = new VendaProduto();
    echo $vendaProduto->getProdutos($conexao->connect(),$idVenda);
  }else{
      $idCliente = $_POST['cliente'];
    $reserva = $_POST['reserva'];
    $cancelada = $_POST['cancelada'];
    $venda = new Venda();
    echo $venda->getVendas($conexao->connect(),$idCliente,$reserva,$cancelada);
  }
  
  

?>