<?php
$chave  = '';
$valor  = '';
$erro   = '';
$json   = '';

if (!isset($_POST['chave']))
{
    $erro   = '<li>Chave n&atilde;o informada</li>';
}
else
{
    $chave  = $_POST['chave'];
    $json   = "&nbsp;&nbsp;\"chave\": \"" . base64_encode($chave) . "\"";
}

if (!isset($_POST['valor']))
{
    $erro   .= '<li>Valor n&atilde;o informada</li>';
}
else
{
    $valor  = $_POST['valor'];
    $json   .= ",<br />&nbsp;&nbsp;\"valor\": \"" . base64_encode($valor) . "\"";
}

if (strlen($erro) > 0)
{
    echo("<ul>$erro</ul>");
}
else
{
    echo("{<br />$json<br />}");
}
?>