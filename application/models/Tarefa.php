<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_Tarefa extends Zend_Db_Table_Abstract{
    protected $_primary = 'id';
    protected $_name = 'tarefa';
    
    public function selectDefault() {
        return "select t.*, u.nome as nome_colaborador, p.nome as nome_projeto from tarefa t 
            inner join projeto p on t.id_projeto = p.id 
            inner join colaborador c on p.id_colaborador = c.id 
            inner join usuario u on u.id = c.usuario_id ";
        
    }
    
    /**
     * Recuperar todas as tarefas de acordo com os parametros passados
     * 
     * @param array $parametros: responsavel, status, projeto
     * @return type
     */
    public function todos($parametros=null) {
        $sql = $this->selectDefault();
        $sql .= ' where 1=1 ';
        $binds = array();
        if(isset($parametros['responsavel'])) {
            $sql .= " and t.responsavel = :responsavel";
            $binds[':responsavel'] = $parametros['responsavel'];
        }
        if(isset($parametros['status'])) {
            $sql .= " and t.status_tarefa = :status";
            $binds[':status'] = $parametros['status'];
        }
        if(isset($parametros['projeto'])) {
            $sql .= " and t.id_projeto = :id_projeto";
            $binds[':id_projeto'] = $parametros['projeto'];
        }
        return $this->getAdapter()->fetchAll($sql, $binds);
    }
    
    public function salvar($tarefa) {
        if(empty($tarefa["data_inicial"])) {
            return false;
        }
        
        return $this->insert(array(
                'descricao' => $tarefa['descricao'],
                'responsavel' => $tarefa['responsavel'],                
                'id_projeto' => $tarefa['id_projeto'],
                'data_inicial' => $tarefa['data_inicial'],
                'data_final' => $tarefa['data_final'],                
        ));        
    }
    public function buscarPorId($id) {
        $sql = $this->selectDefault();
        $sql .= " where t.id = :id";
        $bind[":id"] = $id;
        return $this->getAdapter()->fetchRow($sql, $bind);
    }
    
}
