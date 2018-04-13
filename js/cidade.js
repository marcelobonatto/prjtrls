pagina      = "cidades.php";
exec        = "gravarcidade.php"
form        = $("#frmCidade");

var id      = $("#txtid").val();
var nome    = $("#txtnome").val();
var estado  = $("#cmbestado").val();
var ativo   = $("input[name='optAtivo']:checked").val();

dados       = "id=" + id + "&nome=" + nome + "&estado=" + estado + "&ativo=" + ativo;