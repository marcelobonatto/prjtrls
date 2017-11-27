<?php
include_once('../autoload.php');

//header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

//if (isset($_POST['usuario']))
if (isset($_GET['usuario']))
{
//    $usuario          = $_POST['usuario'];
    $usuario          = $_GET['usuario'];
}
else
{
    $mensagens[]    = 'Nome de usuário não informado';
    $usuario        = '';
}

//if (isset($_POST['chave']))
if (isset($_GET['chave']))
{
//    $chave         = $_POST['chave'];
    $chave          = $_GET['chave'];

    $chobj          = new lib\chave();
    $chobj->descompactar($chave);

    echo("$chobj->texto<br />");
}
else
{
    $mensagens[]    = 'Chave não informada';
    $desc          = '';
}

if (count($mensagens) == 0)
{

}

if (count($mensagens) > 0)
{
    $login         = new lib\ws\jsloginerros();

    $login->erros  = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $login->erros[$i]              = new lib\ws\jserro();
        $login->erros[$i]->mensagem    = $mensagem;
        $i++;
    }
}

$login->token  = $token;
$login->codigo = $codigo;

echo(json_encode($login));
?>