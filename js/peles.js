$(document).ready(function() {
    classe          = "lib\\pele";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "pele";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Cor", "cor", "cor", "center");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}