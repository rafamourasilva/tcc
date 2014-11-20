<?php

/**
 * Description of TelefoneMapper
 *
 * @author Felipe
 */
class App_Model_Map_Telefone extends App_Model_Map_Generica
{

    protected function retornarMapeamentoCompleto( $row ){}

    /**
     * Retornar o objeto telefone mapeado com os dados do banco
     * @param stdClass $row
     * @return App_Model_Telefone 
     */
    public function retornarMapeamentoDbDominio( $row )
    {
        $this->dominio = new App_Model_Telefone( $row->nu_ddd, $row->nu_telefone );
        $this->dominio->informarId( $row->id_telefone );
        return $this->dominio;
    }

    protected function retornarMapPopulado( App_Model_AbstractDomain $telefone )
    {
        return array(
            'nu_ddd' => $telefone->retornarDdd()
            , 'nu_telefone' => $telefone->retornarNumero()
        );
    }

    protected function retornarMapIdPopulado( App_Model_AbstractDomain $telefone )
    {
        return array( 'id_telefone =?' => $telefone->retornarId() );
    }
    
    public function recuperarTelefonePorNumero($numero)
    {
        $row = $this->retornarDb()->fetchRow(array('nu_telefone =?'=>$numero));
        if(!$row)
        {
            return null;
        }
        return $this->retornarMapeamentoDbDominio($row);
    }
    
    /**
     *
     * @param App_Model_Telefone $telefone
     * @return App_Model_Telefone 
     */
    public function salvarTelefone(App_Model_Telefone $telefone)
    {
        $telefoneExistente = $this->recuperarTelefonePorNumero( $telefone->retornarNumero() );
        if ( !empty($telefoneExistente) )
        {
            $telefone = $telefoneExistente;
        }

        if ( null == $telefone->retornarId() )
        {
            $idTelefone = parent::salvar( $telefone );
            $telefone->informarId( $idTelefone );
        }
        return $telefone;
    }

}
