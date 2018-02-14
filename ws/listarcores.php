<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

if (count($mensagens) == 0)
{
    $cabobj         = new lib\cabelo();
    $cabarr         = $cabobj->ListarRegistros(1);

    $peleobj        = new lib\pele();
    $pelearr        = $peleobj->ListarRegistros(1);

    if (count($cabarr) == 0)
    {
        $mensagens[]    = 'Não existem cores de cabelo cadastradas';
    }
    else if (count($pelearr) == 0)
    {
        $mensagens[]    = 'Não existem cores de pele cadastradas';
    }
    else
    {
        $cores              = new lib\ws\jscoresarray();
        $cores->cabelos     = array();
        $cores->peles       = array();

        foreach ($cabarr as $cab)
        {
            $cores->cabelos[]                   = new lib\ws\jscor();
            $poscab                             = count($cores->cabelos) - 1;

            $cores->cabelos[$poscab]->codigo    = $cab->id;
            $cores->cabelos[$poscab]->nome      = $cab->nome;
            $cores->cabelos[$poscab]->cor       = $cab->cor;
        }

        foreach ($pelearr as $pele)
        {
            $cores->peles[]                     = new lib\ws\jscor();
            $pospele                            = count($cores->peles) - 1;

            $cores->peles[$pospele]->codigo     = $pele->id;
            $cores->peles[$pospele]->nome       = $pele->nome;
            $cores->peles[$pospele]->cor        = $pele->cor;
        }
    }
}

if (count($mensagens) > 0)
{
    $cores          = new lib\ws\jscoreserro();

    $cores->erros   = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $cores->erros[$i]           = new lib\ws\jserro();
        $cores->erros[$i]->mensagem = $mensagem;
        $i++;
    }
}

echo(json_encode($cores));
?>