<?php

/**
 * Description of AbstractRepository
 *
 * @author Felipe
 */
class App_Model_Repository_Corrida extends App_Model_Repository_AbstractRepository
{

    /**
     * seta o map App_Model_Map_Corrida 
     */
    public function __construct()
    {
        $this->oMap = new App_Model_Map_Corrida( new App_Model_Db_Corrida() );
    }

    public function recuperarCorridas()
    {
        return $this->oMap->recuperarTodos();
    }

    /**
     * recupera corridas atendidas
     * @return array 
     */
    public function recuperarCorridasAtendidas()
    {
        return $this->oMap->recuperarTodos( array( "st_corrida=?" => "A" ), 'dt_corrida desc' );
    }

    /**
     * Recupera corridas pendentes
     * @return array 
     */
    public function recuperarCorridasPendentes()
    {
        return $this->oMap->recuperarTodos( "st_corrida='P'" );
    }

    /**
     * Recupara os coletes de uma corrida pelo id da corrida
     * @param int $id_corrida
     * @return array 
     */
    public function recuperarColetesCorrida( $id_corrida )
    {
        $corridaColete  = new App_Model_Db_CorridaColete();
        $corridaColetes = $corridaColete->fetchAll( array( 'id_corrida = ?' => ( int ) $id_corrida ) );

        $rColete   = new App_Model_Repository_Colete();
        $arColetes = array( );
        foreach ( $corridaColetes as $colete )
        {
            $arColetes[ ] = $rColete->recuperarColeteId( $colete->id_colete );
        }
        return $arColetes;
    }

    /**
     * Recupera corrida pelo id
     * @param   id
     * @return  App_Model_Corrida
     */
    public function recuperarCorridaId( $id )
    {
        if ( empty( $id ) )
        {
            throw new App_Model_Map_Exception( 'Informar Corrida' );
        }
        return $this->oMap->recuperarPorId( ( int ) $id );
    }

    /**
     *
     * @param App_Model_Corrida $corrida
     * @param array App_Model_Colete $coletes
     * @return type 
     */
    public function informarCorridaColetes( App_Model_Corrida $corrida, array $coletes )
    {
        foreach ( $coletes as $colete )
        {
            $corrida->adicionarColete( $colete );
        }
    }

    public function iniciar( App_Model_Corrida $corrida )
    {
        $corrida->validar();
        $this->oMap->iniciar( $corrida );
    }

    /**
     * Salva os dados do funcionario
     * @param array $arCorrida
     * @return App_Model_Corrida 
     */
    public function salvar( App_Model_Corrida $oCorrida )
    {
        $oCorrida->validar();
        return $this->oMap->salvar( $oCorrida );
    }

}