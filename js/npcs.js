$(document).ready(function() {
    classe          = "lib\\npc";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "npc";

    carregarTabela(1);
});

function configurarTabela()
{
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Personagem", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Eixo", "eixoNome", "texto", "left");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}