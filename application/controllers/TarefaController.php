<?php

/**
 * @package application
 * @subpackage controllers
 */
class TarefaController extends Zend_Controller_Action {

    public function indexAction()
    {
        $tarefa = new Application_Model_Tarefa();
        $this->view->tarefa = $tarefa->todos();

    }
    
    public function cadastrarAction() {
        $responsavel = new Application_Model_Colaborador();
        $projeto = new Application_Model_Projeto();  
        if($this->getParam('descricao')) {  
            try{
                $post = $this->getAllParams();            
                $tarefa = new Application_Model_Tarefa();
                $tarefa->salvar($post);
            }catch(Exception $e) {
                var_dump($e);
            }
            $this->view->mensagem = "Operação realizada com sucesso!";            
        }        
        $this->view->rel_colaboradores = $responsavel->todos();
        $this->view->rel_projeto = $projeto->todos();
    }
    
    public function editarAction() {
        $tarefaModel = new Application_Model_Tarefa();        
        if($this->getParam("data_inicial")) {
            try{                
                $tarefa["descricao"] = $this->getParam('descricao');
                $tarefa["responsavel"] = $this->getParam('responsavel');
                $tarefa["id_projeto"] = $this->getParam('id_projeto');
                $tarefa["data_inicial"] = $this->getParam('data_inicial');
                $tarefa["data_final"] = $this->getParam('data_final');
                
                $where = "id = ".$this->getParam("id");
                $tarefaModel->update($tarefa, $where);            
            }catch(Exception $e) {
                var_dump($e);
            }
            $this->view->mensagem = "Operação realizada com sucesso!";            
        }
        
        $tarefaModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $tarefa = $tarefaModel->buscarPorId($this->getParam("id"));                   
        
        $colaboradorModel = new Application_Model_Colaborador();
        $responsavel = $colaboradorModel->todos();
        $this->view->tarefa = $tarefa;
        $this->view->rel_colaboradores = $responsavel;     
        $projeto = new Application_Model_Projeto();
        $this->view->rel_projeto = $projeto->todos();  
        
    }
    
    public function excluirAction() {
        $tarefaModel = new Application_Model_Tarefa();
        $tarefaModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $tarefa = $tarefaModel->buscarPorId($this->getParam("id"));              
        if($this->getParam("excluir")) {
            $where = "id = ".$this->getParam("id");
            $tarefaModel->delete($where);
            $this->_redirect("/tarefa");
        }
        $this->view->tarefa = $tarefa;

    }
    
    public function verAction() {
        
        $tarefa = new Application_Model_Tarefa();
        $tarefa->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $rafae = $tarefa->fetchRow("id = ".$this->getParam("id"));           
        
        $this->view->tarefa = $use;
    }

}
