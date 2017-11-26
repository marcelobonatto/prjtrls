<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['codigo'])) $mensagem[] = 'Referencia n&atilde;o informada'; else $codigo = $_POST['codigo'];
if (!isset($_POST['enunciado'])) $mensagem[] = 'Enunciado n&atilde;o informado'; else $enunciado = $_POST['enunciado'];
if (!isset($_POST['eixo'])) $mensagem[] = 'Eixo n&atilde;o informada'; else $eixo = $_POST['eixo'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

/*
id (i.d)
codigo (no.me)
enunciado (login.moodle)
eixo (esco.la)
ativo (ati.vo)
*/

if (count($mensagem) == 0)
{
    $aluno = new aluno();

    $aluno->id          = $id;
    $aluno->codigo        = $codigo;
    $aluno->enunciado       = $enunciado;

    if ($_POST['eixo']  != '*')
    {
        $aluno->eixo    = $eixo;
    }
    else
    {
        $aluno->eixo    = null;
    }

    $aluno->ativo       = $ativo;

    if ($aluno->Salvar())
    {
        echo("OK|$aluno->id");
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