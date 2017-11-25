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
    $item = new lib\item();

    $item->id          = $id;
    $item->nome        = $nome;
    $item->nivel       = $nivel;
    $item->tipo        = 'I';

    if ($_POST['eixo']  != '*')
    {
        $item->eixo    = $eixo;        
    }
    else
    {
        $item->eixo    = null;
    }

    $item->bonus       = $bonus;
    $item->preconormal = $preco;
    $item->ativo       = $ativo;

    if ($item->Salvar())
    {
        echo("OK|$item->id");
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