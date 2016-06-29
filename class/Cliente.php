<?php
class Cliente{
    private $id;
	private $nome;
	private $endereco;
	private $numero;
	private $bairro;
	private $cidade;
	private $estado;
	private $cpf;
	private $telefone;
    private $credito;


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
     * Gets the value of endereco.
     *
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Sets the value of endereco.
     *
     * @param mixed $endereco the endereco
     *
     * @return self
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Gets the value of numero.
     *
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Sets the value of numero.
     *
     * @param mixed $numero the numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Gets the value of bairro.
     *
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Sets the value of bairro.
     *
     * @param mixed $bairro the bairro
     *
     * @return self
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Gets the value of cidade.
     *
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Sets the value of cidade.
     *
     * @param mixed $cidade the cidade
     *
     * @return self
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Gets the value of estado.
     *
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Sets the value of estado.
     *
     * @param mixed $estado the estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Gets the value of cpf.
     *
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Sets the value of cpf.
     *
     * @param mixed $cpf the cpf
     *
     * @return self
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Gets the value of telefone.
     *
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Sets the value of telefone.
     *
     * @param mixed $telefone the telefone
     *
     * @return self
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Gets the value of telefone.
     *
     * @return mixed
     */
    public function getCredito()
    {
        return $this->credito;
    }

    /**
     * Sets the value of telefone.
     *
     * @param mixed $telefone the telefone
     *
     * @return self
     */
    public function setCredito($credito)
    {
        $this->credito = $credito;

        return $this;
    }

    public function salvar($conexao){
        if($this->id == ""){
        	$sql = "INSERT INTO ddc_app_vendas.cliente (
    		    		telefone
    				  	,endereco
    				  	,numero
    				  	,bairro
    				  	,estado
    				  	,cidade
    				  	,nome
    				  	,cpf	
                        ,credito
    		    	)
    		    	VALUES(
    		    		'".$this->telefone."'
    		    		,'".$this->endereco."'
    		    		,'".$this->numero."'
    		    		,'".$this->bairro."'
    		    		,'".$this->estado."'
    		    		,'".$this->cidade."'
    		    		,'".$this->nome."'
    		    		,'".$this->cpf."'
                        ,'".$this->credito."'
    		    	)
        	";    	
        }else{
            $sql = "UPDATE 
                        ddc_app_vendas.cliente 
                    SET
                        telefone    = '".$this->telefone."'
                        ,endereco   = '".$this->endereco."'
                        ,numero     = '".$this->numero."'
                        ,bairro     = '".$this->bairro."'
                        ,estado     = '".$this->estado."'
                        ,cidade     = '".$this->cidade."'
                        ,nome       = '".$this->nome."'
                        ,cpf        = '".$this->cpf."'
                        ,credito    = '".$this->credito."'
                    WHERE
                        id = '".$this->id."'                    
            ";      
        }
    	$result = mysqli_query($conexao,$sql);
    	return $result;
    }

    public function listar($conexao,$id = ""){
        if($id != ""){
            $where = " where id = ".$id;
        }

        $sql = "SELECT * FROM ddc_app_vendas.cliente $where";
        $result = mysqli_query($conexao,$sql);
        while($row = mysqli_fetch_array($result)){
            $retorno[] = array(
                "id"=>$row["id"]
                ,"nome"=>$row["nome"]
                ,"endereco"=>$row["endereco"]
                ,"numero"=>$row["numero"]
                ,"bairro"=>$row["bairro"]
                ,"cidade"=>$row["cidade"]
                ,"estado"=>$row["estado"]
                ,"cpf"=>$row["cpf"]
                ,"telefone"=>$row["telefone"]
                ,"credito"=>$row["credito"]
            );    
        }
        return json_encode($retorno);
    }
}

?>