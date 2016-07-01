<?php

class VendaProduto{
    public $produtoId;
    public $vendaId;
    public $qtdProduto;
    public $precoVenda;
    
    /**
     * Gets the value of produtoId.
     *
     * @return mixed
     */
    public function getProdutoId()
    {
        return $this->produtoId;
    }

    /**
     * Sets the value of produtoId.
     *
     * @param mixed $produtoId the produto id
     *
     * @return self
     */
    public function setProdutoId($produtoId)
    {
        $this->produtoId = $produtoId;

        return $this;
    }

    /**
     * Gets the value of vendaId.
     *
     * @return mixed
     */
    public function getVendaId()
    {
        return $this->vendaId;
    }

    /**
     * Sets the value of vendaId.
     *
     * @param mixed $vendaId the venda id
     *
     * @return self
     */
    public function setVendaId($vendaId)
    {
        $this->vendaId = $vendaId;

        return $this;
    }

    /**
     * Gets the value of qtdProduto.
     *
     * @return mixed
     */
    public function getQtdProduto()
    {
        return $this->qtdProduto;
    }

    /**
     * Sets the value of qtdProduto.
     *
     * @param mixed $qtdProduto the qtd produto
     *
     * @return self
     */
    public function setQtdProduto($qtdProduto)
    {
        $this->qtdProduto = $qtdProduto;

        return $this;
    }

      /**
     * Gets the value of qtdProduto.
     *
     * @return mixed
     */
    public function getPrecoVenda()
    {
        return $this->precoVenda;
    }

    /**
     * Sets the value of qtdProduto.
     *
     * @param mixed $qtdProduto the qtd produto
     *
     * @return self
     */
    public function setPrecoVenda($precoVenda)
    {
        $this->precoVenda = $precoVenda;

        return $this;
    }

     public function salvar($conexao){
        $sql = "INSERT INTO ddc_app_vendas.produto_venda (
                    produto_id
                    ,venda_id
                    ,qtd_produto
                    ,preco_venda
                )
                VALUES(
                    '".$this->produtoId."'
                    ,'".$this->vendaId."'
                    ,'".$this->qtdProduto."'
                    ,'".$this->precoVenda."'
                )
        ";     

         $sql2 = "UPDATE ddc_app_vendas.produto set estoque = estoque - ".$this->qtdProduto." where id='".$this->produtoId."'";
        $result = mysqli_query($conexao,$sql);
        $result = mysqli_query($conexao,$sql2);
        return $result;
    }
}

?>
