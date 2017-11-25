<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

//if (isset($_POST['token']))
if (isset($_GET['token']))
{
//    $token          = $_POST['token'];
    $token          = $_GET['token'];
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
}

//if (isset($_POST['codigo']))
if (isset($_GET['pedido']))
{
//    $codigo         = $_POST['codigo'];
    $codigo         = $_GET['pedido'];
}
else
{
    $mensagens[]    = 'Pedido de quiz não informado';
    $codigo         = '';
}

if (count($mensagens) == 0)
{
    $quiz         = new lib\ws\jsquiz();
}

if (count($mensagens) > 0)
{
    $quiz           = new lib\ws\jsquizerros();

    $quiz->erros    = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $missao->quiz[$i]               = new lib\ws\jserro();
        $missao->quiz[$i]->mensagem     = $mensagem;
        $i++;
    }
}

echo(json_encode($quiz));
?>