var Atendimento    = function( coletes, corridas ){
    this.coletes    = coletes;
    this.corridas   = corridas;
    
    this.receberColetes(coletes);
    //this.receberCorrida(corridas);
};

Atendimento.prototype.receberCorrida    = function( corridas ) {    
//    var liCorrida = "";
    
    for ( var corrida in corridas)
    {
            console.log(corrida);
    }
//    jQuery.each( corridas, function(index, corrida) {
//        liCorrida += '<li>' + corrida + '</li>';
//    } );
//    $('#corridas').append(liCorrida);
};

Atendimento.prototype.receberColetes    = function( coletes ) 
{
    var liColete = document.createElement('li');
    
     for ( var index in coletes)
     {
         liColete += '<li>' + coletes[index]['numeroColete'] + '</li>';
      }
    
//    jQuery.each( coletes, function(i,e)
//    {
//        liColete += '<li>' + e.numeroColete + '</li>';
//    });
//    
        document.getElementById('coletes').appendChild( liColete );
    return true;
};
