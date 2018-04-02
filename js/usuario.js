$(document).ready(function() {
    var form = $("#frmUsuario");

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
        var id = $("#txtId").val();
        var nome = $("#txtNome").val();
        var email = $("#txtEmail").val();
        var ativo = $("input[name='optAtivo']:checked").val();

        $("#cmdGravar").prop("disabled", true);
        $("#cmdGravar").text("Gravando...");

        $.ajax({
            type: "POST",
            url: "exec/gravarusuario.php",
            data: "id=" + id + "&nome=" + nome + "&email=" + email + "&ativo=" + ativo,
            success : function(text) {
                var txtspl = text.split("|");

                if (txtspl[0] == "OK") {
                    var mensagem = $("#mensagem");
                    
                    if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                    if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                    mensagem.removeClass("d-none");
                    
                    var textomsg = "O registro foi salvo";

                    if (txtspl[2] != "")
                    {
                        textomsg += ", mas teve um problema: " + textspl[2];
                    }
                    else
                    {
                        textomsg += "!";
                    }

                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> " + textomsg +
                                    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");

                    $("#txtId").val(txtspl[1]);
                }
                else {
                    var mensagem = $("#mensagem");

                    if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                    if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");
                    mensagem.removeClass("d-none");

                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> " + text +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
            },
            complete: function() {
                $("#cmdGravar").prop("disabled", false);
                $("#cmdGravar").text("Gravar");
            }
        });
    }

    $("#cmdVoltar").click(function() {
        location.href = "usuarios.php";
    });

    $("#enviarEmail").click(function() {
        var email = $("#txtEmail").val();

        $("#enviarEmail").prop("disabled", true);
        $("#enviarEmail").text("Enviando...");

        $.ajax({
            type: "POST",
            url: "exec/enviarnovasenha.php",
            data: "email=" + email,
            success : function(text) {
                if (text == "OK") {
                    var mensagem = $("#mensagem");
                    
                    if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                    if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                    mensagem.removeClass("d-none");
                    
                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> Um e-mail foi enviado para o usu&aacute;rio!" +
                                    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
                else {
                    var mensagem = $("#mensagem");

                    if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                    if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");
                    mensagem.removeClass("d-none");

                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> Não foi possível enviar o e-mail para o usu&aacute;rio." + 
                                    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
            },
            complete: function() {
                $("#enviarEmail").prop("disabled", false);
                $("#enviarEmail").text("Enviar e-mail para troca de senha");
            }
        });
    });
});