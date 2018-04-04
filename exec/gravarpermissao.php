<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['tela'])) $mensagem[] = 'Tela n&atilde;o informada'; else $tela = $_POST['tela'];
if (!isset($_POST['incluir'])) $mensagem[] = 'Incluir n&atilde;o informado'; else $incluir = $_POST['incluir'];
if (!isset($_POST['alterar'])) $mensagem[] = 'Alteado n&atilde;o informado'; else $alterar = $_POST['alterar'];
if (!isset($_POST['excluir'])) $mensagem[] = 'Excluir n&atilde;o informado'; else $excluir = $_POST['excluir'];
if (!isset($_POST['acessar'])) $mensagem[] = 'Acessar n&atilde;o informado'; else $acessar = $_POST['acessar'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $permissao          = new lib\permissao();

    $permissao->id      = $id;
    $permissao->nome    = $nome;
    $permissao->tela    = $tela;
    $permissao->incluir = $incluir;
    $permissao->alterar = $alterar;
    $permissao->excluir = $excluir;
    $permissao->acessar = $acessar;
    $permissao->ativo   = $ativo;

    if ($permissao->Salvar())
    {
        echo("OK|$permissao->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>