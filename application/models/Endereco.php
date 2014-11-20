<?php

class App_Model_Endereco extends App_Model_AbstractDomain
{

    protected $id_endereco;
    protected $ds_endereco;
    protected $nu_endereco;
    protected $ds_complemento;
    protected $ds_bairro;
    protected $ds_cidade;
    protected $ds_uf;
    protected $st_endereco;

    /**
     * @param string $uf
     * @param string $cidade
     */
    public function __construct( $uf, $cidade, $dsEndereco )
    {
        if( empty( $uf ) ){
            $this->erros[] = "Informar UF";
        }
        
        if( empty( $cidade ) ){
            $this->erros[] = "Informar Cidade";
        }
        
        if( empty( $dsEndereco ) ){
            $this->erros[] = "Informar Endereço";
        }
        
        $this->ds_uf       = $uf;
        $this->ds_cidade   = $cidade;
        $this->ds_endereco = $dsEndereco;
        $this->st_endereco = 'A';
    }

    public function informarId( $id )
    {
        $this->id_endereco = (int) $id;
    }

    public function retornarId()
    {
        return $this->id_endereco;
    }

    public function retornarDsEndereco()
    {
        return $this->ds_endereco;
    }

    public function retornarNumero()
    {
        return $this->nu_endereco;
    }

    public function informarNumero( $numero )
    {
        $this->nu_endereco = $numero;
    }

    public function retornarComplemento()
    {
        return $this->ds_complemento;
    }

    public function informarComplemento( $complemento )
    {
        $this->ds_complemento = $complemento;
    }

    public function retornarBairro()
    {
        return $this->ds_bairro;
    }

    public function informarBairro( $bairro )
    {
        $this->ds_bairro = $bairro;
    }

    public function retornarCidade()
    {
        return $this->ds_cidade;
    }

    public function retornarUf()
    {
        return $this->ds_uf;
    }

    public function retornarStatus()
    {
        return $this->st_endereco;
    }

    public function informarStatus( $status )
    {
        $this->st_endereco = $status;
    }

}