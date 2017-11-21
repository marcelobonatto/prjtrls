$(document).ready(function() {
    var json;

    $.ajax({
        url: 'exec/lernpcs.php',
        success: function (result) {
            json    = result;
        }
    });

    $("#divOptObrig label").click(function() {
        if (this.id == "lblObrNao")
        {
            $("#cmbMissoes").prop("disabled", false);
            $("#cmbMissoes").prop("required", true);
        }
        else
        {
            $("#cmbMissoes").prop("disabled", true);
            $("#cmbMissoes").prop("required", false);
        }
    });

    $("#cmdIncluirFala").click(function() {
        var total = $("#tbFalas tbody tr").length;

        html    = "<tr>\n" +
                  "\t<td>\n" +
                  "\t\t<input type=\"number\" id=\"txtSequencia" + total + "\" name=\"txtSequencia[]\" value=\"" + total +"\" min=\"1\" max=\"99\" class=\"text-right\" />\n" +
                  "\t</td>\n" +
                  "\t<td>\n" +
                  "\t\t<select id=\"cmbNPC" + total + "\" name=\"cmbNPC[]\">\n";

        for (i = 0; i < json.length; i++)
        {
            npc = json[i];
            html += "\t\t\t<option value=\"" + npc.id + "\">[" + npc.eixoSigla + "] " + npc.nome + "</option>\n";
        }

        html    += "\t\t</select>\n" +
                   "\t</td>\n" + 
                   "\t<td>\n" + 
                   "\t\t<select id=\"cmbHumor" + total + "\" name=\"cmbHumor[]\">\n" + 
                   "\t\t\t<option value=\"NO\">Normal</option>\n" + 
                   "\t\t\t<option value=\"AL\">Alegre</option>\n" + 
                   "\t\t\t<option value=\"EU\">Eufórico</option>\n" + 
                   "\t\t\t<option value=\"TR\">Triste</option>\n" + 
                   "\t\t\t<option value=\"CH\">Chorando</option>\n" + 
                   "\t\t\t<option value=\"IR\">Irritado</option>\n" + 
                   "\t\t\t<option value=\"ZA\">Zangado</option>\n" + 
                   "\t\t\t<option value=\"TQ\">Tranquilo</option>\n" + 
                   "\t\t</select>\n" + 
                   "\t</td>\n" + 
                   "\t<td>\n" + 
                   "\t\t<textarea id=\"txtFala" + total + "\" name=\"txtFala[]\" rows=\"3\" maxlength=\"8000\" style=\"width: 100%\"></textarea>\n" + 
                   "\t</td>\n" + 
                   "\t<td>\n" + 
                   "\t\t<button id=\"cmdRemover" + total + "\" class=\"btn btn-link text-danger\" title=\"Remover\"><i class=\"material-icons\">&#xE15C;</i></button>&nbsp;&nbsp;\n" + 
                   "\t\t<a href=\"#\" class=\"text-primary\" title=\"Mover para Cima\"><i class=\"material-icons\">&#xE5D8;</i></a>&nbsp;&nbsp;\n" + 
                   "\t\t<a href=\"#\" class=\"text-primary\" title=\"Mover para Baixo\"><i class=\"material-icons\">&#xE5DB;</i></a>\n" + 
                   "\t</td>\n" + 
                   "</tr>\n";

        $("#tbFalas tr:last").before(html);

        $("#cmdRemover" + total).on('click', function() {
            removerFala($(this));
        });
    });

    $("button[id^='cmdRemover']").on('click', function() {
        removerFala($(this));
    });

    function removerFala(obj)
    {
        obj.parent().parent().remove();
    }

    form    = $("#frmMissao");

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

            //submitForm();
        }
    });
});