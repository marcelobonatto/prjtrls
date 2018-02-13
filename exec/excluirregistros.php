<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['ids'])) $mensagem = 'Os identificadores dos registros a serem desativados n&atilde;o foram informados'; else $ids = $_POST['ids'];
if (!isset($_POST['classe'])) $mensagem[] = 'Classe n&atilde;o informada'; else $classe = $_POST['classe'];
if (!isset($_POST['metodo'])) $mensagem[] = 'M&eacute;todo n&atilde;o informado'; else $metodo = $_POST['metodo'];
if (!isset($_POST['modo'])) $mensagem[] = 'Modo n&atilde;o informado'; else $modo = $_POST['modo'];

if (count($mensagem) == 0)
{
    $idsarr = json_decode($ids);

    foreach ($idsarr as $idobj)
    {
        $classe::$metodo($idobj->id, $modo);
    }

    echo("OK");
}
else
{
    foreach ($mensagem as $linha)
    {
        $html   .= "- $linha<br />"; 
    }

    echo($html);
}
?>