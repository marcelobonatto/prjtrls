$(document).ready(function() {
    classe          = "lib\\perguntadf";
    metodoExcluir   = "Excluir";
    paginaCadastro  = "perguntadf";

    carregarTabela(1);

    $("#cmdImportar").on("click", function() {
        location.href = "dfinalimp.php";
    });
});

function configurarTabela()
{
    var colunas     = new Array(4);
    colunas[0]      = criarObjetoColuna("Referência", "codigo", "texto", "left");
    colunas[1]      = criarObjetoColuna("Pergunta", "enunciado", "texto", "left");
    colunas[2]      = criarObjetoColuna("Nível", "dificuldade", "texto", "center");
    colunas[3]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);
    
    return colj;
}