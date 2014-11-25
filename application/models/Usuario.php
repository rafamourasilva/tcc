<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_Usuario extends Zend_Db_Table_Abstract{
    protected $_primary = 'id';
    protected $_name = 'usuario';
    
   
    public function selectDefault() {
        return "select u.* from usuario u where u.id = :id ";
    }
    
    public function buscarPorId($id) {
        $sql = $this->selectDefault();
        $sql .= " where u.id = :id";
        $bind[":id"] = $id;
        return $this->getAdapter()->fetchRow($sql, $bind);
    }
}
