<?php

/**
 * @abstract
 * @name App_Model_Funcionario
 * @author Felipe 
 */
abstract class App_Model_Funcionario extends App_Model_AbstractDomain
{

    protected $id_funcionario;
    protected $pessoa;
    protected $telefones;
    protected $endereco;
    protected $tp_funcionario;
    protected $st_funcionario;

    public function __construct( App_Model_Pessoa $pessoa, $tipo )
    {
        if( $tipo == '' )
        {
            $this->erros[] = 'Informar o tipo de funcíonário';
        }
        $this->tp_funcionario   = substr( $tipo, 0, 1 );
        $this->pessoa           = $pessoa;
    }

    /**
     * @param App_Model_Pessoa $pessoa
     * @param string $tipo 
     * @return App_Model_Funcionario
     */
    static public function factory( App_Model_Pessoa $pessoa, $tipo )
    {
        switch ( $tipo )
        {
            case App_Model_Motoboy::TP_FUNCIONARIO:
                return new App_Model_Motoboy( $pessoa, $tipo );
                break;
            default:
                throw new App_Model_Exception( array('Tipo de funcionario inválido!') );
                break;
        }
    }

    public function retornarId()
    {
        return $this->id_funcionario;
    }

    public function informarId( $id )
    {
        $this->id_funcionario = (int) $id;
    }

    /**
     *
     * @param App_Model_Endereco $endereco 
     */
    public function informarEndereco( App_Model_Endereco $endereco )
    {
        $this->endereco = $endereco;
    }

    /**
     *
     * @param App_Model_Telefone $telefone 
     */
    public function adicionarTelefone( App_Model_Telefone $telefone )
    {                
        if( $telefone->retornarId() > 0 )
        {
            $this->telefones[] = $telefone;
            return;
        }
        
        $this->telefones[] = $telefone;
    }

    public function retornarPessoa()
    {
        return $this->pessoa;
    }

    /**
     *
     * @param App_Model_Pessoa $pessoa 
     */
    public function informarPessoa( App_Model_Pessoa $pessoa )
    {
        $this->pessoa = $pessoa;
    }

    public function informarStatus( $status )
    {
        $this->st_funcionario = $status;
    }

    public function retornarStatus()
    {
        return $this->st_funcionario;
    }

    public function retornarEndereco()
    {
        if(!$this->endereco)
        {
            $rMotoboy = new App_Model_Repository_Motoboy();
            $this->endereco = $rMotoboy->recuperarEndereco($this);
        }
        return $this->endereco;
    }

    public function retornarTipo()
    {
        return $this->tp_funcionario;
    }

    public function retornarTelefones( $idTelefone = null )
    {
        if(!$this->telefones)
        {            
            $rMotoboy = new App_Model_Repository_Motoboy();
            $this->telefones = $rMotoboy->recuperarTelefones($this);
        }
        return !is_null($idTelefone) ? $this->telefones[$idTelefone] : $this->telefones;
    }
    
    public function validar()
    {
        $this->pessoa->validar();
        if( !empty($this->endereco) )
        {
            $this->endereco->validar();    
        }        
        foreach($this->telefones as $telefone)
        {
            $telefone->validar();
        }
    }

}