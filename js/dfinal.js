$(document).ready(function() {
    var colunas     = new Array(4);
    colunas[0]      = criarObjetoColuna("Referência", "codigo", "texto", "left");
    colunas[1]      = criarObjetoColuna("Pergunta", "enunciado", "texto", "left");
    colunas[2]      = criarObjetoColuna("Nível", "dificuldade", "texto", "center");
    colunas[3]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "perguntadf",  colj, "perguntadf", "#lista");

    $("#cmdImportar").on("click", function() {
        location.href = "dfinalimp.php";
    });
});