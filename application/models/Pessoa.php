<?php

class App_Model_Pessoa extends App_Model_AbstractDomain
{

    protected $id_pessoa;
    protected $ds_nome;
    protected $nu_cpf;
    protected $tp_pessoa;
    protected $nu_rg;
    protected $st_pessoa;

    public function __construct( $nome, $tipo='F' )
    {
        /**
         * Fixme revisar estas validações 
         */
        if( empty( $nome ) )
        {
           $this->erros[] = 'Informar nome';
        }
        
        if( empty( $tipo ) )
        {
            $this->erros[] = "Informar o tipo de pessoa";
        }
        $this->tp_pessoa = $tipo;
        $this->ds_nome   = $nome;
    }

    public function retornarId()
    {
        return $this->id_pessoa;
    }

    public function informarId( $id )
    {
        $this->id_pessoa = (int) $id;
    }

    public function retornarNome()
    {
        return $this->ds_nome;
    }

    public function retornarCpf()
    {
        return substr(Central_Application_Filtro::removerPontuacao( $this->nu_cpf ), 0, 11);
    }

    public function informarCpf( $cpf )
    {
        $this->nu_cpf = $cpf;
    }

    public function retornarRg()
    {
        return Central_Application_Filtro::removerPontuacao( $this->nu_rg );
    }

    public function informarRg( $rg )
    {
        $this->nu_rg = $rg;
    }

    public function informarTipo( $tipo )
    {
        $this->tp_pessoa = $tipo;
    }

    public function retornarTipo()
    {
        return $this->tp_pessoa;
    }

    public function informarStatus( $status )
    {
        $this->st_pessoa = $status;
    }

    public function retornarStatus()
    {
        return $this->st_pessoa;
    }        

}