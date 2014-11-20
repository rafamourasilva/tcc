<?php

/**
 * Classe abstrata de serviço
 *
 * @author Felipe
 */
abstract class App_Model_Service_Abstract
{
    /**
     * define qual metodo deve ser executado
     * @var string
     */
    protected $acao;           
    
    /**
     * Construtor
     * @param array $data 
     */
    public function __construct()
    {        
    }
    
    /**
     * Executa o servico desejado
     * @param string $acao
     * @return Central_Mensageiro 
     */
    static public function executar( $acao )
    {        
        try
        {           
            $retorno = $acao();            
            if( empty( $retorno ) )
            {
                $retorno = "Operação realizada com sucesso!";
            }
            return new Central_Mensageiro( Central_Mensageiro::SUCESSO, $retorno );
        }
        catch( App_Model_Exception $em )
        {
            $strErro = $em->getMessage();
        }
        catch( App_Model_Map_Exception $ema )
        {
            $strErro = $ema->getMessage();
        }
        catch( App_Model_Repository_Exception $er )
        {
            $strErro = $er->getMessage();
        }
        
        return new Central_Mensageiro( Central_Mensageiro::ERRO, $strErro );
    }        
    
    /**
     * Executa um servico dentro de uma transacao
     * @param string $acao
     * @return Central_Mensageiro 
     */
    static public function executarTransacao( Central_Application_Model_Transacao $transacao, $acao )
    {

        $transacao->begin();
        
        $mensageiro = self::executar( $acao );
        
        if( $mensageiro->recuperarSituacao() === Central_Mensageiro::SUCESSO )
        {
            $transacao->commit();
            return $mensageiro;
        }               
        
        $transacao->rollback();        
        return $mensageiro;
    }            
}
