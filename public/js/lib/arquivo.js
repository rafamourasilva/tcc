var Arquivo = function(){};

Arquivo.prototype.include = function(arquivo)
{
    var j = document.createElement("script"); /* criando um elemento script: </script><script></script> */
    j.type = "text/javascript"; /* informando o type como text/javacript: <script type="text/javascript"></script>*/
    j.src = baseUrl+'/js/'+arquivo; /* Inserindo um src com o valor do parâmetro file_path: <script type="javascript" src="+file_path+"></script>*/
    document.body.appendChild(j); /* Inserindo o seu elemento(no caso o j) como filho(child) do  BODY: <html><body><script type="javascript" src="+file_path+"></script></body></html> */
}

Arquivo.prototype.includeOnce = function(arquivo)
{
    var sc = document.getElementsByTagName("script");
    for (var x in sc)
        if (sc[x].src != null && sc[x].src.indexOf(arquivo) != -1) return;
    this.include(arquivo);
}



