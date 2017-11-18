$(document).ready(function() {
    var colunas     = new Array(2);
    colunas[0]      = criarObjetoColuna("Sigla", "sigla", "texto", "left");
    colunas[1]      = criarObjetoColuna("Nome", "nome", "texto", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "estado",  colj, "estado", "#lista");
});