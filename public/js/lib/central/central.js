/**
 *@namespace Central
 */
Central = {
    baseUrl : '',
    baseImg : ''
};


/**
 *  Resolve toda requisicao ao servidor com ajax
 */
Central.ajax         = {};
Central.ajax.SUCESSO = 'ok';

Central.ajax.post = function( action, param, callback )
{        
    $.post( Central.baseUrl + action, param, function(response)
    {
        if( Central.ajax.SUCESSO != response.situacao )
        {
            jAlert(response.retorno, "Alerta");
            return;
        }
        callback(response);
    },'json');
};

Central.ajax.get = function( action, param, callback )
{
    $.get( Central.baseUrl + action, param, function(response)
    {
        if( Central.ajax.SUCESSO != response.situacao )
        {
            jAlert( response.retorno, "Erro de aplicação" );
            return;
        }
        callback(response);
    },'json');
};

Central.ajax.load = function( container, url, params )
{
    $( container ).load( Central.baseUrl + url, params );
};

/**
 * modelo da app
 */
Central.model = function( options )
{
    var defaultOptions = {
        ajax: Central.ajax
    },props;
    
    if( typeof(options) === "undefined" ){
        options = defaultOptions;
    }else{
        for( props in defaultOptions ){
            if( defaultOptions.hasOwnProperty( props ) )
            {
                if( !options[ props ] )
                {
                    options[ props ] = defaultOptions[ props ];
                }
            }
        }
    }
    

    this.options = options;
};

/**
 * Controle da app
 */
Central.controller = function(){};

Central.controller.prototype.redirect = function(url)
{
    window.location.href = Central.baseUrl + url;
};

Central.controller.prototype.reload = function()
{
   window.location.reload();    
};

/**
 * Tratamento de arquivo
 */
Central.helper = function(){};

Central.helper.prototype.include = function(arquivo)
{
    var j = document.createElement("script"); /* criando um elemento script: </script><script></script> */
    j.type = "text/javascript"; /* informando o type como text/javacript: <script type="text/javascript"></script>*/
    j.src = baseUrl+'/js/'+arquivo; /* Inserindo um src com o valor do parâmetro file_path: <script type="javascript" src="+file_path+"></script>*/
    document.body.appendChild(j); /* Inserindo o seu elemento(no caso o j) como filho(child) do  BODY: <html><body><script type="javascript" src="+file_path+"></script></body></html> */
};

Central.helper.prototype.includeOnce = function(arquivo)
{
    var sc = document.getElementsByTagName("script");
    for (var x in sc)
        if (sc[x].src != null && sc[x].src.indexOf(arquivo) != -1) return;
    this.include(arquivo);
};