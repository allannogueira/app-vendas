<?php
require_once("../class/Conexao.php");
require_once("../class/Venda.php");
require_once("../class/VendaProduto.php");
require_once("../class/Cliente.php");

$_POST = file_get_contents('php://input');
$_POST = json_decode($_POST,true);

$conexao = new Conexao();  
$venda = new Venda();
$vendaProduto = new vendaProduto();
$cliente = new Cliente();


$idVenda = "";    

if(isset($_POST['venda']['id'])){

	$idVenda = $_POST['venda']['id'];
	$valorPago = $_POST['venda']['valorPago'];
	$valorDesconto = $_POST['venda']['valorDesconto'];
	$creditoUtilizado = $_POST['venda']['creditoUtilizado'];
    $valorTotal = $_POST['venda']['valorTotal'];

    if($venda->cancelarVenda($conexao->connect(),$idVenda)){//se cancelar a venda
    	//tem que retornar o estoque dos produtos
    	$vendaProduto->retornarEstoqueVenda($conexao->connect(),$idVenda);
    	//devolver os creditos utilizados para o cliente, se foi pago algum valor, também deve ser devolvido como crédito
    	if($valorPago > 0 || $creditoUtilizado > 0){
    		//somando creditos
            if($valorPago > $valorTotal){//se pagou a mais que o total, o credito que já foi inserido não deve voltar a inserir esse credito novamente.
                $qtdCredito = $valorTotal + $creditoUtilizado;
            }else{
    		  $qtdCredito = $valorPago + $creditoUtilizado;
            }
    		$cliente->insereCreditoCliente($conexao->connect(),$qtdCredito,$_POST['venda']['cliente']);
    	}
    }
}



?>