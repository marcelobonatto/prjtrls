<?php
require_once('../autoload.php');

$mensagem   = array();
//if ($_POST['id']=='novo') $id = 'novo'; else $id = 'alt';
if (!isset($_POST['sigla'])) $mensagem[] = 'Sigla n&atilde;o informada'; else $sigla = $_POST['sigla'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];

echo $_POST['id'].': '.$sigla.' - '.$nome;

if (count($mensagem) == 0)
{
    $estado = new lib\estado();

    $estado->id         = $sigla;
    $estado->nome       = $nome;

    if ($estado->Salvar($_POST['id']))
    {
        echo("OK|$estado->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>