$(document).ready(function() {
    var colunas     = new Array(3);
    colunas[0]      = criarObjetoColuna("Código", "id", "texto", "left");
    colunas[1]      = criarObjetoColuna("Nome", "nome", "texto", "center");
    colunas[2]      = criarObjetoColuna("Estado", "estado", "texto", "left");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "lib\\cidade",  colj, "cidade", "#lista", true);
});