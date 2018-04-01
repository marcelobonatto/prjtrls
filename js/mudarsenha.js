$(document).ready(function() {
    var form = $("#needs_validation");

    form.submit(function(event) {
        var ehValido = form[0].checkValidity();

        // cancels the form submission
        event.preventDefault();

        if ($("#novasenha").val() != $("#repeticao").val())
        {
            var mensagem = $("#mensagem");

            mensagem.removeClass("d-none");

            mensagem.html("<i class=\"material-icons\">&#xE002;</i> A senha informada n&atilde;o &eacute; igual &agrave; repeti&ccedil;&atilde;o." +
                          "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");

            ehValido    = false;
        }

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

    $("#voltar").click(function() {
        location.href = "index.php";
    });

    function submitForm() {
        // Initiate Variables With Form Content
        var email   = $("#email").val();
        var nova    = $("#novasenha").val();
        var rep     = $("#repeticao").val();
        
        $("#novasenha").prop("disabled", true);
        $("#repeticao").prop("disabled", true);

        $("#enviar").prop("disabled", true);
        $("#enviar").text("Atualizando...");
        $("#voltar").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "exec/alterarnovasenha.php",
            data: "email=" + email + "&senha=" + nova
        })
        .done(function(text) {
            var mensagem = $("#mensagem");

            mensagem.removeClass("d-none");

            if (text == "OK") {
                if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
        
                mensagem.html("<i class=\"material-icons\">&#xE002;</i> Sua senha foi alterada." +
                            "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");

                $("#enviar").hide();
            }
            else {
                var mensagem = $("#mensagem");

                if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");

                mensagem.html("<i class=\"material-icons\">&#xE002;</i> Não foi possível alterar a sua senha.<br />" + text +
                            "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");

                nova.prop("disabled", false);
                rep.prop("disabled", façse);
            }
        })
        .always(function(data, textStatus, jqXHR) {
            $("#enviar").prop("disabled", false);
            $("#enviar").text("Enviar");
            $("#voltar").prop("disabled", false);
        });
    }
});