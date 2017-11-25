<?php
include('../autoload.php');

if (isset($_GET['estado']))
{
    $estado = $_GET['estado'];

    $cidadeobj  = new lib\cidade();
    $cidades    = $cidadeobj->ListarPorEstado($estado);

    header('Content-Type: application/json');
    echo json_encode($cidades);
}
else
{
    echo("[]");
}
?>