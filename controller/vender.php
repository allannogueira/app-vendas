<?php
	require_once("../class/Conexao.php");
	require_once("../class/Venda.php");
	require_once("../class/VendaProduto.php");
    require_once("../class/Cliente.php");
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$conexao = new Conexao();
	$venda = new Venda();
	$vendaProduto = new VendaProduto();

	$cliente = $_POST['cliente'];
    $reserva = $_POST['reserva'];
	$produtos = $_POST['produtos'];
    $valorBonus = $_POST['valorBonus'];
	//$valorDesconto = $_POST['valorDesconto'];
	$valorPago = $_POST['valorPago'];


    //formatando dinheiro para salvar corretamente no banco de dados
    $valorPago = str_replace(".", "", $valorPago);
    $valorPago = str_replace(",", ".", $valorPago);

    $valorBonus = str_replace(",", ".", $valorBonus);
    $valorBonus = str_replace(",", ".", $valorBonus);

    //classe Venda
	$venda->setDataVenda(date("Y-m-d"));
    $venda->setValorDesconto("");
    $venda->setValorPago($valorPago);
    $venda->setClienteId($cliente);
    $venda->setReserva($reserva);
    $venda->salvar($conexao->connect());

    //se retornou um id de venda, é pq cadastrou a venda
    if($venda->getId() != ""){
    	$vendaProduto->setVendaId($venda->getId());        
    	foreach($produtos as $produto){//entao agora ira cadastrar os produtos dessa venda    		
            $vendaProduto->setPrecoVenda($produto["precoVenda"]);
    		$vendaProduto->setProdutoId($produto["id"]);
    		$vendaProduto->setQtdProduto($produto["qtd"]);//quantidade do produto que esta sendo vendido
    		$vendaProduto->salvar($conexao->connect());
    	}

        //salva o valor do bonus no cadastro do cliente
        if($valorBonus > 0){

            $objCliente = new Cliente();
            $objCliente->setId($cliente);            
            $objCliente->setCredito($valorBonus);
            $objCliente->salvarCredito($conexao->connect());
        }
    	echo 1;
    }else{
    	echo 0;
    }
?>