<?php

/**
 * Gera o input para cpf
 * @author Felipe
 */
class Zend_View_Helper_ListarCorridas
{

    /**
     *
     * @param string $cpf
     * @return Zend_View_Helper_FormText 
     */
    public function listarCorridas( $corridas )
    {
        $tabela = '<table class="table table-bordered table-striped">    
                    <tr>
                        <th style="width: 20%">Cliente</th>
                        <th style="width: 5%">Telefone</th>            
                        <th style="width: 30%">Endereço Origem</th>
                        <th style="width: 30%">Endereço Destino</th>
                        <th style="width: 5%">Valor</th>
                        <th style="width: 10%">Colete(s)</th>
                    </tr>';

        foreach ( $corridas as $corrida )
        {
            $coleteSelecionado   = $corrida->retornarColetes();
            $coletesRelacionados = "";
            foreach ( $coleteSelecionado as $colete )
            {
                $coletesRelacionados .= "(" . $colete->retornarNumeroColete() . ")";
            }
            
            $cor = $corrida->retornarStatus() === App_Model_Corrida::ST_PENDENTE ? "yellow" : "";
            
            $coletesRelacionados = ($corrida->retornarStatus() == App_Model_Corrida::ST_PENDENTE
                                    ? "<a id=" . $corrida->retornarId() . " href='#coletes' 
                                       class='btn btn-primary btn-large iniciar'>Iniciar</a>"
                                    : $coletesRelacionados);
            $tabela .= "<tr id='corrida_" . $corrida->retornarId() . "' style='background: ".$cor."'>
                            <td>" . $corrida->retornarCliente()->retornarPessoa()->retornarNome() . "</td>
                            <td>" . Central_Util::formatarTelefone('',$corrida->retornarTelefone()) . "</td>                    
                            <td>" . $corrida->retornarEnderecoOrigem() . "</td>
                            <td>" . $corrida->retornarEnderecoDestino() . "</td>
                            <td>" . $corrida->retornarValor() . "</td>
                            <td style='text-align:center'>" . $coletesRelacionados . "</td>                    
                        </tr>";
        }
        $tabela .= "</table>";
        return $tabela;
    }

}