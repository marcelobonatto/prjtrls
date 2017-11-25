<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $grupo = new lib\grupo();

    $grupo->id          = $id;
    $grupo->nome        = $nome;
    $grupo->ativo       = $ativo;

    if ($grupo->Salvar())
    {
        echo("OK|$grupo->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>