<?php
	require_once("../class/Conexao.php");
	require_once("../class/Venda.php");
	require_once("../class/VendaProduto.php");
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$conexao = new Conexao();
	$venda = new Venda();
	$vendaProduto = new VendaProduto();

	$cliente = $_POST['cliente'];
    $reserva = $_POST['reserva'];
	$produtos = $_POST['produtos'];
	//$valorDesconto = $_POST['valorDesconto'];
	//$valorPago = $_POST['valorPago'];

	$venda->setDataVenda(date("Y-m-d"));
    $venda->setValorDesconto("");
    $venda->setValorPago("");
    $venda->setClienteId($cliente);
    $venda->setReserva($reserva);
    $venda->salvar($conexao->connect());

    //se retornou um id de venda, é pq cadastrou a venda
    if($venda->getId() != ""){
    	$vendaProduto->setVendaId($venda->getId());
    	foreach($produtos as $produto){//entao agora ira cadastrar os produtos dessa venda    		
    		$vendaProduto->setProdutoId($produto["id"]);
    		$vendaProduto->setQtdProduto($produto["qtd"]);//quantidade do produto que esta sendo vendido
    		$vendaProduto->salvar($conexao->connect());
    	}
    	echo 1;
    }else{
    	echo 0;
    }
?>