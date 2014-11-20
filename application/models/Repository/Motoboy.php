<?php

/**
 * Description of App_Model_Repository_Funcionario
 *
 * @author Felipe
 */
class App_Model_Repository_Motoboy extends App_Model_Repository_Funcionario
{

    /**
     * Recupera um motoboy por id
     * @param int $id
     * @return \App_Model_Motoboy 
     */
    public function recuperarPorId( $id )
    {
        $funcionario = parent::recuperarPorId( $id );
        
        $rColete = new App_Model_Repository_Colete();
        $colete  = $rColete->recuperarColeteFuncionario( $id );
        /*fixed*/
        $motoboy     = new App_Model_Motoboy( $funcionario->retornarPessoa() );
        $motoboy->informarEndereco($funcionario->retornarEndereco());
        $telefones = $funcionario->retornarTelefones();
        $motoboy->adicionarTelefone($telefones[0]);
        $motoboy->informarId( $id );
        if($colete)
        {
            $motoboy->informarColete( $colete );
        }
        $motoboy->informarEndereco( $funcionario->retornarEndereco() );
        return $motoboy;
    }

    /**
     * Mantem os dados do motoboy
     * @param App_Model_Motoboy
     * @param App_Model_Cliente
     * @throws App_Model_Repository_Exception 
     * @return int id
     */
    public function salvar( App_Model_Motoboy $oMotoboy, App_Model_Colete $colete )
    {
        if ( $colete->retornarId() < 1 )
        {
            throw new App_Model_Repository_Exception( "Colete inexistente" );
        }
        $id_motoboy = parent::salvar( $oMotoboy );
        $rColete    = new App_Model_Repository_Colete();
        $rColete->vincularColeteFuncionario( $colete, $oMotoboy );
        return $id_motoboy;
    }
    
    /**
     * Recupera os motoboys cadastrados
     * @param string $where
     * @return array 
     */
    public function recuperarTodos( $where = null )
    {
        return parent::recuperarTodos( 'tp_funcionario = \'M\'' );
    }        

}