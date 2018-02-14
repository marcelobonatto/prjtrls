$(document).ready(function() {
    classe          = "lib\\item";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "item";

    carregarTabela(1);

    $("#cmdImportar").on("click", function() {
        location.href = "itensimp.php";
    });
});

function configurarTabela()
{
    var colunas     = new Array(6);
    colunas[0]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Nível", "nivel", "texto", "center");
    colunas[2]      = criarObjetoColuna("Eixo", "eixoNome", "texto", "left");
    colunas[3]      = criarObjetoColuna("Bonus (%)", "bonus", "texto", "center");
    colunas[4]      = criarObjetoColuna("Preço", "preconormal", "texto", "right");
    colunas[5]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}