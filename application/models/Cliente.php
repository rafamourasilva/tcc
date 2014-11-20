<?php

class App_Model_Cliente extends App_Model_AbstractDomain
{

    CONST TP_FISICO   = 'F';
    CONST TP_JURIDICO = 'J';

    protected $id;
    protected $pessoa;
    protected $endereco;
    protected $telefones;
    protected $corrida;
    protected $status;

    /**
     *
     * @param string $nome 
     */
    public function __construct( App_Model_Pessoa $pessoa )
    {
        if ( empty( $pessoa ) )
        {
            $this->erros[ ] = "Falta pessoa";
        }

        $this->pessoa = $pessoa;
    }

    /**
     *
     * @param App_Model_Endereco $endereco 
     */
    public function informarEndereco( App_Model_Endereco $endereco )
    {
        $this->endereco = $endereco;
    }

    public function informarStatus( $st_cliente )
    {
        $this->status = $st_cliente;
    }

    public function retornarStatus()
    {
        return $this->status;
    }

    /**
     *
     * @return App_Model_Endereco
     */
    public function retornarEndereco()
    {
        if ( !$this->endereco )
        {
            $mEndereco = new App_Model_Repository_Cliente();
            $this->endereco = $mEndereco->recuperarEnderecoCliente( $this->id );
        }
        return $this->endereco;
    }

    /**
     *
     * @param App_Model_Telefone $telefone 
     */
    public function adicionarTelefone( App_Model_Telefone $telefone )
    {
        $this->telefones[ ] = $telefone;
    }

    public function retornarTelefones( $idTelefone = null )
    {
        if ( !$this->telefones )
        {
            $rCliente = new App_Model_Repository_Cliente();
            $this->telefones = $rCliente->recuperarTelefones( $this );
        }
        return !is_null( $idTelefone ) ? $this->telefones[ $idTelefone ] : $this->telefones;
    }

    /**
     *
     * @return App_Model_Pessoa 
     */
    public function retornarPessoa()
    {
        return $this->pessoa;
    }

    public function validar()
    {
        $this->pessoa->validar();
        parent::validar();
    }

}