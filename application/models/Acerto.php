<?php

class App_Model_Acerto extends App_Model_AbstractDomain
{
    protected $id_acerto;
    protected $vl_acerto;
    protected $dt_acerto;
    protected $funcionario;
    protected $colete;    

    public function informarId( $id )
    {
        $this->id_acerto = (int) $id;
    }

    public function retornarId()
    {
        return $this->id_acerto;
    }

    public function retornarDsAcerto()
    {
        return $this->ds_acerto;
    }

    public function retornarNumero()
    {
        return $this->nu_acerto;
    }

    public function informarNumero( $numero )
    {
        $this->nu_acerto = $numero;
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
        return $this->st_acerto;
    }

    public function informarStatus( $status )
    {
        $this->st_acerto = $status;
    }

}