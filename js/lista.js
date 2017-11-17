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
    $.ajaxSetup({
        scriptCharset: "utf-8",
        cache: false
    });

    $.ajax({
        type: "POST",
        url: "exec/listarregistros.php",
        data: "pagina=" + pagina + "&classe=" + classe + "&colunas=" + colunas + "&cadastro=" + cadastro,
        success : function(tabela) {
            $(div).html(tabela);
        }
    });
}