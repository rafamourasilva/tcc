<?php

/**
 * Description of PessoaMapper
 *
 * @author Felipe
 */
class App_Model_Map_Pessoa extends App_Model_Map_Generica
{

    /**
     * Retornar o objeto pessoa mapeado com os dados do banco
     * @param stdClass $row
     * @return App_Model_Pessoa 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $this->dominio = new App_Model_Pessoa( $row->ds_nome );
        $this->dominio->informarCpf( $row->nu_cpf );
        $this->dominio->informarId( $row->id_pessoa );
        $this->dominio->informarRg( $row->nu_rg );
        $this->dominio->informarTipo( $row->tp_pessoa );
        $this->dominio->informarStatus( $row->st_pessoa );
        return $this->dominio;
    }
    
    public function retornarMapeamentoCompleto( $row )
    {
        
    }

    public function retornarMapPopulado( App_Model_AbstractDomain $pessoa )
    {
        return array(
            'ds_nome'     => $pessoa->retornarNome()
            , 'nu_cpf'    => $pessoa->retornarCpf()
            , 'nu_rg'     => $pessoa->retornarRg()
            , 'tp_pessoa' => $pessoa->retornarTipo()
        );
    }

    public function retornarMapIdPopulado( App_Model_AbstractDomain $pessoa )
    {
        return array( 'id_pessoa =?' => $pessoa->retornarId() );
    }

}
