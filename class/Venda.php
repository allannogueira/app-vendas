<?php

class Venda{
    private $id;
    private $dataVenda;
    private $valorDesconto;
    private $valorPago;
    private $clienteId;
    private $reserva;
    private $valorTotal;
    private $creditoUtilizado;


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
    /**
     * Gets the value of clienteId.
     *
     * @return mixed
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Sets the value of clienteId.
     *
     * @param mixed $clienteId the cliente id
     *
     * @return self
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Gets the value of clienteId.
     *
     * @return mixed
     */
    public function getCreditoUtilizado()
    {
        return $this->creditoUtilizado;
    }

    /**
     * Sets the value of clienteId.
     *
     * @param mixed $clienteId the cliente id
     *
     * @return self
     */
    public function setCreditoUtilizado($creditoUtilizado)
    {
        $this->creditoUtilizado = $creditoUtilizado;

        return $this;
    }

    public function salvar($conexao){
        if($this->id == ""){
            $sql = "INSERT INTO ddc_app_vendas.venda (
                    data_venda
                    ,valor_desconto
                    ,valor_pago
                    ,cliente_id
                    ,reserva
                    ,valor_total
                    ,credito_utilizado
                )
                VALUES(
                    '".$this->dataVenda."'
                    ,'".$this->valorDesconto."'
                    ,'".$this->valorPago."'
                    ,'".$this->clienteId."'    
                    ,'".$this->reserva."'
                    ,'".$this->valorTotal."'
                    ,'".$this->creditoUtilizado."'
                )
            ";
        }else{
             $sql = "UPDATE ddc_app_vendas.venda SET
                    data_venda = '".$this->dataVenda."'
                    ,valor_desconto = '".$this->valorDesconto."'
                    ,valor_pago = '".$this->valorPago."'
                    ,cliente_id = '".$this->clienteId."'    
                    ,reserva = '".$this->reserva."'
                    ,valor_total = '".$this->valorTotal."'
                    ,credito_utilizado = '".$this->creditoUtilizado."'
                    where id = '".$this->id."'
            ";
        }

        $result = mysqli_query($conexao,$sql);        
        if($result){
            $id = mysqli_insert_id($conexao);
            $this->setId($id);
            return $id;
        }
        return $result;
    }

    public function getVendas($conexao,$idCliente,$reserva,$cancelada){            
        $sql = "select 
                    *, 
                    (select nome from ddc_app_vendas.cliente where id = cliente_id) as nomeCliente,
                    (select credito from ddc_app_vendas.cliente where id = cliente_id) as creditoCliente
                from ddc_app_vendas.venda 
                where 
                    (cliente_id = '".$idCliente."' or '".$idCliente."' = '') 
                    and reserva = '".$reserva."' 
                    and cancelada = '".$cancelada."' 
                order by id desc";
        
        $result = mysqli_query($conexao,$sql);
        while($row = mysqli_fetch_array($result)){

        $retorno[] = array(
              "id" => (int)$row["id"]
              ,"dataVenda" => $row["data_venda"]
              ,"valorDesconto" => (float)$row["valor_desconto"]
              ,"valorPago"=>(float)$row["valor_pago"]
              ,"cliente"=> (int)$row["cliente_id"]
              ,"reserva" => (bool)$row["reserva"]              
              ,"valorTotal" => (float)$row["valor_total"]
              ,"creditoUtilizado"=>(float)$row["credito_utilizado"]
              ,"cancelada" => (booL)$row["cancelada"]   
              ,"nomeCliente" => $row["nomeCliente"]
              ,"creditoCliente" => (float)$row["creditoCliente"]
            );
        }
        return json_encode($retorno);
    }

    public function cancelarVenda($conexao,$idVenda){
        $sql = "update ddc_app_vendas.venda set cancelada = 1 where id = '".$idVenda."'";
        $result = mysqli_query($conexao,$sql);
        return $result;
    }
}

?>