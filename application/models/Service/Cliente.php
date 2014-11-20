<?php

/**
 * Servico de corrida
 *
 * @author Felipe
 */
class App_Model_Service_Cliente extends App_Model_Service_Abstract
{

    /**
     * Iniciar uma corrida
     * @throws App_Model_Exception 
     */
    public function cadastrar( $arParametro )
    {                        
        $montador    = new Central_Montador_Cliente();
        $cliente     = $montador->carregarDominioPorArray( $arParametro );
        $rCliente    = new App_Model_Repository_Cliente();
        return $rCliente->salvar( $cliente );
    }

}
