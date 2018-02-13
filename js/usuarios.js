$(document).ready(function() {
    classe          = "lib\\usuario";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "usuario";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(2);
    colunas[0]      = criarObjetoColuna("Usuário", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}