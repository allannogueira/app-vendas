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

if($id == '-1'){//busca todos com todas as imagens
   $sql = "SELECT 
   P.*,
   PI.imagem,
   PI.id as idImagem
   FROM ddc_app_vendas.produto P
   LEFT JOIN ddc_app_vendas.produto_imagens PI ON PI.produto_id = P.id  
   ";
}else if($id == ''){
    //busca somente 1 imagem do produto
    //busca todos os produtos com uma imagem representando
    $sql = "SELECT 
    P.*,
    0 as idImagem,
    thumbnail as imagem 
    FROM ddc_app_vendas.produto P
    where
    (
      (
        (P.cod = '".$cod."' or '".$cod."' = '')
        AND (P.tamanho = '".$tamanho."' or '".$tamanho."' = '')
        AND '".$id."' = ''
      )
        OR id = '".$id."'
    )    

    ";
  //  echo $sql;
}else{
    //busca 1 produto apenas, com todas as imagens
   $sql = "SELECT 
   P.*,
   PI.imagem,
   PI.id as idImagem
   FROM ddc_app_vendas.produto P
   LEFT JOIN ddc_app_vendas.produto_imagens PI ON PI.produto_id = P.id
   where
   (
   (P.cod = '".$cod."' or '".$cod."' = '')
   AND (P.tamanho = '".$tamanho."' or '".$tamanho."' = '')
   AND '".$id."' = ''
   )
   OR P.id = '".$id."'
   ";
}

//echo $sql;

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
        ,"idImagem" => $row["idImagem"]
        );
}
echo json_encode($retorno);
?>