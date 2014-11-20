<?php

/**
 * Gera o input para cpf
 * @author Felipe
 */
class Zend_View_Helper_ListarColetesDisponiveis
{
    /**
     *
     * @param string $cpf
     * @return Zend_View_Helper_FormText 
     */
    public function listarColetesDisponiveis( $coletesDisponiveis )
    {
        if(!$coletesDisponiveis)
        {
            return "Nenhum colete disponível";
        }
        $lista = "<ul>";
        foreach($coletesDisponiveis as $colete)
        {
            $lista .= "<li class='left center centralLi'>                                                             
                    <span class=''>".$colete->retornarNumeroColete()."</span></br>   
                        <div class='img_colete'></div>
                        <div class='borda'>
                        <input type='checkbox' name='coletes[]' value='".$colete->retornarId()."' />  
                        </div>
                  </li>";
        }
        $lista .= "</ul><div class='div-clear'></div>";
        return $lista;
    }
}