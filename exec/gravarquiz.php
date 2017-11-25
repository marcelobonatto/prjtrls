<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['loginMoodle'])) $mensagem[] = 'LoginMoodle n&atilde;o informado'; else $loginMoodle = $_POST['loginMoodle'];
if (!isset($_POST['escola'])) $mensagem[] = 'Unidade de Ensino n&atilde;o informada'; else $escola = $_POST['escola'];
if (!isset($_POST['matricula'])) $mensagem[] = 'Matricula n&atilde;o informada'; else $matricula = $_POST['matricula'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

/*
alunoId (id)
alunoNome (nome)
alunoLoginMoodle (loginMoodle) 
escolaId (escola)
alunoMatricula (matricula)
alunoAtivo (ativo)
*/

if (count($mensagem) == 0)
{
    $aluno = new aluno();

    $aluno->id          = $id;
    $aluno->nome        = $nome;
    $aluno->loginMoodle       = $loginMoodle;

    if ($_POST['escola']  != '*')
    {
        $aluno->escola    = $escola;
    }
    else
    {
        $aluno->escola    = null;
    }

    $aluno->matricula   = $matricula;
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