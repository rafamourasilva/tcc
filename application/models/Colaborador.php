<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_Colaborador extends Zend_Db_Table_Abstract{
    protected $_primary = 'id';
    protected $_name = 'colaborador';
    
    public function selectDefault() {
        return "select c.*, u.nome from colaborador c "
                . "inner join usuario u on u.id = c.usuario_id ";
    }
    
    public function todos() {
        return $this->getAdapter()->fetchAll($this->selectDefault());
    }
    
    public function salvar($colaborador) {
        if(empty($colaborador["matricula"])) {
            return false;
        }
        
        return $this->insert(array(
                'usuario_id' => $colaborador['usuario_id'],
                'cargo' => $colaborador['cargo'],
                'matricula' => $colaborador['matricula'],
                'data_adm' => $colaborador ['data_adm'],
                'data_dem' => $colaborador ['data_dem'],
                'funcao' => $colaborador ['funcao'],
                'area' => $colaborador ['area'],
                'formacao' => $colaborador ['formacao'],
        ));
        $this->view->mensagem = "Operação realizada com sucesso!"; 
    }
    
    public function buscarPorId($id) {
        $sql = $this->selectDefault();
        $sql .= " where c.id = :id";
        $bind[":id"] = $id;
        return $this->getAdapter()->fetchRow($sql, $bind);
    }
}
