<?php
require_once('../autoload.php');

use lib\missao;

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
if (!isset($_POST['urlredir']))     $urlredir   = null;                                                     else $urlredir      = $_POST['urlredir'];

if (!isset($_POST['pai']))
{
    if ($obrigatorio == 0)
    {
        $mensagem[] = 'Pai n&atilde;o informado';
    }
    else
    {
        $pai        = null;
    }
}
else
{
    $pai            = $_POST['pai'];
}

if (!isset($_POST['ativo']))        $mensagem[] = 'Indicador de ativo n&atilde;o informado';                else $ativo         = $_POST['ativo'];

$agora = new DateTime();
$dataagora = DateTime::createFromFormat('!Y-m-d', $agora->format('Y-m-d'));
$datade = (!isset($_POST['datade']) ? '' : DateTime::createFromFormat('!d/m/Y', $_POST['datade']));
$olddatade = (!isset($_POST['olddatade']) ? '' : DateTime::createFromFormat('!d/m/Y', $_POST['olddatade']));
$dataate = (!isset($_POST['dataate']) ? '' : DateTime::createFromFormat('!d/m/Y', $_POST['dataate']));
$olddataate = (!isset($_POST['olddataate']) ? '' : DateTime::createFromFormat('!d/m/Y', $_POST['olddataate']));

if ($id == null)
{
    if ($datade < $dataagora)
    {
        $mensagem[] = 'A data inicial do per&iacute;odo deve ser igual ou maior que hoje';
    }

    if ($dataate < $dataagora)
    {
        $mensagem[] = 'A data final do per&iacute;odo deve ser igual ou maior que hoje';
    }
}
else
{
    if ($datade < $dataagora && $datade != $olddatade)
    {
        $mensagem[] = 'A data inicial do per&iacute;odo deve ser igual ou maior que hoje';
    }

    if ($dataate < $dataagora && $dataate != $olddataate)
    {
        $mensagem[] = 'A data final do per&iacute;odo deve ser igual ou maior que hoje';
    }
}

if ($datade != null && $dataate != null && $datade > $dataate)
{
    $mensagem[] = 'A data inicial n&atilde;o pode ser menor que a data final do per&iacute;odo';
}

$eixossel = array();

if (isset($_POST['eixos']))
{
    if (count($_POST['eixos']) > 0)
    {
        $eixossel   = $_POST['eixos'];
    }
    else
    {
        $mensagem[] = '&Eacute; necess&aacute;rio informar a pontua&ccedil;&atilde;o de pelo menos um eixo';
    }
}

$falassel = array();

if (isset($_POST['falas']))
{
    if (count($_POST['falas']) > 0)
    {
        $falassel   = $_POST['falas'];
    }
}

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
    $missao->datade         = $datade;
    $missao->dataate        = $dataate;
    $missao->urlredir       = $urlredir;

    if ($obrigatorio == 1 || $pai == '')
    {
        $missao->pai        = null;
    }
    else
    {
        $missao->pai        = $pai;
    }

    $missao->ativo          = $ativo;

    $eixosobj   = new lib\missaoeixo();
    $eixosarr   = $eixosobj->ListarPorMissao($id);
    
    $eixos  = array();

    if (count($eixossel) > 0)
    {
        foreach ($eixossel as $eixo)
        {
            $eixos[]                = new lib\missaoeixo();
            $poseixo                = count($eixos) - 1;

            $spleixo                = explode('|', $eixo);

            if (strlen($eixo[0]) > 0)
            {
                $eixos[$poseixo]->id    = $spleixo[0];
            }

            $eixos[$poseixo]->eixo      = $spleixo[1];
            $eixos[$poseixo]->pontos    = $spleixo[2];
        }
    }

    foreach ($eixosarr as $eixoitm)
    {
        $posdel = array_search($eixoitm->id, array_column($eixos, 'id'));

        if ($posdel === FALSE)
        {
            $eixos[]                = new lib\missaoeixo();
            $poseixo                = count($eixos) - 1;

            $eixos[$poseixo]->id        = $eixoitm->id;
            $eixos[$poseixo]->eixo      = $eixoitm->eixo;
            $eixos[$poseixo]->pontos    = 0;
        }
    }

    $missao->eixos          = $eixos;

    $falaobj    = new lib\dialogonpc();
    $falasarr   = $falaobj->ListarPorMissao($id);

    $falas  = array();
    
    if (count($falassel) > 0)
    {
        foreach ($falassel as $fala)
        {
            $falas[]                = new lib\dialogonpc();
            $posfala                = count($falas) - 1;

            $splfala                = explode('|', $fala);

            if (strlen($eixo[0]) > 0)
            {
                $falas[$posfala]->id    = $splfala[0];
            }

            $falas[$posfala]->sequencia = $splfala[1];
            $falas[$posfala]->npc       = $splfala[2];
            $falas[$posfala]->humor     = $splfala[3];
            $falas[$posfala]->texto     = $splfala[4];
        }
    }

    foreach ($falasarr as $falaitm)
    {
        $posdel = array_search($falaitm->id, array_column($falas, 'id'));

        if ($posdel === FALSE)
        {
            $falas[]                = new lib\dialogonpc();
            $posfala                = count($falas) - 1;

            $falas[$posfala]->id        = $falaitm->id;
            $falas[$posfala]->sequencia = $falaitm->sequencia;
            $falas[$posfala]->npc       = '';
            $falas[$posfala]->humor     = '';
            $falas[$posfala]->texto     = '';
        }
    }

    $missao->falasnpc       = $falas;

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
    $html   = '';

    foreach ($mensagem as $linha)
    {
        $html   .= "- $linha<br />"; 
    }

    echo($html);
}
?>