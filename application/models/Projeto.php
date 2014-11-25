<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_Projeto extends Zend_Db_Table_Abstract{
    protected $_primary = 'id';
    protected $_name = 'projeto';
    
    const STATUS_ANDAMENTO = 1;
    const STATUS_CONCLUIDO = 2;
    
    
    static public $arStatus = array(
        self::STATUS_CONCLUIDO => "Concluído", 
        self::STATUS_ANDAMENTO => "Em andamento"
    );
    
    public function selectDefault() {
        return "select p.*, u.nome as nome_colaborador from projeto p 
            inner join colaborador c on p.id_colaborador = c.id 
            inner join usuario u on u.id = c.usuario_id ";
    }
    
    public function selectIntegrity($id) {
        $sql = "select count(*) as existe from projeto p 
                inner join tarefa t on t.id_projeto = p.id
                where p.id = :id";        
        return $this->getAdapter()->fetchRow($sql, array(":id"=>$id));
    }
    
    public function todos($parametros=null) {
        $sql = $this->selectDefault();
        $sql .= ' where 1=1 ';
        $binds = array();
        if(isset($parametros['colaborador'])) {
            $sql .= " and p.id_colaborador = :id_colaborador";
            $binds[':id_colaborador'] = $parametros['colaborador'];
        }
        if(isset($parametros['status'])) {
            $sql .= " and p.status = :status";
            $binds[':status'] = $parametros['status'];
        }
        return $this->getAdapter()->fetchAll($sql, $binds);
    }
    
    public function salvar($projeto) {
        if(empty($projeto["data_ini"])) {
            return false;
        }
        
        return $this->insert(array(
                'nome' => $projeto['nome_projeto'],
                'id_colaborador' => $projeto['responsavel'],                
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
