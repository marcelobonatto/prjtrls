<?php
require_once('../autoload.php');

header('Content-type: text/html; charset=utf-8');

$classe     = $_POST['classe'];

$obj        = new $classe();
$lista      = $obj->ListarRegistros($_POST['pagina']);
$colunas    = json_decode($_POST['colunas']);
$cadastro   = $_POST['cadastro'];
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
            echo("<tr><td style=\"text-align: center\"><input name=\"chkX\" type=\"checkbox\" value=\"$obj->id\" /></td>");

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
                }

                echo($colvltxt);
            }

            echo("<td style=\"text-align: center\"><a href=\"$cadastro.php?id=$obj->id\"><i class=\"material-icons\">&#xE254;</i></td></tr>");
        }
        ?>
    </tbody>
</table>
<!-- <nav>
    <ul class="pagination justify-content-end">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav> -->