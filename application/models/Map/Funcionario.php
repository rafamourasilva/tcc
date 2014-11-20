<?php

/**
 * Description of FuncionarioMapper
 *
 * @author Felipe
 */
class App_Model_Map_Funcionario extends App_Model_Map_Generica
{

    /**
     * Retornar o objeto funcionario mapeado com os dados do banco
     * @param stdClass $row
     * @return App_Model_Funcionario 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $mPessoa = new App_Model_Map_Pessoa( new App_Model_Db_Pessoa() );
        $pessoa  = $mPessoa->recuperarPorId( $row->id_pessoa );

        $this->dominio = App_Model_Funcionario::factory( $pessoa, $row->tp_funcionario );
        $this->dominio->informarId( $row->id_funcionario );
        $this->dominio->informarStatus( $row->st_funcionario );

        $this->retornarMapeamentoCompleto( $row );

        return $this->dominio;
    }

    /**
     * Faz o mapeamento completo do objeto funcionario
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
     * Faz o mapeamento de endereço para o funcionario
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
     * Faz o mapeamento de telefones para o funcionario 
     */
    protected function carregarMapeamentoTelefone()
    {
        $dbFuncionarioTelefone = new App_Model_Db_FuncionarioTelefone();
        $dbTelefones           = $dbFuncionarioTelefone->fetchAll( 'id_funcionario = ' . $this->dominio->retornarId() );
        if ( !empty( $dbFuncionarioTelefone ) )
        {
            $mTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );
            foreach ( $dbTelefones as $valor )
            {
                $this->dominio->adicionarTelefone( $mTelefone->recuperarPorId( $valor->id_telefone ) );
            }
        }
    }

    protected function retornarMapPopulado( App_Model_AbstractDomain $funcionario )
    {
        return array(
            'id_pessoa'      => $funcionario->retornarPessoa()->retornarId()
            , 'id_endereco'    => $funcionario->retornarEndereco()->retornarId()
            , 'tp_funcionario' => $funcionario->retornarTipo()
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $funcionario )
    {
        return array( 'id_funcionario =?' => $funcionario->retornarId() );
    }

    /**
     * Salva todos os dados de funcionario
     * @param App_Model_Funcionario $funcionario 
     * @return App_Model_Funcionario
     */
    public function salvar(App_Model_AbstractDomain $funcionario )
    {
        $mPessoa  = new App_Model_Map_Pessoa( new App_Model_Db_Pessoa() );
        $idPessoa = $mPessoa->salvar( $funcionario->retornarPessoa() );
        $funcionario->retornarPessoa()->informarId( $idPessoa );

        $mEndereco  = new App_Model_Map_Endereco( new App_Model_Db_Endereco() );
        $idEndereco = $mEndereco->salvar( $funcionario->retornarEndereco() );
        $funcionario->retornarEndereco()->informarId( $idEndereco );

        $idFuncionario = parent::salvar( $funcionario );
        $funcionario->informarId( $idFuncionario );

        $this->salvarTelefone( $funcionario );
        
        return $idFuncionario;
    }
    
    protected function salvarTelefone(App_Model_Funcionario $funcionario)
    {
        $telefones = $funcionario->retornarTelefones();

        if ( count( $telefones ) > 0 )
        {
            $mTelefone = new App_Model_Map_Telefone( new App_Model_Db_Telefone() );

            $funcionarioTelefone = new App_Model_Db_FuncionarioTelefone();
            foreach ( $telefones as $telefone )
            {

                $mTelefone->salvarTelefone($telefone);

                $rowTelefone = $funcionarioTelefone->fetchRow( array(
                    'id_funcionario = ?' => $funcionario->retornarId()
                    , 'id_telefone = ?'    => $telefone->retornarId()
                        ) );

                if ( empty( $rowTelefone ) )
                {
                    $rowTelefone = $funcionarioTelefone->createRow();
                    $rowTelefone->id_funcionario = $funcionario->retornarId();
                }

                $rowTelefone->id_telefone = $telefone->retornarId();
                $rowTelefone->save();
            }
        }
    }
    
    public function recuperarEndereco($id_funcionario)
    {
        $rowFuncionario = $this->retornarDb()->fetchRow(array('id_funcionario=?'=>$id_funcionario));
        $mEndereco = new App_Model_Map_Endereco();
        return $mEndereco->recuperarPorId($rowFuncionario->id_endereco);
    }
    
    public function recuperarTelefones($id_funcionario)
    {
        $funcionarioTelefone = new App_Model_Db_FuncionarioTelefone();
        $rowsFuncionarioTelefone = $funcionarioTelefone->fetchAll(array('id_funcionario=?'=>$id_funcionario));
        $mTelefone = new App_Model_Map_Telefone(new App_Model_Db_Telefone());
        $arTelefones = array();
        foreach($rowsFuncionarioTelefone as $row)
        {
            $arTelefones[] = $mTelefone->recuperarPorId($row->id_telefone);
        }
        return $arTelefones;
    }

}
