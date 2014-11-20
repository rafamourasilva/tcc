<?php

/**
 * Mapeador de dados
 *
 * @author Felipe
 */
abstract class App_Model_Map_Generica
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $dbTable;
    protected $dominio;
    protected $carregarCompleto;
    protected $map;
    protected $mapId;

    /**
     * @param  Zend_Db_Table_Abstract
     */
    public function __construct( Central_Application_Db_Abstract $dbTable, $carregarCompleto = null )
    {
        $this->carregarCompleto = $carregarCompleto;
        $this->dbTable          = $dbTable;
    }

    public function retornarDb()
    {
        return $this->dbTable;
    }

    /**
     * Faz o mapeamento db -> dominio 
     * @param   stdClass
     * @return App_Model_AbstractDomain 
     */
    abstract public function retornarMapeamentoDbDominio( $row );

    /**
     * Faz o mapeamento completo do objeto de dominio 
     */
    abstract protected function retornarMapeamentoCompleto( $row );

    abstract protected function retornarMapPopulado( App_Model_AbstractDomain $dominio );

    abstract protected function retornarMapIdPopulado( App_Model_AbstractDomain $dominio );

    /**
     * Seta se o carregamento completo do objeto de dominio
     * @param boo $carregamentoCompleto 
     */
    public function setarCarregamentoCompleto( $carregamentoCompleto )
    {
        $this->carregarCompleto = $carregamentoCompleto;
    }

    /**
     * Recupera os dados o objeto por id
     * @param int $id
     * @return App_Model_AbstractDomain|null 
     */
    public function recuperarPorId( $id )
    {        
        $dbTable = $this->dbTable->find( $id );
        
        if ( $dbTable->count() < 1 )
        {
            throw new App_Model_Map_Exception('Objeto não encontrado');
        }

        
        return $this->retornarMapeamentoDbDominio( $dbTable->current() );
    }

    /**
     * Salva os dados do objeto de dominio
     * @param App_Model_AbstractDomain $dominio
     * @return int id
     */
    public function salvar( App_Model_AbstractDomain $dominio )
    {

        $arDados = $this->retornarMapPopulado( $dominio );

        if ( !is_null( $dominio->retornarId() ) and $dominio->retornarId() > 0 )
        {
            $this->dbTable->update( $arDados, $this->retornarMapIdPopulado( $dominio ) );
            return $dominio->retornarId();
        }

        $dominio->informarId( $this->dbTable->insert( $arDados ) );

        return $dominio->retornarId();
    }

    /**
     * Recupera todos os registros do mapeamento
     * @param string $where
     * @return array 
     */
    public function recuperarTodos( $where = null, $order=null )
    {
        $arRows   = $this->dbTable->fetchAll( $where, $order );
        $arEntity = array( );
        foreach ( $arRows as $row )
        {
            $arEntity[] = $this->retornarMapeamentoDbDominio( $row );
        }
        return $arEntity;
    }
    
    public function recuperar( $where )
    {
        $row = $this->dbTable->fetchRow( $where );
        return $this->retornarMapeamentoDbDominio($row);
        
    }

}
