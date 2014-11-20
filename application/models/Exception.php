<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exception
 *
 * @author Felipe
 */
class App_Model_Exception extends Exception {
    
    protected $erros = array();
    
    public function __construct( array $erros )
    {
        $this->erros   = $erros;
        $this->message = $this->retornarMensagem();
        
    }
    
    public function retornarMensagem()
    {
        $erros = "";
        foreach( $this->erros as $erro )
        {
            $erros .= $erro . ";";            
        }
        return $erros;
    }
}

