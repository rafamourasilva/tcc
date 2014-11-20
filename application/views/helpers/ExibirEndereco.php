<?php

/**
 * Gera o input para cpf
 * @author Felipe
 */
class Zend_View_Helper_ExibirEndereco
{

    /**
     * Exibe o endereço por extenso
     * @param App_Model_Endereco $endereco
     * @return string 
     */
    public function exibirEndereco( $endereco = null )
    {
        $ds_endereco = "";
        
        if( $endereco instanceof App_Model_Endereco )
        {
            $ds_endereco = $endereco->retornarDsEndereco()
                            . ($endereco->retornarNumero()? ", ".$endereco->retornarNumero(): "")
                            . ($endereco->retornarBairro()?", ".$endereco->retornarBairro():"")
                            . ($endereco->retornarComplemento()?", ".$endereco->retornarComplemento():"");
        }
        return $ds_endereco;
    }

}