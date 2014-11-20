<?php

/**
 * Servico de corrida
 *
 * @author Felipe
 */
class App_Model_Service_Corrida extends App_Model_Service_Abstract
{

    /**
     * Iniciar uma corrida
     * @throws App_Model_Exception 
     */
    public function iniciar( $param )
    {                
        if ( !$param[ "corrida" ] )
        {
            throw new App_Model_Exception( array( "Favor informar a corrida" ) );
        }

        if ( !isset( $param[ "coletes" ] ) || 1 > count( $param[ "coletes" ] ) )
        {
            throw new App_Model_Exception( array( "Favor informar o(s) colete(s)" ) );
        }

        $rCorrida = new App_Model_Repository_Corrida();
        $corrida  = $rCorrida->recuperarCorridaId( $param[ "corrida" ][ "id_corrida" ] );

        $rColete = new App_Model_Repository_Colete();
        foreach ( $param[ "coletes" ] as $idcolete )
        {
            $corrida->adicionarColete( $rColete->recuperarColeteId( $idcolete ) );
        }
        
        return $rCorrida->iniciar( $corrida );
    }

}
