<?php

/**
 * Description of AcertoMapper
 *
 * @author Felipe
 */
class App_Model_Map_Acerto extends App_Model_Map_Generica
{

    /**
     * Retornar o objeto acerto mapeado com os dados do banco
     * @param stdClass $row
     * @return App_Model_Acerto 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $this->dominio = new App_Model_Acerto();
        $this->dominio->informarId( $row->id_acerto );
        $this->dominio->informarStatus( $row->st_acerto );

        $this->retornarMapeamentoCompleto( $row );

        return $this->dominio;
    }

    /**
     * Faz o mapeamento completo do objeto acerto
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
     * Faz o mapeamento de endereço para o acerto
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
     * Faz o mapeamento de telefones para o acerto 
     */
    protected function carregarMapeamentoTelefone()
    {
        $dbAcertoTelefone = new App_Model_Db_AcertoTelefone();
        $dbTelefones       = $dbAcertoTelefone->fetchAll( 'id_acerto = ' . $this->dominio->retornarId() );
        if ( !empty( $dbAcertoTelefone ) )
        {
            $mTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
            foreach ( $dbTelefones as $valor )
            {
                $this->dominio->adicionarTelefone( $mTelefone->recuperarPorId( $valor->id_telefone ) );
            }
        }
    }

    protected function retornarMapPopulado( App_Model_AbstractDomain $acerto )
    {
        return array(
            'id_pessoa'   => $acerto->retornarPessoa()->retornarId()
            , 'id_endereco' => $acerto->retornarEndereco()->retornarId()
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $acerto )
    {
        return array( 'id_acerto =?' => $acerto->retornarId() );
    }

    /**
     * Salva todos os dados de acerto
     * @param App_Model_Acerto $acerto 
     * @return App_Model_Acerto
     */
    public function salvar( App_Model_Acerto $acerto )
    {

        $mPessoa  = new App_Model_Map_Pessoa( new App_Model_Db_Pessoa() );
        $idPessoa = $mPessoa->salvar( $acerto->retornarPessoa() );
        $acerto->retornarPessoa()->informarId( $idPessoa );

        $mEndereco  = new App_Model_Map_Endereco( new App_Model_Db_Endereco() );
        $idEndereco = $mEndereco->salvar( $acerto->retornarEndereco() );
        $acerto->retornarEndereco()->informarId( $idEndereco );

        $idAcerto = parent::salvar( $acerto );
        $acerto->informarId( $idAcerto );

        $this->salvarTelefone( $acerto );

        return $idAcerto;
    }

    /**
     * Salva os dados de telefone do acerto
     * @param App_Model_Acerto $acerto 
     */
    protected function salvarTelefone( App_Model_Acerto $acerto )
    {
        $telefones = $acerto->retornarTelefones();

        if ( count( $telefones ) > 0 )
        {
            $mTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );

            $acertoTelefone = new App_Model_Db_AcertoTelefone();
            foreach ( $telefones as $telefone )
            {
                $mTelefone->salvarTelefone( $telefone );

                $rowTelefone = $acertoTelefone->fetchRow( array( 'id_acerto = ?'  => $acerto->retornarId()
                    , 'id_telefone = ?' => $telefone->retornarId() ) );

                if ( empty( $rowTelefone ) )
                {
                    $rowTelefone = $acertoTelefone->createRow();
                    $rowTelefone->id_acerto = $acerto->retornarId();
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
     * @return App_Model_Acerto 
     */
    public function recuperarPorTelefone( $ddd, $telefone )
    {
        $mapTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
        $telefone    = $mapTelefone->recuperarTodos( array( 'nu_ddd =?'      => $ddd, 'nu_telefone =?' => $telefone ) );
        if ( empty( $telefone ) )
        {
            return null;
        }

        $tbAcertoTelefone = new App_Model_Db_AcertoTelefone();
        $acertoTelefone   = $tbAcertoTelefone->fetchRow( array( 'id_telefone =?' => $telefone[ 0 ]->retornarId() ) );
        if ( empty( $acertoTelefone ) )
        {
            return null;
        }

        return $this->recuperarPorId( $acertoTelefone->id_acerto );
    }

    public function recuperarTelefones( $id_acerto )
    {
        $acertoTelefone     = new App_Model_Db_AcertoTelefone();
        $rowsAcertoTelefone = $acertoTelefone->fetchAll( array( 'id_acerto =?' => $id_acerto ) );
        $mTelefone     = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
        $arTelefones   = array( );
        foreach ( $rowsAcertoTelefone as $row )
        {
            $arTelefones[ ] = $mTelefone->recuperarPorId( $row->id_telefone );
        }
        return $arTelefones;
    }

}
