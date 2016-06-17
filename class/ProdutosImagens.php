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
}

?>