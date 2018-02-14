<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['cor'])) $mensagem[] = 'Cor n&atilde;o informada'; else $cor = $_POST['cor'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $pele = new lib\pele();

    $pele->id       = $id;
    $pele->nome     = $nome;
    $pele->cor      = $cor;
    $pele->ativo    = $ativo;

    if ($pele->Salvar())
    {
        echo("OK|$pele->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>