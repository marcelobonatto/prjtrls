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

        var seq = $("input[id^='txtSequencia']:last").val();
        
        if (seq != null)
        {
            seq++;
        }
        else
        {
            seq = total;
        }

        html    = "<tr>\n" +
                  "\t<td>\n" +
                  "\t\t<input type=\"number\" id=\"txtSequencia" + total + "\" value=\"" + total +"\" min=\"1\" max=\"99\" class=\"text-right\" readonly=\"readonly\" />\n" +
                  "\t\t<input type=\"hidden\" id=\"hidIdFala" + total + "\" value=\"\" />\n" +                  
                  "\t</td>\n" +
                  "\t<td>\n" +
                  "\t\t<select id=\"cmbNPC" + total + "\">\n";

        for (i = 0; i < json.length; i++)
        {
            npc = json[i];
            html += "\t\t\t<option value=\"" + npc.id + "\">[" + npc.eixoSigla + "] " + npc.nome + "</option>\n";
        }

        html    += "\t\t</select>\n" +
                   "\t</td>\n" + 
                   "\t<td>\n" + 
                   "\t\t<select id=\"cmbHumor" + total + "\">\n" + 
                   "\t\t\t<option value=\"NO\">Normal</option>\n" + 
                   "\t\t\t<option value=\"RI\">Rindo</option>\n" +  
                   "\t\t\t<option value=\"TR\">Triste</option>\n" + 
                   "\t\t\t<option value=\"ZA\">Zangado</option>\n" + 
                   "\t\t</select>\n" + 
                   "\t</td>\n" + 
                   "\t<td>\n" + 
                   "\t\t<textarea id=\"txtFala" + total + "\" rows=\"3\" maxlength=\"8000\" style=\"width: 100%\"></textarea>\n" + 
                   "\t</td>\n" + 
                   "\t<td>\n" + 
                   "\t\t<button type=\"button\" id=\"cmdRemover" + total + "\" class=\"btn btn-link text-danger\" title=\"Remover\"><i class=\"material-icons\">&#xE15C;</i></button>&nbsp;&nbsp;\n" + 
                   "\t\t<button type=\"button\" id=\"cmdCima" + total + "\" class=\"btn btn-link text-primary\" title=\"Mover para Cima\"><i class=\"material-icons\">&#xE5D8;</i></button>&nbsp;&nbsp;\n" +
                   "\t\t<button type=\"button\" id=\"cmdBaixo" + total + "\"  class=\"btn btn-link text-primary\" title=\"Mover para Baixo\"><i class=\"material-icons\">&#xE5DB;</i></button>\n" +
                   "\t</td>\n" + 
                   "</tr>\n";

        $("#tbFalas tr:last").before(html);

        $("#cmdRemover" + total).on("click", function() {
            removerFala($(this));
        });

        $("#cmdCima" + total).on('click', function() {
            trocarConteudo($(this), "C");
        });

        $("#cmdBaixo" + total).on("click", function() {
            trocarConteudo($(this), "B");
        });
    });

    $("button[id^='cmdRemover']").on("click", function() {
        removerFala($(this));
    });

    function removerFala(obj)
    {
        var pos = obj.attr('id').replace("cmdRemover", "");
        var seq = $("#txtSequencia" + pos).val();

        obj.parent().parent().remove();

        var elements    = document.querySelectorAll('input[id^="txtSequencia"]');
        var txtseqarr   = new Array();

        for (i = 0; i < elements.length; i++)
        {
            if (elements[i].id.indexOf("txtSequencia") > -1)
            {
                var posid = elements[i].id.replace("txtSequencia", "");
                
                if (posid > pos)
                {
                    txtseqarr.push(elements[i].id);
                }
            }
        }

        txtseqarr.sort();

        for (i = 0; i < txtseqarr.length; i++)
        {
            $("#" + txtseqarr[i]).val(seq);
            seq++;
            pos++;
        }
    }

    $("button[id^='cmdCima']").on("click", function() {
        trocarConteudo($(this), "C");
    });

    $("button[id^='cmdBaixo']").on("click", function() {
        trocarConteudo($(this), "B");
    });

    function trocarConteudo(obj, direcao)
    {
        var pu      = (direcao == "C" ? "first" : "last");
        var idgen   = (direcao == "C" ? "cmdCima" : "cmdBaixo");
        var objpu   = $("button[id^='" + idgen + "']:" + pu).attr("id");
        var este    = obj.attr("id");
        
        if (objpu != este)
        {
            var poseste = este.replace(idgen, "");

            var idoutro = "";
            var tr      = obj.closest("tr");
            
            if (direcao == "C")
            {
                idoutro = tr.prev().find("button[id^='" + idgen +"']").attr("id");
            }
            else
            {
                idoutro = tr.nextAll().find("button[id^='" + idgen +"']").attr("id");
            }

            var posoutro    = idoutro.replace(idgen, "");
            
            var id      = $("#hidIdFala" + posoutro).val();
            var npc     = $("#cmbNPC" + posoutro).val();
            var humor   = $("#cmbHumor" + posoutro).val();
            var fala    = $("#txtFala" + posoutro).val();

            $("#hidIdFala" + posoutro).val($("#hidIdFala" + poseste).val());
            $("#cmbNPC" + posoutro).val($("#cmbNPC" + poseste).val());
            $("#cmbHumor" + posoutro).val($("#cmbHumor" + poseste).val());
            $("#txtFala" + posoutro).val($("#txtFala" + poseste).val());

            $("#hidIdFala" + poseste).val(id);
            $("#cmbNPC" + poseste).val(npc);
            $("#cmbHumor" + poseste).val(humor);
            $("#txtFala" + poseste).val(fala);
        }
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

            submitForm();
        }
    });

    function submitForm() {
        // Initiate Variables With Form Content
        var id = $("#txtId").val();
        var nome = $("#txtNome").val();
        var titulo = $("#txtTitulo").val();
        var descricao = $("#txtDescricao").val();
        var ano = $("#txtAno").val();
        var semestre = $("#txtSemestre").val();
        var sequencia = $("#txtSequencia").val();
        var moodle = $("#cmbMoodle").find("option:selected").val();
        var obrigatorio = $("input[name='optObrigatoria']:checked").val();
        var pai = $("#cmbMissoes").find("option:selected").val();
        var ativo = $("input[name='optAtivo']:checked").val();
        var datade = $("#txtDateDe").val();
        var olddatade = $("#hidDataDe").val();
        var dataate = $("#txtDateAte").val();
        var olddataate = $("#hidDateAte").val();
        var urlredir = $("#txtEndereco").val();

        var eixos = definirEixos();
        var falas = definirFalas();

        $.ajax({
            type: "POST",
            url: "exec/gravarmissao.php",
            data: { id: id, nome: nome, titulo: titulo, descricao: descricao, ano: ano,
                    semestre: semestre, sequencia: sequencia, moodle: moodle, obrigatorio: obrigatorio,
                    pai: pai, ativo: ativo, datade: datade, dataate: dataate, olddatade: olddatade, 
                    olddataate: olddataate, urlredir: urlredir, eixos: eixos, falas: falas },
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

    function definirEixos()
    {
        var eixos = new Array();
        
        $("[id^='hidId']").each(function(index) {
            var pontos      = 0;
            var valpontos   = $("#txtPontos" + index).val();
            var id          = $("#hidId" + index).val();
            var ideixo      = $("#hidEixo" + index).val();

            if (valpontos != null && valpontos.length > 0)
            {
                eixos.push(id + "|" + ideixo + "|" + valpontos);
            }
        });

        return eixos;
    }

    function definirFalas()
    {
        var falas = new Array();

        $("[id^='hidIdFala']").each(function(index) {
            var pos = this.id.replace("hidIdFala", "");

            var id      = $("#hidIdFala" + pos).val();
            var seq     = $("#txtSequencia" + pos).val();
            var npc     = $("#cmbNPC" + pos).val();
            var humor   = $("#cmbHumor" + pos).val();
            var fala    = $("#txtFala" + pos).val();

            if (seq.length > 0 && fala.length > 0)
            {
                falas.push(id + "|" + seq + "|" + npc + "|" + humor + "|" + fala);
            }
        });

        return falas;
    }

    $("#cmdVoltar").click(function() {
        location.href = "missoes.php";
    });
});