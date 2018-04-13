var pagina  = "";
var form;
var exec    = "";
var dados   = "";

$(document).ready(function() {
    form.submit(function(event) {
        var ehValido = form[0].checkValidity();
    
        // cancels the form submission
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
        $.ajax({
            type: "POST",
            url: "exec/" + exec + ".php",
            data: dados,
            success : function(text) {
                var txtspl = text.split("|");

                if (txtspl[0] == "OK") {
                    var mensagem = $("#mensagem");
                    
                    if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                    if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                    mensagem.removeClass("d-none");
                    
                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> O registro foi salvo!" +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");

                    $("#txtid").val(txtspl[1]);
                }
                else {
                    var mensagem = $("#mensagem");

                    if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                    if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");
                    mensagem.removeClass("d-none");

                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> " + text +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
            }
        });
    }

    $("#cmdVoltar").click(function() {
        location.href = pagina;
    });
});