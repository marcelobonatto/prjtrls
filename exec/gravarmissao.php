<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id']))           $id         = null;                                                     else $id            = $_POST['id'];
if (!isset($_POST['nome']))         $mensagem[] = 'Nome n&atilde;o informado';                              else $nome          = $_POST['nome'];
if (!isset($_POST['titulo']))       $mensagem[] = 'Título n&atilde;o informado';                            else $titulo        = $_POST['titulo'];
if (!isset($_POST['descricao']))    $mensagem[] = 'Descrição n&atilde;o informado';                         else $descricao     = $_POST['descricao'];
if (!isset($_POST['ano']))          $mensagem[] = 'Ano n&atilde;o informado';                               else $ano           = $_POST['ano'];
if (!isset($_POST['semestre']))     $mensagem[] = 'Semestre n&atilde;o informado';                          else $semestre      = $_POST['semestre'];
if (!isset($_POST['sequencia']))    $mensagem[] = 'Sequencia n&atilde;o informada';                         else $sequencia     = $_POST['sequencia'];
if (!isset($_POST['moodle']))       $mensagem[] = 'Id do Moodle n&atilde;o informado';                      else $moodle        = $_POST['moodle'];
if (!isset($_POST['obrigatorio']))  $mensagem[] = 'Indicador de missão obrigatória n&atilde;o informado';   else $obrigatorio   = $_POST['obrigatorio'];
if (!isset($_POST['pai']))          $mensagem[] = 'Pai n&atilde;o informado';                               else $pai           = $_POST['pai'];
if (!isset($_POST['ativo']))        $mensagem[] = 'Indicador de ativo n&atilde;o informado';                else $ativo         = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $missao                 = new missao();

    $missao->id             = $id;
    $missao->nome           = $nome;
    $missao->titulo         = $titulo;
    $missao->descricao      = $descricao;
    $missao->ano            = $ano;
    $missao->semestre       = $semestre;
    $missao->sequencia      = $sequencia;
    $missao->idMoodle       = $moodle;
    $missao->obrigatoria    = $obrigatorio;

    if ($obrigatorio == 1 || $pai == '')
    {
        $missao->pai        = null;
    }
    else
    {
        $missao->pai        = $pai;
    }

    $missao->ativo          = $ativo;

    if ($missao->Salvar())
    {
        echo("OK|$missao->id");
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