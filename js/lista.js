function criarObjetoColuna(titulo, valor, tipo, alinhamento)
{
    var objeto          = new Object();
    objeto.titulo       = titulo;
    objeto.valor        = valor;
    objeto.tipo         = tipo;
    objeto.alinhamento  = alinhamento;

    return objeto;
}

function carregarTabela(pagina, classe, colunas, cadastro, div)
{
    $(div).html("Carregando...");

    $.ajaxSetup({
        scriptCharset: "utf-8",
        cache: false
    });

    $.ajax({
        type: "POST",
        url: "exec/listarregistros.php",
        data: "pagina=" + pagina + "&classe=" + classe + "&colunas=" + colunas + "&cadastro=" + cadastro })
        .done(function(tabela) {
            $(div).html(tabela);
        })
        .fail(function(jqXHR, textStatus)
        {
            $(div).html("Erro: " + textStatus);
        });
}

function excluir(classe, metodo, ids, pagina, colunas, cadastro, div)
{
    executarModos("excluirregistros", "desativados", classe, metodo, ids, pagina, colunas, cadastro, div);
}

function reativar(classe, metodo, ids, pagina, colunas, cadastro, div)
{
    executarModos("reativarregistros", "reativados", classe, metodo, ids, pagina, colunas, cadastro, div);
}

function executarModos(execpagina, partemensagem, classe, metodo, ids, pagina, colunas, cadastro, div)
{
    $.ajax({
        type: "POST",
        url: "exec/" + execpagina + ".php",
        data: "classe=" + classe + "&metodo=" + metodo + "&ids=" + ids })
        .done(function(text) {
            if (text == "OK")
            {
                var mensagem = $("#mensagem");
                
                if (mensagem.hasClass("alert-danger")) mensagem.removeClass("alert-danger");
                if (!mensagem.hasClass("alert-success")) mensagem.addClass("alert-success");
                mensagem.removeClass("d-none");
                
                mensagem.html("<i class=\"material-icons\">&#xE002;</i> Os registros foram " + partemensagem + "!" +
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

            carregarTabela(pagina, classe, colunas, cadastro, div);
        });
}