<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

if (isset($_POST['token']))
//if (isset($_GET['token']))
{
    $token          = $_POST['token'];
//    $token          = $_GET['token'];

    $auto           = new lib\autorizacao();
    $autoresp       = $auto->Validar(base64_decode($token));

    switch ($autoresp)
    {
        case 1:
            $mensagens[]    = 'Token inválido';
            break;
        case 2:
            $mensagens[]    = 'Validade do token vencida';
            break;
        case 3:
            $mensagens[]    = 'Não consegui atualizar o token';
            break;
    }
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
}

if (isset($_POST['codigo']))
//if (isset($_GET['codigo']))
{
    $codigo         = $_POST['codigo'];
//    $codigo         = $_GET['codigo'];
}
else
{
    $mensagens[]    = 'Código da missão não informado';
    $codigo         = '';
}

if (count($mensagens) == 0)
{
    $falobj         = new lib\dialogonpc();
    $falarr         = $falobj->ListarPorMissao($codigo);

    $falas          = new lib\ws\jsfalas();
    $falas->falas   = array();

    foreach ($falarr as $falitm)
    {
        $falas->falas[]                     = new lib\ws\jsfalasfala();
        $indfala                            = count($falas->falas) - 1;
        $falas->falas[$indfala]->sequencia  = $falitm->sequencia;
        $falas->falas[$indfala]->npc        = $falitm->chave;
        $falas->falas[$indfala]->humor      = $falitm->humor;
        $falas->falas[$indfala]->texto      = $falitm->texto;
    }
}

if (count($mensagens) > 0)
{
    $falas          = new lib\ws\jsfalaserros();

    $falas->erros   = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $falas->erros[$i]              = new lib\ws\jserro();
        $falas->erros[$i]->mensagem    = $mensagem;
        $i++;
    }
}

$falas->token   = $token;
$falas->missao  = $codigo;

echo(json_encode($falas));
?>