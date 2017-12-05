<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

$conf       = new lib\ws\jsgravacao();

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

if (isset($_POST['missaoaluno']))
//if (isset($_GET['missaoaluno']))
{
    $missaoaluno         = $_POST['missaoaluno'];
//    $missaoaluno         = $_GET['missaoaluno'];
}
else
{
    $mensagens[]    = 'Missao/Aluno não informado';
    $missaoaluno          = '';
}

if (isset($_POST['aluno']))
//if (isset($_GET['aluno']))
{
    $aluno         = $_POST['aluno'];
//    $aluno         = $_GET['aluno'];
}
else
{
    $mensagens[]    = 'Aluno não informado';
    $aluno          = '';
}

if (isset($_POST['missao']))
//if (isset($_GET['missao']))
{
    $missao         = $_POST['missao'];
//    $missao         = $_GET['missao'];
}
else
{
    $mensagens[]    = 'Missão não informada';
    $missao          = '';
}

if (isset($_POST['status']))
//if (isset($_GET['status']))
{
    $status         = $_POST['status'];
//    $status         = $_GET['status'];
}
else
{
    $mensagens[]     = 'Status não informado';
    $status          = '';
}

//url exemplo:
//http://localhost/prjtrlsadm/ws/confirmarmissao.php?token=ZjJiMWRkNGUtZDNjYy0xMWU3LWIxZGYtNTJhZTc0M2JjODNk&valor=eyAiYWx1bm8iOiAiZWY4OGJiNTAtY2Q2YS0xMWU3LTkxYjgtMDAwNTFiNzYwMWEzIiwgIm1pc3NhbyI6ICJlZjg4YmI1MC1jZDZhLTExZTctOTFiOC0wMDA1MWI3NjAxYTMiIH0%3D

if (count($mensagens) == 0)
{
    $maobj                = new lib\missaoaluno();

    $maobj->id            = $missaoaluno;
    $maobj->missao        = $missao;
    $maobj->aluno         = $aluno;
    $maobj->status        = $status;
    
    if ($maobj->Salvar())
    {
        $conf->gravou    = true;
        $conf->valor     = "$missaoaluno / $missao / $aluno / $status";
    }
    else
    {
        $mensagens[]    = 'Não foi possível atualizar a missão do aluno';
    }
}

if (count($mensagens) > 0)
{
    $conf->erros    = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $conf->erros[$i]             = new lib\ws\jserro();
        $conf->erros[$i]->mensagem   = $mensagem;
        $i++;
    }

    $conf->gravou    = false;
}

$conf->token     = $token;
$conf->valor     = $valor;

echo(json_encode($conf));