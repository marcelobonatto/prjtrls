<?php
$checados   = 0;
$resjson    = '[ ';

/* Verificação dos campos */
if (isset($_POST['chkimp']))            $checados       = $_POST['chkimp'];
if (isset($_POST['impNome']))           $nomes          = $_POST['impNome'];
if (isset($_POST['impTitulo']))         $titulos        = $_POST['impTitulo'];
if (isset($_POST['impDescricao']))      $descricoes     = $_POST['impDescricao'];
if (isset($_POST['impAtivo']))          $ativos         = $_POST['impAtivo'];
if (isset($_POST['impIdMoodle']))       $idsmoodle      = $_POST['impIdMoodle'];
if (isset($_POST['impAno']))            $anos           = $_POST['impAno'];
if (isset($_POST['impSemestre']))       $semestres      = $_POST['impSemestre'];
if (isset($_POST['impSequencia']))      $sequencias     = $_POST['impSequencia'];
if (isset($_POST['impObrigatoria']))    $obrigatorias   = $_POST['impObrigatoria'];
if (isset($_POST['impPai']))            $pais           = $_POST['impPai'];
if (isset($_POST['impNomePai']))        $nomespai       = $_POST['impNomePai'];
if (isset($_POST['impEixo']))           $eixos          = $_POST['impEixo'];
if (isset($_POST['impEixoPontos']))     $eixospontos    = $_POST['impEixoPontos'];

if ($checados > 0)
{
    $html   = '';
    $virg   = '';

    foreach ($checados as $indice => $checado)
    {
        $missao                 = new lib\missao();
        $missao->nome           = $nomes[$indice];
        $missao->titulo         = $titulos[$indice];        
        $missao->descricao      = $descricoes[$indice];
        $missao->ativo          = $ativos[$indice];
        $missao->idMoodle       = $idsmoodle[$indice];
        $missao->ano            = $anos[$indice];
        $missao->semestre       = $semestres[$indice];
        $missao->sequencia      = $sequencias[$indice];
        $missao->obrigatoria    = $obrigatorias[$indice];
        
        if (strrpos($nomespai[$indice], '{aincluir}') !== FALSE)
        {
            $posidpai               = str_replace('{aincluir}', '', $nomespai[$indice]);
            $missao->pai            = $idsmissao[$posidpai];
        }
        else if (strpos($nomespai[$indice], '{nãoexiste}') === FALSE)
        {
            $missao->pai            = $pais[$indice];
            $missao->painome        = $nomespai[$indice];
        }
        else
        {
            $missao->pai            = '';
            $missao->painome        = '';
        }

        $conteixos              = count($eixospontos[$indice]);
        $missao->eixos          = array($conteixos);

        for ($poseixo = 0; $poseixo < $conteixos; $poseixo++)
        {
            $objeixo    = new lib\eixo();
            $objeixo->SelecionarPorSigla($eixos[$indice][$poseixo]);
            
            if ($objeixo->id != null)
            {
                $missao->eixos[$poseixo]            = new lib\missaoeixo();
                $missao->eixos[$poseixo]->eixo      = $objeixo->id;
                $missao->eixos[$poseixo]->pontos    = $eixospontos[$indice][$poseixo];
            }
        }
        
        $resultado          = $missao->Salvar();
        $idsmissao[$indice] = $missao->id;

        $resjson            .= "$virg{ \"nome\": \"$missao->nome\", " .
                               "\"titulo\": \"$missao->titulo\", ";

        switch ($resultado)
        {
            case -1:
                $resjson    .= "\"nivelerr\": 0, \"menserr\": \"OK\"";
                break;
            case 1:
                $resjson    .= "\"nivelerr\": 3, \"menserr\": \"Missão não salva\"";
                break;
            case 2:
                $resjson    .= "\"nivelerr\": 2, \"menserr\": \"Eixos não salvos\"";
                break;
        }

        $resjson    .= ' }';
        $virg       = ', ';
    }

    $resjson    .= ' ]';
}
?>