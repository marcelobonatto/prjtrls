var classe          = "";
var metodoExcluir   = "";
var paginaCadastro  = "";
var paginacao       = false;

$(document).ready(function() {
    $("#cmdExcluir").click(function() {
        prepararVariasExclusoes(0);
    });

    $("#cmdReativar").click(function() {
        prepararVariasExclusoes(1);
    });
});

function criarObjetoColuna(titulo, valor, tipo, alinhamento)
{
    var objeto          = new Object();
    objeto.titulo       = titulo;
    objeto.valor        = valor;
    objeto.tipo         = tipo;
    objeto.alinhamento  = alinhamento;

    return objeto;
}

function carregarTabela(pagina)
{
    var div = "#lista";

    $(div).html("Carregando...");

    var colunas = configurarTabela();

    $.ajaxSetup({
        scriptCharset: "utf-8",
        cache: false
    });

    $.ajax({
        type: "POST",
        url: "exec/listarregistros.php",
        data: "pagina=" + pagina + "&classe=" + classe + "&colunas=" + colunas + "&cadastro=" + paginaCadastro + "&paginacao=" + paginacao })
        .done(function(tabela) {
            $(div).html(tabela);
        })
        .fail(function(jqXHR, textStatus)
        {
            $(div).html("Erro: " + textStatus);
        });
}

function prepararExclusao(id, modo)
{
    var ids = new Array(1);
    ids[0]  = configurarIds(id);

    executarModos(modo, JSON.stringify(ids), 1);
}

function prepararVariasExclusoes(modo)
{
    var ids = [];
    
    $("input[name='chkX[]']:checked").each(function () {
        ids.push(configurarIds(this.value));
    });

    executarModos(modo, JSON.stringify(ids), 1);
}

function configurarIds(id)
{
    var obj = new Object();
    obj.id  = id;
    return obj;
}

function executarModos(modo, ids, pagina)
{
    var parteMensagem = (modo == 0 ? "desativados" : "reativados");

    $.ajax({
        type: "POST",
        url: "exec/excluirregistros.php",
        data: "classe=" + classe + "&metodo=" + metodoExcluir + "&modo=" + modo + "&ids=" + ids })
        .done(function(text) {
            if (text == "OK")
            {
                var mensagem = $("#mensagem");
                
                if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                mensagem.removeClass("d-none");
                
                mensagem.html("<i class=\"material-icons\">&#xE002;</i> Os registros foram " + parteMensagem + "!" +
                                "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
            }
            else {
                var mensagem = $("#mensagem");

                if (mensagem.hasClass("alert-success")) mensagem.removeClass("alert-success");
                if (!mensagem.hasClass("alert-danger")) mensagem.addClass("alert-danger");
                mensagem.removeClass("d-none");

                mensagem.html("<i class=\"material-icons\">&#xE002;</i> " + text +
                                "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\"><span aria-hidden=\"true\">&times;</span></button>");
            }

            carregarTabela(pagina);
        });
}