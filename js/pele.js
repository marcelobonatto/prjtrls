$(document).ready(function() {
    classe          = "lib\\missao";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "missao";

    carregarTabela(1);

    $("#cmdImportar").on("click", function() {
        location.href = "missoesimp.php";
    });
});

function configurarTabela()
{
    var colunas     = new Array(5);
    colunas[0]      = criarObjetoColuna("Ano", "ano", "texto", "left");
    colunas[1]      = criarObjetoColuna("Semestre", "semestre", "texto", "left");
    colunas[2]      = criarObjetoColuna("Sequência", "sequencia", "texto", "left");
    colunas[3]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[4]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}