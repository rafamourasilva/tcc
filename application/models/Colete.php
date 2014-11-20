<?php

class App_Model_Colete extends App_Model_AbstractDomain
{

    protected $id;
    protected $funcionario;
    protected $numeroColete;
    protected $disponibilidade;
    protected $status;
    
    const ST_COLETE_ATIVO   = '1';
    const ST_COLETE_INATIVO = '0';   
    const ST_DISPONIBILIDADE_ATIVO   = '1';
    const ST_DISPONIBILIDADE_INATIVO = '0';
    
    public function __construct( $numeroColete )
    {
        if($numeroColete<1)
        {
            $this->erros[] = "Favor informar um número de colete válido";
        }
        $this->numeroColete    = (int) $numeroColete;
        $this->disponibilidade = self::ST_DISPONIBILIDADE_INATIVO;
        $this->status          = self::ST_COLETE_ATIVO;
    }

    public function retornarNumeroColete()
    {
        return $this->numeroColete;
    }

    /**
     * @param \Central\Domain\Entity\Funcionario $funcionario 
     */
    public function informarFuncionario( App_Model_Funcionario $funcionario )
    {
        $this->funcionario = $funcionario;
    }

    public function retornarFuncionario()
    {
        return $this->funcionario;
    }

    public function retornarDisponibilidade()
    {
        return $this->disponibilidade;
    }

    public function retornarStatus()
    {
        return $this->status;
    }

    public function informarStatus( $status )
    {
        $this->status = $status;
    }

    public function informarDisponibilidade( $disponibilidade )
    {
        $this->disponibilidade = $disponibilidade;
    }

}