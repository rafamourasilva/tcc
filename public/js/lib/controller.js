var Controller = function()
{
    this.action   = "";
    this.param    = "";
    this.callback = function(){};
};

Controller.prototype.post = function()
{
    $.post( baseUrl + this.action, this.param, function(response)
    {
        if('ok'!=response.status)
        {
            jAlert(response.mensagem, "Alerta");
            return;
        }
        this.callback(response);
    },'json');
};

Controller.prototype.get = function()
{
    $.get( baseUrl + this.action, this.param, function(response)
    {
        if('ok'!=response.status)
        {
            jAlert(response.mensagem, "Alerta");
            return;
        }
        this.callback(response);
    },'json');
};

Controller.prototype.load = function(container)
{
    $(container).load(this.baseUrl,this.param);
};

Controller.prototype.redirect = function(url)
{
    window.location.href = baseUrl + url;
};

