var ColeteController = function(){};

ColeteController.prototype = new Controller();

ColeteController.prototype.iniciarEventosFormulario = function()
{
    var $this = this;
    $(".colete-voltar").click(function() {
        $this.voltarLista();
    });   
}

ColeteController.prototype.voltarLista = function()
{    
    this.redirect("/colete/listar");
};
