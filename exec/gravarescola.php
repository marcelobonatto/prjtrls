<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['bairro'])) $mensagem[] = 'Bairro n&atilde;o informado'; else $bairro = $_POST['bairro'];
if (!isset($_POST['estado'])) $mensagem[] = 'Estado n&atilde;o informado'; else $estado = $_POST['estado'];
if (!isset($_POST['cidade'])) $mensagem[] = 'Cidade n&atilde;o informado'; else $cidade = $_POST['cidade'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $escola = new lib\escola();

    $escola->id          = $id;
    $escola->nome        = $nome;
    $escola->bairro       = $bairro;
    $escola->estado    = $estado;        
    $escola->cidade   = $cidade;
    $escola->ativo       = $ativo;

    if ($escola->Salvar())
    {
        echo("OK|$escola->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
else
{
    foreach ($mensagem as $linha)
    {
        $html   .= "- $linha<br />"; 
    }

    echo($html);
}
?>