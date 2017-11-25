$(document).ready(function() {
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Referência", "codigo", "texto", "left");
    colunas[1]      = criarObjetoColuna("Pergunta", "enunciado", "texto", "left");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "lib\\pergunta",  colj, "quiz", "#lista");

    $("#cmdImportar").on("click", function() {
        location.href = "quizimp.php";
    });
});