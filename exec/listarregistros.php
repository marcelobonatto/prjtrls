<?php
require_once('../autoload.php');

session_start();

header('Content-type: text/html; charset=utf-8');
/*
$classe     = $_GET['classe'];

$obj        = new $classe();
$lista      = $obj->ListarRegistros($_GET['pagina']);
$colunas    = json_decode($_GET['colunas']);
$cadastro   = $_GET['cadastro'];
*/

$classe         = $_POST['classe'];

$obj            = new $classe();

$numpag         = intval($_POST['pagina']);
$paginacao      = $_POST['paginacao'] == 'true';

if ($paginacao)
{
    $sessao         = 'qtde' . str_replace('lib\\', '', $classe);

    if ($numpag == 0)
    {
        $numpag             = 1;
        $total              = $obj->Contar();
        $_SESSION[$sessao]  = $total;
    }
    else
    {
        $total              = $_SESSION[$sessao];
    }
}

$lista          = $obj->ListarRegistros($numpag);
$colunas        = json_decode($_POST['colunas']);
$cadastro       = $_POST['cadastro'];

if ($paginacao)
{
    controles\paginacao::Gerar($numpag, $total);
}
?>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">&nbsp;</th>
            <?php
            foreach ($colunas as $coluna)
            {
                echo("<th scope=\"col\" style=\"text-align: $coluna->alinhamento\">$coluna->titulo</th>");
            }
            ?>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lista as $obj)
        {
            echo("<tr><td style=\"text-align: center\"><input id=\"chkX$obj->id\" name=\"chkX[]\" type=\"checkbox\" value=\"$obj->id\" /></td>");

            foreach ($colunas as $coluna)
            {
                $colvltxt   = "<td style=\"text-align: $coluna->alinhamento\">*campo*</td>";
                $valor      = $coluna->valor;

                switch ($coluna->tipo)
                {
                    case "texto":
                        $colvltxt   = str_replace('*campo*', $obj->$valor, $colvltxt);
                        break;
                    case "check":
                        $checado    = ($obj->$valor ? "checked=\"checked\" " : "");
                        $colvltxt   = str_replace('*campo*', "<input type=\"checkbox\" value=\"\" disabled=\"disabled\" $checado />", $colvltxt);
                        break;
                    case "cor":
                        $colvltxt   = str_replace('*campo*', "<div style=\"display: inline-block; background-color: " . $obj->$valor . "; border: solid 1px #000000; width: 32px; height: 32px\">&nbsp;</div>", $colvltxt);
                        break;
                }

                echo($colvltxt);
            }

            echo("<td style=\"text-align: center\"><a href=\"$cadastro.php?id=$obj->id\"><i class=\"material-icons\">&#xE254;</i>");
            echo("<a href=\"javascript:prepararExclusao('$obj->id', " . ($obj->ativo ? 0 : 1) . ")\">");
            echo("<i class=\"material-icons\">" . ($obj->ativo ? '&#xE872;' : '&#xE15A;') . "</i></td></tr>\n");
        }
        ?>
    </tbody>
</table>
<?php
if ($paginacao)
{
    controles\paginacao::Gerar($numpag, $total);
}
?>