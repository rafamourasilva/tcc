<?php

/**
 * Description of App_Model_Repository_Funcionario
 *
 * @author Felipe
 */
class App_Model_Repository_Funcionario extends App_Model_Repository_AbstractRepository
{

    public function __construct()
    {
        $this->oMap = new App_Model_Map_Funcionario( new App_Model_Db_Funcionario() );
    }

    /**
     * recupera um funcionario pelo id da corrida
     * @param int $idCorrida
     * @return App_Model_Funcionario 
     */
    public function recuperarPorCorrida( $idCorrida )
    {
        $rCorrida = new App_Model_Map_Corrida( new App_Model_Db_Corrida() );
        $corrida  = $rCorrida->recuperarPorId( $idCorrida );
        return $this->oMap->recuperarPorId( $corrida->retornarFuncionario()->retornarId() );
    }

    /**
     * Salva os dados do funcionario
     * @param array $arFuncionario
     * @return int id
     */
    public function salvar( App_Model_Funcionario $oFuncionario )
    {
        $oFuncionario->validar();
        return $this->oMap->salvar( $oFuncionario );
    }
    
    public function recuperarEndereco(App_Model_Funcionario $oFuncionario)
    {           
        return $this->oMap->recuperarEndereco($oFuncionario->retornarId());
    }
    
    public function recuperarTelefones(App_Model_Funcionario $oFuncionario)
    {           
        return $this->oMap->recuperarTelefones($oFuncionario->retornarId());
    }

}