<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

$estado = "PR";

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
if (count($mensagens) == 0)
{
    $cidobj         = new lib\cidade();
    $cidarr         = $cidobj->ListarPorEstado($estado);

    if (count($cidarr) == 0)
    {
        $mensagens[]    = 'Não existem cidades cadastradas';
    }
    else
    {
        $cidade             = new lib\ws\jscidadearray();
        $cidade->cidades    = array();

        foreach ($cidarr as $cid)
        {
            $cidade->cidades[]                  = new lib\ws\jscidade();
            $poscid                             = count($cidade->cidades) - 1;
            $cidade->cidades[$poscid]->codigo   = $cid->id;
            $cidade->cidades[$poscid]->nome     = $cid->nome;
        }
    }
}

if (count($mensagens) > 0)
{
    $cidade         = new lib\ws\jscidadeerro();

    $cidade->erros  = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $cidade->erros[$i]              = new lib\ws\jserro();
        $cidade->erros[$i]->mensagem    = $mensagem;
        $i++;
    }
}

echo(json_encode($cidade));
?>