$(document).ready(function() {
    classe          = "lib\\cidade";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "cidade";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(4);
    colunas[0]      = criarObjetoColuna("Código", "id", "texto", "left");
    colunas[1]      = criarObjetoColuna("Nome", "nome", "texto", "center");
    colunas[2]      = criarObjetoColuna("Estado", "estado", "texto", "left");
    colunas[3]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}