<?php

/**
 * @package application
 * @subpackage controllers
 */
class ProjetoController extends Zend_Controller_Action {

    public function indexAction()
    {
        $projeto = new Application_Model_Projeto();
        $this->view->projetos = $projeto->todos();

    }
    
    public function cadastrarAction() {
        $colaborador = new Application_Model_Colaborador();                
        if($this->getParam('responsavel')) {  
            try{
                $post = $this->getAllParams();            
                $projeto = new Application_Model_Projeto();
                $projeto->salvar($post);
            }catch(Exception $e) {
                var_dump($e);
            }
            $this->view->mensagem = "Operação realizada com sucesso!";            
        }        
        $this->view->rel_colaboradores = $colaborador->todos();
    }
    
    public function editarAction() {
        $projetoModel = new Application_Model_Projeto();        
        if($this->getParam("nome_projeto")) {
            try{                
                $projeto["nome"] = $this->getParam('nome_projeto');
                $projeto["id_colaborador"] = $this->getParam('responsavel');
                $projeto["data_ini"] = $this->getParam('data_ini');
                $projeto["data_fim"] = $this->getParam('data_fim');
                $projeto["resultado"] = $this->getParam('resultado');
                unset($projeto["nome_colaborador"]);
                $where = "id = ".$this->getParam("id");
                $projetoModel->update($projeto, $where);            
            }catch(Exception $e) {
                var_dump($e);
            }
            $this->view->mensagem = "Operação realizada com sucesso!";
        }
        
        $projetoModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $projeto = $projetoModel->buscarPorId($this->getParam("id"));                   
        $colaboradorModel = new Application_Model_Colaborador();
        $responsavel = $colaboradorModel->todos();
        $this->view->projeto = $projeto;
        $this->view->rel_colaboradores = $responsavel;
        
    }
    
    public function excluirAction() {
        $projetoModel = new Application_Model_Projeto();
        $projetoModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $projeto = $projetoModel->buscarPorId($this->getParam("id"));              
        if($this->getParam("excluir")) {            
            $projetoIntegridade = $projetoModel->selectIntegrity($this->getParam("id"));            
            if(isset($projetoIntegridade['existe'])) {
                $this->view->mensagem = "Projeto possui tarefas e não pode ser excluso";
            } else {
                $where = "id = ".$this->getParam("id");
                $projetoModel->delete($where);
                $this->_redirect("/projeto");                
            }
        }
        $this->view->projeto = $projeto;

    }
    
    public function verAction() {
       $projetoModel = new Application_Model_Projeto();
        $projetoModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $projeto = $projetoModel->buscarPorId($this->getParam("id"));
        
        $this->view->projeto = $projeto;
        
        $tarefaModel = new Application_Model_Tarefa();
        
        //estou passando um array com dois parametros: projeto e status
        $this->view->tarefas_concluidos = $tarefaModel->todos(array(
            "projeto" => $projeto["id"],
            "status" => Application_Model_Projeto::STATUS_CONCLUIDO
        ));
        
        $this->view->tarefas_andamento = $tarefaModel->todos(array(
            "projeto" => $projeto["id"],
            "status" => Application_Model_Projeto::STATUS_ANDAMENTO
        ));
    }

}
