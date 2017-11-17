$(document).ready(function() {
    var colunas     = new Array(2);
    colunas[0]      = criarObjetoColuna("Usuário", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "usuario",  colj, "usuario", "#lista");
});