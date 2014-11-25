<?php

/**
 * @package application
 * @subpackage controllers
 */
class UsuarioController extends Zend_Controller_Action {

    public function indexAction()
    {
        $usuario = new Application_Model_Usuario();
        $this->view->array = $usuario->fetchAll();
    }
    
    public function cadastrarAction() {
        if($this->getParam('nome')) {
            $post = $this->getAllParams();
            $usuario = new Application_Model_Usuario();
            $usuario->insert(array(
                "nome" => $post['nome'],
                'email' => $post['email'],
                'senha' => $post['senha'],
                'status' => 'A'
            ));
            $this->view->mensagem = "Operação realizada com sucesso!";
        }
    }
    
    public function editarAction() {
        $usuario = new Application_Model_Usuario();
        $usuario->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $use = $usuario->fetchRow("id = ".$this->getParam("id"));           
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
        $usuarioModel = new Application_Model_Usuario();
        $usuarioModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $usuario = $usuarioModel->fetchRow("id = ".$this->getParam("id"));              
        if($this->getParam("excluir")) {
            $usuario->delete();
            $this->_redirect("/usuario");
        }
        $this->view->usuario = $usuario;

    }

}
