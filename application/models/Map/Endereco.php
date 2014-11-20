<?php

/**
 * Description of EnderecoMapper
 *
 * @author Felipe
 */
class App_Model_Map_Endereco extends App_Model_Map_Generica
{

    public function __construct( $carregarComplento = null )
    {
        parent::__construct( new App_Model_Db_Endereco(), $carregarComplento );
    }
    
    protected function retornarMapeamentoCompleto( $row ){
        
    }
    
    
    /**
     * Retornar o objeto endereco mapeado com os dados do banco
     * @param stdClass $row
     * @return App_Model_Endereco 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $this->dominio = new App_Model_Endereco( $row->ds_uf, $row->ds_cidade, $row->ds_endereco );
        $this->dominio->informarId( $row->id_endereco );
        $this->dominio->informarBairro( $row->ds_bairro );
        $this->dominio->informarStatus( $row->st_endereco );
        $this->dominio->informarNumero( $row->nu_endereco );
        $this->dominio->informarComplemento( $row->ds_complemento );
        return $this->dominio;
    }

    protected function retornarMapPopulado( App_Model_AbstractDomain $endereco )
    {
        return array(
            'ds_uf' => $endereco->retornarUf()
            , 'ds_cidade' => $endereco->retornarCidade()
            , 'ds_endereco' => $endereco->retornarDsEndereco()
            , 'ds_bairro' => $endereco->retornarBairro()
            , 'nu_endereco' => $endereco->retornarNumero()
            , 'ds_complemento' => $endereco->retornarComplemento()
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $endereco )
    {
        return array( 'id_endereco =?' => $endereco->retornarId() );
    }
        

}
