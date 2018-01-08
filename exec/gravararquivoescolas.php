<?php
$checados   = 0;
$resjson    = '[ ';

/* Verificação dos campos */
if (isset($_POST['chkimp']))            $checados   = $_POST['chkimp'];
if (isset($_POST['impNome']))           $nomes      = $_POST['impNome'];
if (isset($_POST['impBairro']))         $bairros    = $_POST['impBairro'];
if (isset($_POST['impCodCidade']))      $cidades    = $_POST['impCodCidade'];
if (isset($_POST['impEstado']))         $estados    = $_POST['impEstado'];
if (isset($_POST['impAtivo']))          $ativos     = $_POST['impAtivo'];

if ($checados > 0)
{
    $html   = '';
    $virg   = '';

    foreach ($checados as $indice => $checado)
    {
        $escola                 = new lib\escola();
        $escola->nome           = $nomes[$indice];
        $escola->bairro         = $bairros[$indice];
        $escola->cidade         = $cidades[$indice];
        $escola->estado         = $estados[$indice];
        $escola->ativo          = $ativos[$indice];

        $resultado  = $escola->Salvar();

        $resjson    .= "$virg{ \"nome\": \"$escola->nome\", " .
                       "\"cidade\": \"$escola->cidade\", " .
                       "\"estado\": \"$escola->estado\", ";

        switch ($resultado)
        {
            case -1:
                $resjson    .= "\"nivelerr\": 0, \"menserr\": \"OK\"";
                break;
            case 1:
                $resjson    .= "\"nivelerr\": 3, \"menserr\": \"Escola não salva\"";
                break;
            case 2:
                $resjson    .= "\"nivelerr\": 1, \"menserr\": \"Escola não salva por cidade inexistente\"";
                break;
            case 4:
                $resjson    .= "\"nivelerr\": 1, \"menserr\": \"Escola não salva por estado inexistente\"";
                break;
            case 6:
                $resjson    .= "\"nivelerr\": 2, \"menserr\": \"Escola não salva por cidade e estado inexistentes\"";
                break;
        }

        $resjson    .= ' }';
        $virg       = ', ';
    }

    $resjson    .= ' ]';
}
?>