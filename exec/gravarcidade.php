<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['novo'])) $mensagem[] = 'Indicador de status n&atilde;o informado';   else $novo  = $_POST['novo'];

if (!isset($_POST['id']))
{
    $mensagem[] = 'C&oacute;digo IBGE n&atilde;o informado';
}
else
{
    if (strlen($_POST['id']) > 7)
    {
        $mensagem[] = 'C&oacute;digo IBGE informado n&atilde;o pode ser maior que 7 caracteres';
    }
    else if (lib\cidade::Existe($_POST['id']))
    {
        $mensagem[] = 'C&oacute;digo IBGE informado j&aacute; existe';
    }
    else
    {
        $id         = $_POST['id'];
    }    
}

if (!isset($_POST['nome']))     $mensagem[] = 'Nome n&atilde;o informado';                  else $nome      = $_POST['nome'];
if (!isset($_POST['estado']))   $mensagem[] = 'Estado n&atilde;o informado';                else $estado    = $_POST['estado'];
if (!isset($_POST['ativo']))    $mensagem[] = 'Indicador de ativo n&atilde;o informado';    else $ativo     = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $cidade             = new lib\cidade();

    $cidade->id         = $id;
    $cidade->nome       = $nome;
    $cidade->estado     = $estado;
    $cidade->ativo      = $ativo;

    if ($cidade->Salvar($novo))
    {
        echo("OK|$id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
else
{
    $html = '';

    foreach ($mensagem as $linha)
    {
        $html   .= "- $linha<br />"; 
    }

    echo($html);
}
?>