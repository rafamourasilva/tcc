var AtendimentoController = function(){ 
    Central.controller.apply( this );
};
AtendimentoController.prototype = new Central.controller();

AtendimentoController.prototype.iniciar = function()
{    
    var _this = this;    
    
    $('.iniciar').click(function(){        
        $('#lista_coletes_disponiveis').load('colete/recuperar-disponiveis/corrida/'+this.id);
        $("#coletes").modal('show');        
    });
    
    $( '.iniciarCorrida' ).die( 'click' ).live( 'click', function()
    {           
        _this.iniciarCorrida( $('#formColetesDisponiveis').serialize() );
    });
    
    //this.cometChamada();
}

AtendimentoController.prototype.iniciarCorrida = function( param )
{     
     var atendimento = new Atendimento(); 
     atendimento.iniciarCorrida( 
         param,
         function()
         {           
              new Central.controller().reload();             
         }            
     );              
     
}

AtendimentoController.prototype.cometChamada = function()
{    
    Central.ajax.get(
        '/atendimento/chamada', 
        {}, 
        function(json) 
        {
            if(json.status=='ok')
            {
                new Controller().redirect("/corrida/index/ddd/"+json.mensagem.ddd+"/numero/"+json.mensagem.telefone);
            }
            setTimeout('new AtendimentoController().cometChamada()',5000);        
        }
    );    
}