<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id']))
{
    $mensagem[] = 'C&oacute;digo IBGE n&atilde;o informado';
}
else
{
    if (lib\cidade::Existe($_POST['id']))
    {
        $mensagem[] = 'C&oacute;digo IBGE informado j&aacute; existe';
    }
    else
    {
        $id         = $_POST['id'];
    }    
}

if (!isset($_POST['nome']))     $mensagem[] = 'Nome n&atilde;o informado';                  else $nome      = $_POST['nome'];
if (!isset($_POST['estado']))   $mensagem[] = 'Estado n&atilde;o informado';                else $estado    = $_POST['estado'];
if (!isset($_POST['ativo']))    $mensagem[] = 'Indicador de ativo n&atilde;o informado';    else $ativo     = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $cidade             = new lib\cidade();

    $cidade->id         = $id;
    $cidade->nome       = $nome;
    $cidade->estado     = $estado;
    $cidade->ativo      = $ativo;

    if ($cidade->Salvar($_POST['id']))
    {
        echo("OK|$cidade->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>