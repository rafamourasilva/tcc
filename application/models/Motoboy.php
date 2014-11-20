<?php

class App_Model_Motoboy extends App_Model_Funcionario
{

    const TP_FUNCIONARIO = "M";

    protected $colete;

    /**
     * @param App_Model_Pessoa $pessoa
     * @param App_Model_Colete $colete 
     */
    public function __construct( App_Model_Pessoa $pessoa )
    {
        parent::__construct( $pessoa, self::TP_FUNCIONARIO );
    }

    public function retornarColete()
    {
        return $this->colete;
    }

    public function informarColete( App_Model_Colete $colete )
    {
        $this->colete = $colete;
    }       

}