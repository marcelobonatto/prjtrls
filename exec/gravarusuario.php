<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['senha'])) $mensagem[] = 'Senha n&atilde;o informada'; else $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $usuario = new lib\usuario();

    $usuario->id          = $id;
    $usuario->nome        = $nome;
    $usuario->senha       = $senha;
    $usuario->ativo       = $ativo;

    if ($usuario->Salvar())
    {
        echo("OK|$usuario->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>