<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['sequencia'])) $mensagem[] = 'Sequencia n&atilde;o informada'; else $sequencia = $_POST['sequencia'];
if (!isset($_POST['sigla'])) $mensagem[] = 'Sigla n&atilde;o informada'; else $sigla = $_POST['sigla'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $eixo = new lib\eixo();

    $eixo->id          = $id;
    $eixo->nome        = $nome;
    $eixo->sequencia   = $sequencia;
    $eixo->sigla       = $sigla;
    $eixo->ativo       = $ativo;

    if ($eixo->Salvar())
    {
        echo("OK|$eixo->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>