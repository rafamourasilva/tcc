<?php

/**
 * @author Felipe
 */
class App_Model_Db_Colete extends Central_Application_Db_Abstract
{
    protected $_primary = 'id_colete';
    protected $_name    = 'tb_colete';

    public function recuperarColeteNumero( $numero )
    {
        $oSelect = $this->select()->where( 'nu_colete =?', $numero );
        return $this->getAdapter()->fetchRow( $oSelect, array( ), Zend_Db::FETCH_OBJ );
    }

}

