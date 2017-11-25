<?php
header('Content-Type: application/json');

include_once('lib/jsmissao.php');
include_once('lib/jsmissaoeixo.php');
include_once('lib/jsnpc.php');
include_once('lib/jserro.php');

$mensagens  = array();

if (isset($_POST['token']))
{
    $token          = $_POST['token'];
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
}

if (isset($_POST['codigo']))
{
    $codigo         = $_POST['codigo'];
}
else
{
    $mensagens[]    = 'Código da missão não informado';
    $codigo         = '';
}

$missao         = new jsmissao();
$missao->token  = $token;
$missao->codigo = $codigo;

if (count($mensagens) == 0)
{

}
else
{
    $missao->erros  = array();
    
    foreach ($mensagens as $mensagem)
    {
        $missao->erros[]                    = new jserro();
        $poserro                            = count($missao->erros) - 1;
        $missao->erros[$poserro]->mensagem  = $mensagem;
    }
}

echo(json_encode($missao));
?>