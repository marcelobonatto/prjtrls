var pagina  = "";
var form;
var exec    = "";
var dados   = "";
var json    = [];

$(document).ready(function() {
    form.submit(function(event) {
        var ehValido = form[0].checkValidity();
    
        event.preventDefault();
    
        if (ehValido)
        {
            var mensagem = $("#mensagem");
    
            if (!mensagem.hasClass("d-none"))
            {
                mensagem.addClass("d-none");
            }
    
            submitForm();
        }
    });

    function submitForm() {
        var mensagem    = $("#mensagem");
        var dados       = "";

        json.forEach(function(valor, chave) {
            var vl  = "";

            switch (valor.tipo)
            {
                case "texto":
                    vl  = $(valor.controle).val();
                    break;
                case "combo":
                    vl  = $(valor.controle).val();
                    break;
                case "ativo":
                    vl  = $("input[name='" + valor.controle + "']:checked").val();
                    break;
                case "opnovo":
                    vl  = ($(valor.controle).val() == "novo" ? 1 : 0);
                    break;
            }

            dados   += (dados != "" ? "&" : "") + valor.campo + "=" + vl;
        });

        $.ajax({
                    type: "POST",
                    url: "exec/" + exec + ".php",
                    data: dados
                })
            .done(function(text) {
                var txtspl = text.split("|");

                if (txtspl[0] == "OK") {
                    if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                    if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                    mensagem.removeClass("d-none");
                    
                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> O registro foi salvo!" +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");

                    $("#txtid").val(txtspl[1]);
                }
                else {
                    if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                    if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");
                    mensagem.removeClass("d-none");

                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> " + text +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown)
            {
                if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");
                mensagem.removeClass("d-none");

                mensagem.html("Erro: " + textStatus);
            });
    }

    $("#cmdVoltar").click(function() {
        location.href = pagina;
    });
});