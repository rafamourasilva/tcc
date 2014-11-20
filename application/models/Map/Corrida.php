<?php

/**
 * Description of CorridaMapper
 *
 * @author Felipe
 */
class App_Model_Map_Corrida extends App_Model_Map_Generica
{

    /**
     *
     * @param type $row
     * @return type 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $mCliente = new App_Model_Map_Cliente( new App_Model_Db_Cliente() );
        $cliente  = $mCliente->recuperarPorId( $row->id_cliente );
        $this->dominio = new App_Model_Corrida( $cliente, $row->ds_endereco_origem, $row->ds_endereco_destino );
        $this->dominio->informarId( $row->id_corrida );
        $this->dominio->informarStatus( $row->st_corrida );
        $this->dominio->informarTelefone( $row->nu_telefone );
        $this->dominio->informarValor($row->vl_corrida);
        return $this->dominio;
    }

    protected function retornarMapeamentoCompleto( $row )
    {
        
    }

    protected function retornarMapPopulado( App_Model_AbstractDomain $corrida )
    {        
        return array(
            'id_corrida'            => $corrida->retornarId()
            , 'id_cliente'          => $corrida->retornarCliente()->retornarId()
            , 'ds_endereco_origem'  => $corrida->retornarEnderecoOrigem()
            , 'ds_endereco_destino' => $corrida->retornarEnderecoDestino()
            , 'vl_corrida'          => $corrida->retornarValor()
            , 'nu_telefone'         => $corrida->retornarTelefone()
            , 'id_funcionario'      => $corrida->retornarFuncionario()->retornarId()
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $corrida )
    {
        return array( 'id_corrida =?' => $corrida->retornarId() );
    }
    
    public function iniciar( App_Model_Corrida $corrida )
    {
        $corridaColete  = new App_Model_Db_CorridaColete();
        $coletes        = $corrida->retornarColetes();
        
        $rColete        = new App_Model_Repository_Colete();
        
        foreach($coletes as $colete)
        {            
            $corridaColete->insert(array('id_corrida' => $corrida->retornarId()
                                        ,'id_colete'  => $colete->retornarId()));
            $rColete->indisponibilizar($colete);            
        }
        
        $this->retornarDb()->update(array('st_corrida'    => 'A' )
                                   ,array('id_corrida =?' => $corrida->retornarId()));
    }
    
    
}
