<?php

/**
 * Gera o input para cpf
 * @author Felipe
 */
class Zend_View_Helper_Cpf
{
    /**
     *
     * @param string $cpf
     * @return Zend_View_Helper_FormText 
     */
    public function cpf( $cpf = null )
    {
        return $this->view->formText( 'pessoa[nu_cpf]', $cpf, array('size'=>'18','maxlength'=>'18','class'=>'cpf') );
    }
}