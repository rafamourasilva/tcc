<?php

/**
 * Description of App_Model_Repository_Cliente
 *
 * @author Felipe
 */
class App_Model_Repository_Cliente extends App_Model_Repository_AbstractRepository
{

    public function __construct()
    {
        $this->oMap = new App_Model_Map_Cliente( new App_Model_Db_Cliente() );
    }

    /**
     * recupera um cliente pelo telefone
     * @param int $ddd
     * @param string $telefone
     * @return App_Model_Cliente
     */
    public function recuperarPorTelefone( $ddd, $telefone )
    {
        return $this->oMap->recuperarPorTelefone( $ddd, $telefone );
    }

    public function recuperarTelefones( App_Model_Cliente $cliente )
    {
        return $this->oMap->recuperarTelefones( $cliente->retornarId() );
    }

    public function recuperarEnderecoCliente( $id_cliente )
    {
        $cliente = $this->oMap->retornarDb()->find( $id_cliente );
        if ( !$cliente )
        {
            throw new App_Model_Repository_Exception( 'Favor informar o cliente para recuperar seu endereço' );
        }
        $cliente   = $cliente->current();
        $mEndereco = new App_Model_Map_Endereco();
        return $mEndereco->recuperarPorId( $cliente->id_endereco );
    }

    /**
     * Salva os dados do cliente
     * @param array $arCliente
     * @return int id
     */
    public function salvar( App_Model_Cliente $oCliente )
    {
        $oCliente->validar();
        return $this->oMap->salvar( $oCliente );
    }

}
