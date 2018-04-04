$(document).ready(function() {
    classe          = "lib\\estado";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "estado";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Sigla", "id", "texto", "left");
    colunas[1]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}