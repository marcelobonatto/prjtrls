<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['nivel'])) $mensagem[] = 'N&iacute;vel n&atilde;o informado'; else $nivel = $_POST['nivel'];
if (!isset($_POST['eixo'])) $mensagem[] = 'Eixo n&atilde;o informado'; else $eixo = $_POST['eixo'];
if (!isset($_POST['bonus'])) $mensagem[] = 'B&ocirc;nus n&atilde;o informado'; else $bonus = $_POST['bonus'];
if (!isset($_POST['preco'])) $mensagem[] = 'Pre&ccedil;o n&atilde;o informado'; else $preco = $_POST['preco'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $roupa = new lib\roupa();

    $roupa->id          = $id;
    $roupa->nome        = $nome;
    $roupa->nivel       = $nivel;
    $roupa->tipo        = 'R';

    if ($_POST['eixo']  != '*')
    {
        $roupa->eixo    = $eixo;        
    }
    else
    {
        $roupa->eixo    = null;
    }

    $roupa->bonus       = $bonus;
    $roupa->preconormal = $preco;
    $roupa->ativo       = $ativo;

    if ($roupa->Salvar())
    {
        echo("OK|$roupa->id");
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