$(document).ready(function() {
    classe          = "lib\\grupo";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "grupo";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(2);
    colunas[0]      = criarObjetoColuna("Grupos de Usuários", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}