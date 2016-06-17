<?php

class Produto{
    private $id;
    private $cod;
    private $nome;
    private $precoCusto;
    private $precoVenda;
	
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

    public function salvar($conexao){
        if($this->getCod() == "")
            return "Por favor, preencha o código do produto.";

        $sql = "INSERT INTO ddc_app_vendas.produto (
                    cod
                    ,nome
                    ,preco_custo
                    ,preco_venda                    
                )
                VALUES(
                    '".$this->getCod()."'
                    ,'".$this->getNome()."'
                    ,'".$this->getPrecoCusto()."'
                    ,'".$this->getPrecoVenda()."'                    
                )
        ";      
        $result = mysqli_query($conexao,$sql);

        if($result){
            $id = mysqli_insert_id($conexao);
            $this->setId($id);
            return $id;
        }

        return $result;
    }

    public function listar($conexao){
        $sql = "SELECT * FROM ddc_app_vendas.produto";
        $result = mysqli_query($conexao,$sql);
        $row = mysqli_fetch_array($result);
        while($row){
            echo $row["nome"];    
        }        
        //echo = $row["preco_custo"]);
    }
}

?>