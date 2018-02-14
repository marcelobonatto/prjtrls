$(document).ready(function() {
    classe          = "lib\\carteira";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "carteira";

    carregarTabela(1);

    $("#cmdImportar").on("click", function() {
        location.href = "itensimp.php";
    });
});

function configurarTabela()
{
    var colunas     = new Array(5);
    colunas[0]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Nível", "nivel", "texto", "center");
    colunas[2]      = criarObjetoColuna("Limite", "limite", "texto", "left");
    colunas[3]      = criarObjetoColuna("Preço", "preconormal", "texto", "right");
    colunas[4]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}