$(document).ready(function() {
    var colj = configurarTabela();
    carregarTabela(1, "lib\\eixo",  colj, "eixo", "#lista");
});

function configurarTabela()
{
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Sequência", "sequencia", "texto", "left");
    colunas[1]      = criarObjetoColuna("Eixo", "nome", "texto", "left");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);
    
    return colj;
}

function prepararExclusao(id, modo)
{
    var ids = new Array(1);
    var obj = new Object();
    obj.id  = id;
    ids[0]  = obj;

    var colj = configurarTabela();

    if (modo == 0)
    {
        excluir("lib\\eixo", "Excluir", JSON.stringify(ids), 1, colj, "eixo", "#lista");
    }
    else
    {
        reativar("lib\\eixo", "Reativar", JSON.stringify(ids), 1, colj, "eixo", "#lista");
    }
}