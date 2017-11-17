$(document).ready(function() {
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Sequência", "sequencia", "texto", "left");
    colunas[1]      = criarObjetoColuna("Eixo", "nome", "texto", "left");
    colunas[2]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "eixo",  colj, "eixo", "#lista");
});