<?php
$checados   = 0;
$resjson    = '[ ';

/* Verificação dos campos */
if (isset($_POST['chkimp']))            $checados   = $_POST['chkimp'];
if (isset($_POST['impCodigo']))         $codigos    = $_POST['impCodigo'];
if (isset($_POST['impPergunta']))       $enunciados = $_POST['impPergunta'];
if (isset($_POST['impDificuldade']))    $niveis     = $_POST['impDificuldade'];
if (isset($_POST['impAtivo']))          $ativos     = $_POST['impAtivo'];
if (isset($_POST['impCodigoCerta']))    $certacod   = $_POST['impCodigoCerta'];
if (isset($_POST['impTextoCerta']))     $certatxt   = $_POST['impTextoCerta'];
if (isset($_POST['impCodigoErrada']))   $erradacod  = $_POST['impCodigoErrada'];
if (isset($_POST['impTextoErrada']))    $erradatxt  = $_POST['impTextoErrada'];
if (isset($_POST['impNivelErrada']))    $erradaniv  = $_POST['impNivelErrada'];

if ($checados > 0)
{
    $html   = '';
    $virg   = '';

    foreach ($checados as $indice => $checado)
    {
        $pergunta                   = new lib\perguntadf();
        $pergunta->enunciado        = $enunciados[$indice];
        $pergunta->codigo           = $codigos[$indice];
        $pergunta->dificuldade      = $niveis[$indice];
        $pergunta->ativo            = $ativos[$indice];
        
        $pergunta->certa            = new lib\respostadf();
        $pergunta->certa->codigo    = $certacod[$indice];
        $pergunta->certa->texto     = $certatxt[$indice];
        $pergunta->certa->nivel     = 10;

        $conterr                    = count($erradacod[$indice]);
        $pergunta->erradas          = array($conterr);

        for ($poserr = 0; $poserr < $conterr; $poserr++)
        {
            $pergunta->erradas[$poserr]         = new lib\respostadf();
            $pergunta->erradas[$poserr]->codigo = $erradacod[$indice][$poserr];
            $pergunta->erradas[$poserr]->texto  = $erradatxt[$indice][$poserr];
            $pergunta->erradas[$poserr]->nivel  = $erradaniv[$indice][$poserr];
        }

        $resultado  = $pergunta->Salvar();

        $resjson    .= "$virg{ \"codigo\": \"$pergunta->codigo\", " .
                       "\"pergunta\": \"$pergunta->enunciado\", ";

        switch ($resultado)
        {
            case -1:
                $resjson    .= "\"nivelerr\": 0, \"menserr\": \"OK\"";
                break;
            case 1:
                $resjson    .= "\"nivelerr\": 3, \"menserr\": \"Pergunta não salva\"";
                break;
            case 2:
                $resjson    .= "\"nivelerr\": 1, \"menserr\": \"Resposta certa não salva\"";
                break;
            case 4:
                $resjson    .= "\"nivelerr\": 1, \"menserr\": \"Alguma resposta errada não foi salva\"";
                break;
            case 6:
                $resjson    .= "\"nivelerr\": 2, \"menserr\": \"Algumas respostas não foram salvas\"";
                break;
        }

        $resjson    .= ' }';
        $virg       = ', ';
    }

    $resjson    .= ' ]';
}
?>