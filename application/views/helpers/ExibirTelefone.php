<?php

/**
 * Exibe o telefone no formato padrão por extenso
 * @author Felipe
 */
class Zend_View_Helper_ExibirTelefone
{

    /**
     * Exibe o endereço por extenso
     * @param App_Model_Telefone $telefone
     * @return string 
     */
    public function exibirTelefone( $telefone = null )
    {
        $ds_telefone = "";
        
        if( $telefone instanceof App_Model_Telefone )
        {
            $ds_telefone = Central_Util::formatarTelefone( $telefone->retornarDdd(), $telefone->retornarNumero() );
        }
        return $ds_telefone;
    }

}