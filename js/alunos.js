$(document).ready(function() {
    var colunas     = new Array(4);
    colunas[0]      = criarObjetoColuna("Aluno", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Matricula", "matricula", "texto", "left");
    colunas[2]      = criarObjetoColuna("Escola", "escolaNome", "texto", "left");
    colunas[3]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    carregarTabela(1, "aluno",  colj, "aluno", "#lista");
});