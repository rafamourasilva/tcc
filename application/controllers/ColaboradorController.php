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
        if($this->getParam('cargo')) {
            $post = $this->getAllParams();            
            $colaborador = new Application_Model_Colaborador();
            $colaborador->salvar($post);
            $this->view->mensagem = "Operação realizada com sucesso!";            
        }        
        $this->view->rel_usuarios = $usuario->fetchAll();
        $this->view->cargo = array(''=>"Selecione",1=>"Analista",2=>"Assistente",3=>"Auxiliar");
        $this->view->area = array(''=>"Selecione",1=>"Área de Gestão Estratégica",2=>"Área de Gestão de Pessoas",3=>"Área de Gestão Administrativa");
        $this->view->formacao = array(''=>"Selecione",1=>"Ensino Médio",2=>"Ensino Superior",3=>"Pos-Graduação");
        $this->view->funcao = array(''=>"Selecione",1=>"Estratégico",2=>"Tático-Estratégico",3=>"Operacional");
    }
    
    public function editarAction() {
        $colaboradorModel = new Application_Model_Colaborador();
               
        if($this->getParam("usuario_id")) {
            $colaborador["usuario_id"] = $this->getParam('usuario_id');
            $colaborador["cargo"] = $this->getParam('cargo');
            $colaborador["matricula"] = $this->getParam('matricula');
            $colaborador["area"] = $this->getParam('area');
            $colaborador["data_adm"] = $this->getParam('data_adm');
            $colaborador["data_dem"] = $this->getParam('data_dem');
            $colaborador["funcao"] = $this->getParam('funcao');
            $colaborador["formacao"] = $this->getParam('formacao');

            $where = "id = ".$this->getParam("id");
            $colaboradorModel->update($colaborador, $where);
            $this->view->mensagem = "Operação realizada com sucesso!";
        }
        $colaboradorModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $colaborador = $colaboradorModel->buscarPorId($this->getParam("id"));    
        
        $this->view->colaborador = $colaborador;
        $this->view->cargo = array(1=>"Analista",2=>"Assistente",3=>"Auxiliar");
        $this->view->area = array(1=>"Área de Gestão Estratégica",2=>"Área de Gestão de Pessoas",3=>"Área de Gestão Administrativa");
        $this->view->formacao = array(1=>"Ensino Médio",2=>"Ensino Superior",3=>"Pos-Graduação");
        $this->view->funcao = array(1=>"Estratégico",2=>"Tático-Estratégico",3=>"Operacional");
    }
    
    public function excluirAction() {
        $colaboradorModel = new Application_Model_Colaborador();
        $colaboradorModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $colaborador = $colaboradorModel->buscarPorId($this->getParam("id"));
        
        if($this->getParam("excluir")) {
            $where = "id = ".$this->getParam("id");
            $colaboradorModel->delete($where);
            $this->_redirect("/colaborador");
        }
        $this->view->colaborador = $colaborador;
    }
    
    public function verAction() {
        $colaboradorModel = new Application_Model_Colaborador();
        $colaboradorModel->getAdapter()->setFetchMode(Zend_Db::FETCH_ASSOC); 
        $colaborador = $colaboradorModel->buscarPorId($this->getParam("id"));
        
        $projetoModel = new Application_Model_Projeto();
        $projetos_concluidos = $projetoModel->todos(array(
            "colaborador" => $colaborador["id"],
            "status" => Application_Model_Projeto::STATUS_CONCLUIDO
        ));
        
        $projetos_andamento = $projetoModel->todos(array(
            "colaborador" => $colaborador["id"],
            "status" => Application_Model_Projeto::STATUS_ANDAMENTO
        ));
        
        $tarefaModel = new Application_Model_Tarefa();
        $tarefas_concluidos = $tarefaModel->todos(array(
            "colaborador" => $colaborador["id"],
            "status" => Application_Model_Projeto::STATUS_CONCLUIDO
        ));
        
        $tarefas_andamento = $tarefaModel->todos(array(
            "colaborador" => $colaborador["id"],
            "status" => Application_Model_Projeto::STATUS_ANDAMENTO
        ));
        
        $this->view->projetos_concluidos = $projetos_concluidos;
        $this->view->projetos_andamento = $projetos_andamento;
        $this->view->tarefas_concluidos = $tarefas_concluidos;
        $this->view->tarefas_andamento = $tarefas_andamento;
        $this->view->colaborador = $colaborador;
        $this->view->cargo = Application_Model_Colaborador::$cargos;
        $this->view->area = Application_Model_Colaborador::$area;
        $this->view->formacao = Application_Model_Colaborador::$formacao;
        $this->view->funcao = Application_Model_Colaborador::$funcao;                
       
    }

}
