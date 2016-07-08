<?php
	require_once("../class/Conexao.php");
	require_once("../class/Venda.php");
	require_once("../class/VendaProduto.php");
    require_once("../class/Cliente.php");
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$conexao = new Conexao();
	$venda = new Venda();
	$vendaProduto = new VendaProduto();

    $id = "";
    if(isset($_POST['venda']['id'])){
        $id = $_POST['venda']['id'];
    }
	$cliente = $_POST['venda']['cliente'];
    $reserva = $_POST['venda']['reserva'];	
    $valorBonus = $_POST['venda']['valorBonus'];//bonus caso tenha pago um valor maior do que a compra
    $valorCredito = $_POST['venda']['creditoCliente'];//credito que o cliente ja tem, entao esse credito será usado para abater no valor da compra
	$valorDesconto = $_POST['venda']['valorDesconto'];
    $creditoUtilizado = $_POST['venda']['creditoUtilizado'];
	$valorPago = $_POST['venda']['valorPago'];
    $valorTotal = $_POST['venda']['valorTotal'];//valor total da venda
    $produtos = $_POST['produtos'];


    //classe Venda
    $venda->setId($id);
	$venda->setDataVenda(date("Y-m-d h:i:s"));
    $venda->setValorDesconto($valorDesconto);
    $venda->setValorPago($valorPago);
    $venda->setClienteId($cliente);
    $venda->setReserva($reserva);
    $venda->setValorTotal($valorTotal);
    $venda->setCreditoUtilizado($creditoUtilizado);
    $venda->salvar($conexao->connect());

    //se retornou um id de venda, é pq cadastrou a venda
    if($venda->getId() != ""){
    	$vendaProduto->setVendaId($venda->getId());        
    	foreach($produtos as $produto){//entao agora vai cadastrar os produtos dessa venda  
            $vendaProduto->setPrecoVenda($produto["precoVenda"]);
    		$vendaProduto->setProdutoId($produto["id"]);
    		$vendaProduto->setQtdProduto($produto["qtd"]);//quantidade do produto que esta sendo vendido
    		$vendaProduto->salvar($conexao->connect());
    	}
    	
    }

    //salva o valor do bonus no cadastro do cliente   
    $objCliente = new Cliente();
    $objCliente->setId($cliente);            
    $objCliente->setCredito($valorBonus);//coloca bonus se pagar mais do que devia, e desconta os creditos que foi usado para essa compra
    $objCliente->salvarCredito($conexao->connect());

    echo 1;
?>