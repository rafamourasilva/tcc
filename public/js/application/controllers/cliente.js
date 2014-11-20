var ClienteController = function(){};

ClienteController.prototype = new Controller();

ClienteController.prototype.iniciarEventosFormulario = function()
{
    var $this = this;
    $(".cliente-voltar").click(function() {
        $this.voltarLista();
    });   
}

ClienteController.prototype.voltarLista = function()
{    
    this.redirect("/cliente/listar");
};
