$(document).ready(function() {
    var form = $("#frmAluno");

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

/*
alunoId (id)
alunoNome (nome)
alunoLoginMoodle (loginMoodle) 
escolaId (escola)
alunoMatricula (matricula)
alunoAtivo (ativo)
*/

    function submitForm() {
        // Initiate Variables With Form Content
        var id = $("#txtId").val();
        var nome = $("#txtNome").val();
        var loginMoodle = $("#txtLoginMoodle").val();
        var escola = $("#cmbEscola").find("option:selected").val();
        var matricula = $("#txtMatricula").val();
        var ativo = $("input[name='optAtivo']:checked").val();
        var email = $("#txtEmail").val();
        var ano = $("#txtAno").val();

        $.ajax({
            type: "POST",
            url: "exec/gravaraluno.php",
            data: "id=" + id + "&nome=" + nome + "&loginMoodle=" + loginMoodle + "&escola=" + escola + "&matricula=" + matricula + "&ativo=" + ativo + "&email=" + email + "&ano=" + ano,
            success : function(text) {
                var txtspl = text.split("|");

                if (txtspl[0] == "OK") {
                    var mensagem = $("#mensagem");
                    
                    if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                    if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                    mensagem.removeClass("d-none");
                    
                    mensagem.html("<i class=\"material-icons\">&#xE002;</i> O registro foi salvo!" +
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
            }
        });
    }

    $("#cmdVoltar").click(function() {
        location.href = "alunos.php";
    });
});