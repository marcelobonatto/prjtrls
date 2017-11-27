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
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
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
    $mensagens[]    = 'Status não informado';
    $status          = '';
}

if (count($mensagens) == 0)
{
    $missaoalunojs                 = new lib\ws\jsmissaoaluno();

    $missaoaluno            = new lib\missaoaluno();
    $mandasalvar            = $missaoaluno->Salvar();
}