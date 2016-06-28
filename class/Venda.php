<?php

class Venda{
    private $id;
    private $dataVenda;
    private $valorDesconto;
    private $valorPago;
    private $clienteId;
    private $reserva;


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
     * Gets the value of dataVenda.
     *
     * @return mixed
     */
    public function getDataVenda()
    {
        return $this->dataVenda;
    }

    /**
     * Sets the value of dataVenda.
     *
     * @param mixed $dataVenda the data venda
     *
     * @return self
     */
    public function setDataVenda($dataVenda)
    {
        $this->dataVenda = $dataVenda;

        return $this;
    }

    /**
     * Gets the value of valorDesconto.
     *
     * @return mixed
     */
    public function getValorDesconto()
    {
        return $this->valorDesconto;
    }

    /**
     * Sets the value of valorDesconto.
     *
     * @param mixed $valorDesconto the valor desconto
     *
     * @return self
     */
    public function setValorDesconto($valorDesconto)
    {
        $this->valorDesconto = $valorDesconto;

        return $this;
    }

    /**
     * Gets the value of valorPago.
     *
     * @return mixed
     */
    public function getValorPago()
    {
        return $this->valorPago;
    }

    /**
     * Sets the value of valorPago.
     *
     * @param mixed $valorPago the valor pago
     *
     * @return self
     */
    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;

        return $this;
    }

    /**
     * Gets the value of clienteId.
     *
     * @return mixed
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }

    /**
     * Sets the value of clienteId.
     *
     * @param mixed $clienteId the cliente id
     *
     * @return self
     */
    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    /**
     * Gets the value of clienteId.
     *
     * @return mixed
     */
    public function getReserva()
    {
        return $this->reserva;
    }

    /**
     * Sets the value of clienteId.
     *
     * @param mixed $clienteId the cliente id
     *
     * @return self
     */
    public function setReserva($reserva)
    {
        $this->reserva = $reserva;

        return $this;
    }

    public function salvar($conexao){
        $sql = "INSERT INTO ddc_app_vendas.venda (
                    data_venda
                    ,valor_desconto
                    ,valor_pago
                    ,cliente_id
                    ,reserva
                )
                VALUES(
                    '".$this->dataVenda."'
                    ,'".$this->valorDesconto."'
                    ,'".$this->valorPago."'
                    ,'".$this->clienteId."'    
                    ,'".$this->reserva."'
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
}

?>