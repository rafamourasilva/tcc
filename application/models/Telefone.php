<?php

class App_Model_Telefone extends App_Model_AbstractDomain
{

    protected $id_telefone;
    protected $nu_ddd;
    protected $nu_telefone;
    protected $st_telefone;

    /**
     *
     * @param string $ddd
     * @param string $numero 
     */
    public function __construct( $ddd, $numero )
    {
        if(empty($ddd))
        {
            $this->erros[] = "Informar DDD";            
        }
        if(empty($numero))
        {
            $this->erros[] = "Informar Telefone";
        }
        $this->nu_ddd = $ddd;
        $this->nu_telefone = $numero;
        $this->st_telefone = 'A';
    }

    public function retornarId()
    {
        return $this->id_telefone;
    }

    public function informarId( $id )
    {
        $this->id_telefone = (int) $id;
    }

    public function retornarDdd()
    {
        return $this->nu_ddd;
    }

    public function retornarNumero()
    {
        return $this->nu_telefone;
    }

    public function retornarStatus()
    {
        return $this->st_telefone;
    }

    public function informarStatus( $status )
    {
        $this->st_telefone = $status;
    }

}