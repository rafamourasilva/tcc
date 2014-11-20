<?php

class App_Model_Corrida extends App_Model_AbstractDomain
{

    protected $id;
    protected $cliente;
    protected $coletes;
    protected $funcionario;
    protected $numeroTelefone;
    protected $enderecoOrigem;
    protected $enderecoDestino;
    protected $valor;
    protected $status;
    
    const ST_PENDENTE = 'P';
    const ST_ATENDIDO = 'A';

    public function __construct( App_Model_Cliente $cliente
                               , $enderecoOrigem
                               , $enderecoDestino ) 
    {
        $this->cliente        = $cliente;
        $this->enderecoOrigem = $enderecoOrigem;
        $this->enderecoDestino= $enderecoDestino;        
    }

    public function retornarCliente()
    {
        return $this->cliente;
    }

    public function retornarTelefone()
    {
        return $this->numeroTelefone;
    }

    public function informarTelefone( $telefone )
    {
        $this->numeroTelefone = $telefone;
    }

    public function retornarEnderecoOrigem()
    {
        return $this->enderecoOrigem;
    }

    public function retornarEnderecoDestino()
    {
        return $this->enderecoDestino;
    }

    public function informarEnderecoDestino( $enderecoDestino )
    {
        $this->enderecoDestino = $enderecoDestino;
    }
    
    public function informarEnderecoOrigem( $enderecoOrigem ){
        $this->enderecoOrigem = $enderecoOrigem;
    }

    public function retornarValor()
    {
        return $this->valor;
    }

    public function informarValor( $valor )
    {
        $this->valor = (float) str_replace(',', '.', $valor);
    }

    public function retornarStatus()
    {
        return $this->status;
    }

    public function informarStatus( $status )
    {
        $this->status = $status;
    }
    
    public function retornarFuncionario()
    {        
        if(empty($this->funcionario)&&!empty($this->id))
        {               
            $rFuncionario      = new App_Model_Repository_Funcionario();
            $this->funcionario = $rFuncionario->recuperarPorCorrida($this->id);
        }
        return $this->funcionario;
    }
    
    public function informarFuncionario(App_Model_Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }
    
    public function adicionarColete(App_Model_Colete $colete)
    {
        $this->coletes[] = $colete;
    }  
    
    public function retornarColetes()
    {
        if(!$this->coletes)
        {
            $rColete = new App_Model_Repository_Corrida();
            $this->coletes = $rColete->recuperarColetesCorrida( $this->id );
        }
        return $this->coletes;
    }
    
    public function validar()
    {
        $this->cliente->validar();       
        if( $this->funcionario )
        {
            $this->funcionario->validar();
        }
        
        if(!$this->enderecoOrigem)
        {
            $this->erros[] = "Favor informar Endereço de Origem<br>";
        }
        
        if(!$this->enderecoDestino)
        {
            $this->erros[] = "Favor informar Endereço de Destino<br>";
        }
        
        if(!empty($this->coletes))
        {
            foreach($this->coletes as $colete)
            {
                $colete->validar();
            }
        }
        parent::validar();
    }

}