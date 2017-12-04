<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes
/*
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
*/
if (isset($_POST['cidade']))
//if (isset($_GET['cidade']))
{
    $cidade          = $_POST['cidade'];
//    $cidade          = $_GET['cidade'];
}
else
{
    $mensagens[]    = 'Cidade não informada';
    $token          = '';
}

if (count($mensagens) == 0)
{
    $escobj         = new lib\escola();
    $escarr         = $escobj->ListarPorCidade($cidade);

    if (count($escarr) == 0)
    {
        $mensagens[]    = 'Não existem escolas cadastradas para a cidade informada';
    }
    else
    {
        $escola             = new lib\ws\jsescolaarray();
        $escola->escolas    = array();

        foreach ($escarr as $esc)
        {
            $escola->escolas[]                  = new lib\ws\jsescola();
            $posesc                             = count($escola->escolas) - 1;

            $escola->escolas[$posesc]->codigo   = $esc->id;
            $escola->escolas[$posesc]->nome     = $esc->nome;
            $escola->escolas[$posesc]->bairro   = $esc->bairro;
        }
    }
}

if (count($mensagens) > 0)
{
    $escola         = new lib\ws\jsescolaerro();

    $escola->erros  = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $escola->erros[$i]              = new lib\ws\jserro();
        $escola->erros[$i]->mensagem    = $mensagem;
        $i++;
    }
}

$escola->cidade = $cidade;

echo(json_encode($escola));
?>