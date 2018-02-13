$(document).ready(function() {
    classe          = "lib\\escola";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "escola";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(5);
    colunas[0]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Bairro", "bairro", "texto", "left");
    colunas[2]      = criarObjetoColuna("Cidade", "cidadenome", "texto", "center");
    colunas[3]      = criarObjetoColuna("Estado", "estado", "texto", "center");
    colunas[4]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}