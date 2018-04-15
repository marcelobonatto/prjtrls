pagina      = "cidades.php";
exec        = "gravarcidade";
form        = $("#frmCidade");

var id      = $("#txtid").val();
var nome    = $("#txtnome").val();
var estado  = $("#cmbestado").val();
var ativo   = $("input[name='optAtivo']:checked").val();
var novo    = ($("#novo").val() == "novo" ? 1 : 0);

json        = [ { campo: "id", controle: "#txtid", tipo: "texto" },
                { campo: "nome", controle: "#txtnome", tipo: "texto" },
                { campo: "estado", controle: "#cmbestado", tipo: "combo" },
                { campo: "ativo", controle: "optAtivo", tipo: "ativo" },
                { campo: "novo", controle: "#novo", tipo: "opnovo" }
              ]