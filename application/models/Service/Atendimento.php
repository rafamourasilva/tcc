<?php

/**
 * Servico de Atendimento
 *
 * @author Felipe
 */
class App_Model_Service_Atendimento extends App_Model_Service_Abstract
{

    public function criarCorrida( $arParametro = null )
    {        
        if( empty( $arParametro[ "funcionario" ][ "id_funcionario" ] ) )
            throw new LogicException('Informe o código do funcionário');
            
        
        $montador                      = new Central_Montador_Corrida();
        
        $corrida                       = $montador->carregarDominioPorArray( $arParametro );
        
        $rCorrida                      = new App_Model_Repository_Corrida();
        $rCorrida->salvar( $corrida );
        
        if ( !empty( $arParametro[ "coletes" ] ) )
        {          
            
            $arParametro[ "corrida" ][ "id_corrida" ] = $corrida->retornarId();                     
            $this->iniciarCorrida( $arParametro );        
        }   
    }
    
    /**
     * Iniciar uma corrida
     * @throws App_Model_Exception 
     */
    public function iniciarCorrida( $param )
    {                
        if ( !$param[ "corrida" ][ "id_corrida" ] )
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
