<?php

/**
 * Description of ClienteMapper
 *
 * @author Felipe
 */
class App_Model_Map_Cliente extends App_Model_Map_Generica
{

    /**
     * Retornar o objeto cliente mapeado com os dados do banco
     * @param stdClass $row
     * @return App_Model_Cliente 
     */
    public function retornarMapeamentoDbDominio( $row )
    {

        $mPessoa = new App_Model_Map_Pessoa( new App_Model_Db_Pessoa() );
        $pessoa  = $mPessoa->recuperarPorId( $row->id_pessoa );

        $this->dominio = new App_Model_Cliente( $pessoa );
        $this->dominio->informarId( $row->id_cliente );
        $this->dominio->informarStatus( $row->st_cliente );

        $this->retornarMapeamentoCompleto( $row );

        return $this->dominio;
    }

    /**
     * Faz o mapeamento completo do objeto cliente
     * @param stdClass $row 
     */
    protected function retornarMapeamentoCompleto( $row )
    {
        if ( $this->carregarCompleto )
        {
            $this->carregarMapeamentoEndereco( $row->id_endereco );
            $this->carregarMapeamentoTelefone();
        }
    }

    /**
     * Faz o mapeamento de endereço para o cliente
     * @param int $idendereco 
     */
    protected function carregarMapeamentoEndereco( $idendereco = null )
    {
        $endereco = new App_Model_Endereco( '', '', '' );
        if ( $idendereco )
        {
            $mEndereco = new App_Model_Map_Endereco( new App_Model_Db_Endereco() );
            $endereco  = $mEndereco->recuperarPorId( $idendereco );
        }
        $this->dominio->informarEndereco( $endereco );
    }

    /**
     * Faz o mapeamento de telefones para o cliente 
     */
    protected function carregarMapeamentoTelefone()
    {
        $dbClienteTelefone = new App_Model_Db_ClienteTelefone();
        $dbTelefones       = $dbClienteTelefone->fetchAll( 'id_cliente = ' . $this->dominio->retornarId() );
        if ( !empty( $dbClienteTelefone ) )
        {
            $mTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
            foreach ( $dbTelefones as $valor )
            {
                $this->dominio->adicionarTelefone( $mTelefone->recuperarPorId( $valor->id_telefone ) );
            }
        }
    }

    protected function retornarMapPopulado( App_Model_AbstractDomain $cliente )
    {
        return array(
            'id_pessoa'   => $cliente->retornarPessoa()->retornarId()
            , 'id_endereco' => $cliente->retornarEndereco()->retornarId()
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $cliente )
    {
        return array( 'id_cliente =?' => $cliente->retornarId() );
    }

    /**
     * Salva todos os dados de cliente
     * @param App_Model_Cliente $cliente 
     * @return App_Model_Cliente
     */
    public function salvar(App_Model_AbstractDomain $cliente )
    {

        $mPessoa  = new App_Model_Map_Pessoa( new App_Model_Db_Pessoa() );
        $idPessoa = $mPessoa->salvar( $cliente->retornarPessoa() );
        $cliente->retornarPessoa()->informarId( $idPessoa );

        $mEndereco  = new App_Model_Map_Endereco( new App_Model_Db_Endereco() );
        $idEndereco = $mEndereco->salvar( $cliente->retornarEndereco() );
        $cliente->retornarEndereco()->informarId( $idEndereco );

        $idCliente = parent::salvar( $cliente );
        $cliente->informarId( $idCliente );

        $this->salvarTelefone( $cliente );

        return $idCliente;
    }

    /**
     * Salva os dados de telefone do cliente
     * @param App_Model_Cliente $cliente 
     */
    protected function salvarTelefone( App_Model_Cliente $cliente )
    {
        $telefones = $cliente->retornarTelefones();

        if ( count( $telefones ) > 0 )
        {
            $mTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );

            $clienteTelefone = new App_Model_Db_ClienteTelefone();
            foreach ( $telefones as $telefone )
            {
                $mTelefone->salvarTelefone( $telefone );

                $rowTelefone = $clienteTelefone->fetchRow( array( 'id_cliente = ?'  => $cliente->retornarId()
                    , 'id_telefone = ?' => $telefone->retornarId() ) );

                if ( empty( $rowTelefone ) )
                {
                    $rowTelefone = $clienteTelefone->createRow();
                    $rowTelefone->id_cliente = $cliente->retornarId();
                }

                $rowTelefone->id_telefone = $telefone->retornarId();
                $rowTelefone->save();
            }
        }
    }

    /**
     * 
     * @param string $ddd
     * @param string $telefone
     * @return App_Model_Cliente 
     */
    public function recuperarPorTelefone( $ddd, $telefone )
    {
        $mapTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
        $telefone    = $mapTelefone->recuperarTodos( array( 'nu_ddd =?'      => $ddd, 'nu_telefone =?' => $telefone ) );
        if ( empty( $telefone ) )
        {
            return null;
        }

        $tbClienteTelefone = new App_Model_Db_ClienteTelefone();
        $clienteTelefone   = $tbClienteTelefone->fetchRow( array( 'id_telefone =?' => $telefone[ 0 ]->retornarId() ) );
        if ( empty( $clienteTelefone ) )
        {
            return null;
        }

        return $this->recuperarPorId( $clienteTelefone->id_cliente );
    }

    public function recuperarTelefones( $id_cliente )
    {
        $clienteTelefone     = new App_Model_Db_ClienteTelefone();
        $rowsClienteTelefone = $clienteTelefone->fetchAll( array( 'id_cliente =?' => $id_cliente ) );
        $mTelefone     = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
        $arTelefones   = array( );
        foreach ( $rowsClienteTelefone as $row )
        {
            $arTelefones[ ] = $mTelefone->recuperarPorId( $row->id_telefone );
        }
        return $arTelefones;
    }

}
