<?php

/**
 * Description of FuncionarioMapper
 *
 * @author Felipe
 */
class App_Model_Map_Colete extends App_Model_Map_Generica
{

    /**
     *
     * @param type $row
     * @return type 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $this->dominio = new App_Model_Colete( $row->nu_colete );
        $this->dominio->informarId( $row->id_colete );
        $this->retornarMapeamentoFuncionario( $row->id_funcionario );
        $this->dominio->informarStatus( $row->st_colete );
        $this->dominio->informarDisponibilidade( $row->st_disponibilidade );
        return $this->dominio;
    }

    protected function retornarMapeamentoFuncionario( $idfuncionario = null )
    {
        if ( !is_null( $idfuncionario ) )
        {
            $mFuncionario   = new App_Model_Map_Funcionario(new App_Model_Db_Funcionario(), true);
            $funcionario    = $mFuncionario->recuperarPorId( $idfuncionario );           
            $this->dominio->informarFuncionario( $funcionario );
        }
    }
    
    protected function retornarMapeamentoCompleto( $row ){
        
    }
    
    protected function retornarMapPopulado( App_Model_AbstractDomain $colete )
    {
        $idfuncionario = null;
        if( $colete->retornarFuncionario() != null ) {
            $idfuncionario = $colete->retornarFuncionario()->retornarId();
        }
        return array(
              'nu_colete' => $colete->retornarNumeroColete()
            , 'id_funcionario' => $idfuncionario
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $colete )
    {
        return array( 'id_colete =?' => $colete->retornarId() );
    }   
    
    public function alterarDisponibilidade(App_Model_Colete $colete, $disponibilidade)
    {
        $this->retornarDb()->update(array('st_disponibilidade'=>$disponibilidade)
                                   ,array('id_colete =?'=>$colete->retornarId()));    
    }
    
}
