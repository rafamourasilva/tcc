Atendimento = function(){
    Central.model.apply( this );
};

Atendimento.prototype = new Central.model();

Atendimento.prototype.iniciarCorrida  = function( param, callback )
{
    return Central.ajax.post(
        '/corrida/iniciar', 
        param, 
        callback
    );
};


