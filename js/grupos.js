$(document).ready(function() {
    var colunas     = new Array(2);
    colunas[0]      = criarObjetoColuna("Grupos de Usuários", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "lib\\grupo",  colj, "grupo", "#lista");
});