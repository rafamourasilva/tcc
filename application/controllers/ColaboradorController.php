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
        $this->view->cargo = array(1=>"Analista",2=>"Assistente",3=>"Auxiliar");
        $this->view->area = array(1=>"Área de Gestão Estratégica",2=>"Área de Gestão de Pessoas",3=>"Área de Gestão Administrativa");
        $this->view->formacao = array(1=>"Ensino Médio",2=>"Ensino Superior",3=>"Pos-Graduação");
        $this->view->funcao = array(1=>"Estratégico",2=>"Tático-Estratégico",3=>"Operacional");
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
