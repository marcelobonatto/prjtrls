$(document).ready(function() {
    var form = $("#needs_validation");

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

    $("#voltar").click(function() {
        location.href = "index.php";
    });

    function submitForm(){
        // Initiate Variables With Form Content
        var email       = $("#email").val();
        
        $("#enviar").prop("disabled", true);
        $("#enviar").text("Enviando...");
        $("#voltar").prop("disabled", true);
    
        $.ajax({
            type: "POST",
            url: "exec/gerarnovasenha.php",
            data: "email=" + email,
            success : function(text) {
                var mensagem = $("#mensagem");

                mensagem.removeClass("d-none");

                if (text == "OK") {
                    if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                    if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
            
                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> Foi enviado um e-mail com um link para modificar a senha." +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
                else {
                    var mensagem = $("#mensagem");

                    if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                    if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");

                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> Não foi possível enviar o e-mail com o link para mudar a senha.<br />" + text +
                                  "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
                }
            },
            complete: function() {
                $("#enviar").prop("disabled", false);
                $("#enviar").text("Enviar");
                $("#voltar").prop("disabled", false);
            }
        });
    }
});