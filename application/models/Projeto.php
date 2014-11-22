<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_Projeto extends Zend_Db_Table_Abstract{
    protected $_primary = 'id';
    protected $_name = 'projeto';
    
    public function selectDefault() {
        return "select p.*, u.nome as nome_colaborador from projeto p 
            inner join colaborador c on p.id_colaborador = c.id 
            inner join usuario u on u.id = c.usuario_id ";
        
    }
    
    public function todos() {
        return $this->getAdapter()->fetchAll($this->selectDefault());
    }
    
    public function salvar($projeto) {
        if(empty($projeto["id_colaborador"])) {
            return false;
        }
        
        return $this->insert(array(
                'nome' => $projeto['nome_projeto'],
                'id_colaborador' => $projeto['id_colaborador'],                
                'data_ini' => $projeto['data_ini'],
                'data_fim' => $projeto['data_fim'],
                'resultado' => $projeto['resultado'],
        ));        
    }
    public function buscarPorId($id) {
        $sql = $this->selectDefault();
        $sql .= " where p.id = :id";
        $bind[":id"] = $id;
        return $this->getAdapter()->fetchRow($sql, $bind);
    }
}
