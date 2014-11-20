var MotoboyController = function(){};

MotoboyController.prototype = new Controller();

MotoboyController.prototype.iniciarEventosFormulario = function()
{
    var $this = this;
    $(".motoboy-voltar").click(function() {
        $this.voltarLista();
    });   
}

MotoboyController.prototype.voltarLista = function()
{    
    this.redirect("/motoboy/listar");
};
