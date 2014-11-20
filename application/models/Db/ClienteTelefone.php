<?php

/**
 * @author Felipe
 */
class App_Model_Db_ClienteTelefone extends Central_Application_Db_Abstract
{

    protected $_primary = array( 'id_cliente', 'id_telefone' );
    protected $_name = 'tb_cliente_telefone';

}

