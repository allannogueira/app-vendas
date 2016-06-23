<?php

class Produto{
    private $id;
    private $cod;
    private $nome;
    private $precoCusto;
    private $precoVenda;
    private $estoque;
    private $promocao;
    private $tamanho;
    
    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Gets the value of cod.
     *
     * @return mixed
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Sets the value of cod.
     *
     * @param mixed $cod the cod
     *
     * @return self
     */
    public function setCod($cod)
    {
        $this->cod = $cod;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of precoCusto.
     *
     * @return mixed
     */
    public function getPrecoCusto()
    {
        return $this->precoCusto;
    }

    /**
     * Sets the value of precoCusto.
     *
     * @param mixed $precoCusto the preco custo
     *
     * @return self
     */
    public function setPrecoCusto($precoCusto)
    {
        $this->precoCusto = $precoCusto;

        return $this;
    }

    /**
     * Gets the value of precoVenda.
     *
     * @return mixed
     */
    public function getPrecoVenda()
    {
        return $this->precoVenda;
    }

    /**
     * Sets the value of precoVenda.
     *
     * @param mixed $precoVenda the preco venda
     *
     * @return self
     */
    public function setPrecoVenda($precoVenda)
    {
        $this->precoVenda = $precoVenda;

        return $this;
    }

    /**
     * Gets the value of estoque.
     *
     * @return mixed
     */
    public function getEstoque()
    {
        return $this->estoque;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setEstoque($estoque)
    {
        $this->estoque = $estoque;

        return $this;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getPromocao()
    {
        return $this->promocao;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setPromocao($promocao)
    {
        $this->promocao = $promocao;

        return $this;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getTamanho()
    {
        return $this->tamanho;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setTamanho($tamanho)
    {
        $this->tamanho = $tamanho;

        return $this;
    }


    public function salvar($conexao){
        if($this->getCod() == "")
            return "Por favor, preencha o código do produto.";

        if($this->id == ""){
            $sql = "INSERT INTO ddc_app_vendas.produto (
            cod
            ,nome
            ,preco_custo
            ,preco_venda
            ,estoque       
            ,promocao
            ,tamanho
            )
            VALUES(
            '".$this->getCod()."'
            ,'".$this->getNome()."'
            ,'".$this->getPrecoCusto()."'
            ,'".$this->getPrecoVenda()."'
            ,'".$this->getEstoque()."'
            ,'".$this->getPromocao()."'
            ,'".$this->getTamanho()."'
            )
            ";      
            $result = mysqli_query($conexao,$sql);

            if($result){
                $id = mysqli_insert_id($conexao);
                $this->setId($id);
                return $id;
            }
        }else{
            $result = $this->atualizar($conexao);
        }
        return $result;
    }

    public function atualizar($conexao){
        $sql = "UPDATE ddc_app_vendas.produto 
        SET
        cod =  '".$this->getCod()."'
        ,nome = '".$this->getNome()."'
        ,preco_custo = '".$this->getPrecoCusto()."'
        ,preco_venda = '".$this->getPrecoVenda()."'
        ,estoque = '".$this->getEstoque()."'  
        ,promocao = '".$this->getPromocao()."'
        ,tamanho = '".$this->getTamanho()."'
        WHERE
            id = '".$this->id."'

        ";      
        return mysqli_query($conexao,$sql);
    }

    public function listar($conexao){
        $retorno = "";
        $sql = "SELECT 
        P.*,
        PI.imagem
        FROM 
        ddc_app_vendas.produto_imagens PI 
        INNER JOIN ddc_app_vendas.produto P on P.id = PI.produto_id";
        $result = mysqli_query($conexao,$sql);
        
        while($row = mysqli_fetch_array($result)){
            $imagem = $row["imagem"];
            $cod = $row["cod"];
            $nome = $row["nome"];
            $precoCusto = $row["preco_custo"];
            $precoVenda = $row["preco_venda"];
            $estoque = $row["estoque"];
            $retorno[] = array("imagem"=>$imagem, "cod"=>$cod, "nome"=>$nome, "precoCusto"=>$precoCusto, "precoVenda"=>$precoVenda, "estoque"=>$estoque);
        }

        return json_encode($retorno) ;
        //echo = $row["preco_custo"]);
    }
}

?>