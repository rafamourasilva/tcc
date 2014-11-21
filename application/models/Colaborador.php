<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_Colaborador extends Zend_Db_Table_Abstract{
    protected $_primary = 'id';
    protected $_name = 'colaborador';
    
    public function todos() {
        return $this->getAdapter()->fetchAll(
                "select c.*, u.nome from colaborador c "
                . "inner join usuario u on u.id = c.usuario_id");
    }
    
    public function salvar($colaborador) {
        if(empty($colaborador["matricula"])) {
            return false;
        }
        
        return $this->insert(array(
                "nome" => $colaborador['nome'],
                'email' => $colaborador['email'],
                'senha' => $colaborador['senha'],
                'status' => 'A'
        ));
         
    }
}
