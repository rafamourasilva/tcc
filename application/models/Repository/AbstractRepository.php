<?php

/**
 * Description of AbstractRepository
 *
 * @author Felipe
 */
class App_Model_Repository_AbstractRepository
{

    /**
     *
     * @var App_Model_Map_Generica
     */
    protected $oMap;

    public function recuperarPorId( $id )
    {        
        return $this->oMap->recuperarPorId( $id );
    }

    public function recuperarTodos( $where = null )
    {
        return $this->oMap->recuperarTodos( $where );
    }

    public function recuperar( $where = null )
    {
        return $this->oMap->recuperar( $where );
    }

}