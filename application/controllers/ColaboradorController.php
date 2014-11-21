<?php

/**
 * @package application
 * @subpackage controllers
 */
class ColaboradorController extends Zend_Controller_Action {

    public function indexAction()
    {
        $usuario = new Application_Model_Usuario();
        $colaborador = new Application_Model_Colaborador();
        $this->view->array = $colaborador->todos();

    }
    
    public function cadastrarAction() {
        $usuario = new Application_Model_Usuario();                
        if($this->getParam('nome')) {
            $post = $this->getAllParams();            
            $colaborador = new Application_Model_Colaborador();
            $colaborador->salvar($post);
            $this->view->mensagem = "Operação realizada com sucesso!";            
        }
        $this->view->rel_usuarios = $usuario->fetchAll();
        $this->view->area = array(1=>"A",2=>"B",3=>"C");
        $this->view->formacao = array(1=>"FFA",2=>"FFB",3=>"FFC");
        $this->view->funcao = array(1=>"FA",2=>"FB",3=>"FC");
    }
    
    public function editarAction() {
        $colaborador = new Application_Model_Colaborador();
        $colaborador->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $use = $colaborador->fetchRow("id = ".$this->getParam("id"));           
        if($this->getParam("nome")) {
            $use->nome = $this->getParam('nome');
            $use->email = $this->getParam('email');
            $use->senha = $this->getParam('senha');
            $use->save();
            $this->view->mensagem = "Operação realizada com sucesso!";
        }
        $this->view->usuario = $use;
    }
    
    public function excluirAction() {
        $colaborador = new Application_Model_Colaborador();
        $colaborador->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $use = $colaborador->fetchRow("id = ".$this->getParam("id"));           
        if($this->getParam("excluir")) {
            $use->delete();
            $this->_redirect("/usuario");
        }
        $this->view->usuario = $use;
    }
    
    public function verAction() {
        $colaborador = new Application_Model_Colaborador();
        $colaborador->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $use = $colaborador->fetchRow("id = ".$this->getParam("id"));           
        
        $this->view->usuario = $use;
    }

}
