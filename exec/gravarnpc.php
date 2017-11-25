<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['chave'])) $mensagem[] = 'Chave n&atilde;o informado'; else $chave = $_POST['chave'];
if (!isset($_POST['eixo'])) $mensagem[] = 'Eixo n&atilde;o informado'; else $eixo = $_POST['eixo'];
if (!isset($_POST['imagemNormal'])) $mensagem[] = 'Imagem normal n&atilde;o informado'; else $imagemNormal = $_POST['imagemNormal'];
if (!isset($_POST['icone'])) $mensagem[] = 'Icone n&atilde;o informado'; else $icone = $_POST['icone'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $npc = new lib\npc();

    $npc->id          = $id;
    $npc->nome        = $nome;
    $npc->chave       = $chave;

    if ($_POST['eixo']  != '*')
    {
        $npc->eixo    = $eixo;        
    }
    else
    {
        $npc->eixo    = null;
    }

    $npc->imagemNormal   = $imagemNormal;
    $npc->icone       = $icone;
    $npc->ativo       = $ativo;

    if ($npc->Salvar())
    {
        echo("OK|$npc->id");
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