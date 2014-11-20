<?php

/**
 * Description of AbstractRepository
 *
 * @author Felipe
 */
class App_Model_Repository_Colete extends App_Model_Repository_AbstractRepository
{

    /**
     * seta o map App_Model_Map_Colete
     */
    public function __construct()
    {
        $this->oMap = new App_Model_Map_Colete( new App_Model_Db_Colete() );
    }

    /**
     * Recupera os coletes ativos que não possuem funcionario vinculado
     * @return array
     */
    public function recuperarColetesSemFuncionario()
    {
        return $this->oMap->recuperarTodos( 'id_funcionario is null and st_colete = '
                        . App_Model_Colete::ST_COLETE_ATIVO );
    }

    /**
     * Recupera os coletes ativos que possuem funcionario vinculado e estão disponiveis
     * @return array
     */
    public function recuperarColetesDisponiveis()
    {
        return $this->oMap->recuperarTodos( 'id_funcionario is not null
                                             and st_colete = ' . App_Model_Colete::ST_COLETE_ATIVO . '
                                             and st_disponibilidade = ' . App_Model_Colete::ST_DISPONIBILIDADE_ATIVO );
    }
    
    /**
     * Recupera os coletes ativos que possuem funcionario vinculado e estão disponiveis
     * @return array
     */
    public function recuperarColetesInDisponiveis()
    {
        return $this->oMap->recuperarTodos( 'id_funcionario is not null
                                             and st_colete = ' . App_Model_Colete::ST_COLETE_ATIVO . '
                                             and st_disponibilidade = ' . App_Model_Colete::ST_DISPONIBILIDADE_INATIVO );
    }

    /**
     * Recupera colete pelo id
     * @param   id
     * @return  App_Model_Colete
     */
    public function recuperarColeteId( $id )
    {
        if ( empty( $id ) )
        {
            throw new App_Model_Map_Exception( 'Informar Colete' );
        }
        return $this->oMap->recuperarPorId( $id );
    }

    /**
     *
     * @param int $nu_colete
     * @return App_Model_Colete
     */
    public function recuperarColeteNumero( $nu_colete )
    {
        $colete  = null;
        $coletes = $this->oMap->recuperarTodos( array( "nu_colete = ?" => $nu_colete ) );
        if ( $coletes )
        {
            $colete = $coletes[0];
        }
        return $colete;
    }

    /**
     * Recuperar colete por funcionario
     * @param int $id_funcionario
     * @return App_Model_Colete
     */
    public function recuperarColeteFuncionario( $id_funcionario )
    {
        $coletes = $this->oMap->recuperarTodos( "id_funcionario = " . $id_funcionario );
        if ( !$coletes )
        {
            return null;
        }
        return $coletes[0];
    }

    /**
     * Verifica se o colete informado ja existe e caso exista lança excecao
     * @throws  App_Model_Repository_Exception
     * @param App_Model_Colete $oColete
     */
    protected function validarExistenciaColete( App_Model_Colete $oColete )
    {
        $colete = $this->recuperarColeteNumero($oColete->retornarNumeroColete());
        if ($colete) {
            // Verifica se não esta tentando alterar um registro ja existente
            if ($colete->retornarId() != $oColete->retornarId()) {
                throw new App_Model_Repository_Exception( 'Colete já existente' );
            }
        }
    }

    /**
     * Verifica se o funcionario informado ja está vinculado a algum colete
     * @param App_Model_Colete $oColete
     * @throws App_Model_Repository_Exception
     */
    protected function validarExistenciaFuncionarioColete( App_Model_Colete $oColete, App_Model_Motoboy $oMotoboy )
    {
        $funcionario = $oColete->retornarFuncionario();
        if ( isset($funcionario) && ( $funcionario->retornarId() != $oMotoboy->retornarId() ) )
        {
            throw new App_Model_Repository_Exception( 'Colete já vinculado ao Motoboy ('
                    . $funcionario->retornarPessoa()->retornarNome() . ')' );
        }
    }

    /**
     * Salva os dados do funcionario
     * @param array $arFuncionario
     * @return App_Model_Funcionario
     */
    public function salvar( App_Model_Colete $oColete )
    {
        $oColete->validar();
        $this->validarExistenciaColete( $oColete );
        return $this->oMap->salvar( $oColete );
    }

    /**
     * Vincula o colete a um funcionario
     * @param App_Model_Colete $oColete
     * @return type
     */
    public function vincularColeteFuncionario( App_Model_Colete $oColete, App_Model_Motoboy $oMotoboy )
    {
        $oMotoboy->validar();
        $oColete->validar();
        $oColete->informarFuncionario( $oMotoboy );
        $this->validarExistenciaFuncionarioColete( $oColete, $oMotoboy );
        return $this->oMap->salvar( $oColete );
    }

    public function disponibilizar( App_Model_Colete $colete )
    {
        $this->oMap->alterarDisponibilidade( $colete, App_Model_Colete::ST_DISPONIBILIDADE_ATIVO );
    }

    public function indisponibilizar( App_Model_Colete $colete )
    {
        $this->oMap->alterarDisponibilidade( $colete, App_Model_Colete::ST_DISPONIBILIDADE_INATIVO );
    }

}