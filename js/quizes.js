$(document).ready(function() {
    classe          = "lib\\pergunta";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "quiz";

    carregarTabela(1);

    $("#cmdImportar").on("click", function() {
        location.href = "quizimp.php";
    });
});

function configurarTabela()
{
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Referência", "codigo", "texto", "left");
    colunas[1]      = criarObjetoColuna("Pergunta", "enunciado", "texto", "left");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);
    
    return colj;
}