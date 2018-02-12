$(document).ready(function() {
    var form = $("#frmEscola");

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
        // Initiate Variables With Form Content
        var id = $("#txtId").val();
        var nome = $("#txtNome").val();
        var bairro = $("#txtBairro").val();
        var estado = $("#cmbEstado").find("option:selected").val();
        var cidade = $("#cmbCidade").find("option:selected").val();
        var ativo = $("input[name='optAtivo']:checked").val();

        $.ajax({
            type: "POST",
            url: "exec/gravarescola.php",
            data: "id=" + id + "&nome=" + nome + "&bairro=" + bairro + "&estado=" + estado + "&cidade=" + cidade + "&ativo=" + ativo,
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

    $("#cmbEstado").on('change', function() {
        $("#cmbCidade").empty();
        $("#cmbCidade").append(new Option("(Selecione)", "*"));

        estado = $(this).val();

        $.getJSON("exec/lercidades.php", { estado: estado })
            .done(function(data) {
                $.each(data, function(index, item) {
                    $("#cmbCidade").append(new Option(item.nome, item.id));
                });
            });
    });

    $("#cmdVoltar").click(function() {
        location.href = "escolas.php";
    });
});