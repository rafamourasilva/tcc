<?php

/**
 *
 * @author Arthur Cláudio de Almeida Pereira 
 */
class App_Model_AbstractDomain
{

    /**
     *
     * @var array $erros 
     */
    protected $erros = array();
    
    protected $id;
    
    /**
     * Retorna o identificador da entidade
     * @return integer
     */
    public function retornarId()
    {
        return $this->id;
    }

    public function informarId( $id )
    {
        $this->id = $id;
    }   
    
    public function validar()
    {
        if( count( $this->erros ) > 0 )
        {
            throw new App_Model_Exception( $this->erros );
        }
    }
}

