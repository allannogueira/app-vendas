<?php

class ProdutosImagens{
	public $imagem;
	public $produto;


    /**
     * Gets the value of imagem.
     *
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Sets the value of imagem.
     *
     * @param mixed $imagem the imagem
     *
     * @return self
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Gets the value of produto.
     *
     * @return mixed
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Sets the value of produto.
     *
     * @param mixed $produto the produto
     *
     * @return self
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }

    public function salvar($conexao){
        $sql = "INSERT INTO ddc_app_vendas.produto_imagens (
                    imagem
                    ,produto_id

                )
                VALUES(
                    '".$this->getImagem()."'
                    ,'".$this->getProduto()."'
                )
        ";      
        
        $result = mysqli_query($conexao,$sql);
    }

    public function excluirImagem($conexao, $idImagem){
        $sql = "delete from ddc_app_vendas.produto_imagens where id = '".$idImagem."'";
         $result = mysqli_query($conexao,$sql);
         return $result;

    }
}

?>