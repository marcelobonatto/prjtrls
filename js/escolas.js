var classe = "lib\\escola";

$(document).ready(function() {
    var colj = configurarTabela();
    carregarTabela(1, classe,  colj, "escola", "#lista");

    $("#cmdImportar").on("click", function() {
        location.href = "escolasimp.php";
    });

    $("#cmdExcluir").click(function() {
        prepararVariasExclusoes(0);
    });

    $("#cmdReativar").click(function() {
        prepararVariasExclusoes(1);
    });
});

function configurarTabela()
{
    var colunas     = new Array(5);
    colunas[0]      = criarObjetoColuna("Nome", "nome", "texto", "left");
    colunas[1]      = criarObjetoColuna("Bairro", "bairro", "texto", "left");
    colunas[2]      = criarObjetoColuna("Cidade", "cidadenome", "texto", "center");
    colunas[3]      = criarObjetoColuna("Estado", "estado", "texto", "center");
    colunas[4]      = criarObjetoColuna("Ativo", "ativo", "check", "center");

    var colj        = JSON.stringify(colunas);

    return colj;
}

function prepararExclusao(id, modo)
{
    var ids = new Array(1);
    var obj = new Object();
    obj.id  = id;
    ids[0]  = obj;

    var colj = configurarTabela();

    if (modo == 0)
    {
        excluir(classe, "Excluir", JSON.stringify(ids), 1, colj, "escola", "#lista");
    }
    else
    {
        reativar(classe, "Reativar", JSON.stringify(ids), 1, colj, "escola", "#lista");
    }
}

function prepararVariasExclusoes(modo)
{
    var ids = [];

    $("input[name='chkX[]']:checked").each(function () {
        var obj = new Object();
        obj.id = this.value;
        ids.push(obj);
    });

    var colj = configurarTabela();

    if (modo == 0)
    {
        excluir(classe, "Excluir", JSON.stringify(ids), 1, colj, "escola", "#lista");
    }
    else
    {
        reativar(classe, "Reativar", JSON.stringify(ids), 1, colj, "escola", "#lista");
    }
}