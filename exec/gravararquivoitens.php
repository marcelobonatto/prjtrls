<?php
$checados   = 0;
$resjson    = '[ ';

/* Verificação dos campos */
if (isset($_POST['chkimp']))            $checados   = $_POST['chkimp'];
if (isset($_POST['impNome']))           $nomes      = $_POST['impNome'];
if (isset($_POST['impNivel']))          $niveis     = $_POST['impNivel'];
if (isset($_POST['impTipo']))           $tipos      = $_POST['impTipo'];
if (isset($_POST['impEixo']))           $eixos      = $_POST['impEixo'];
if (isset($_POST['impLimite']))         $limites    = $_POST['impLimite'];
if (isset($_POST['impBonus']))          $bonus      = $_POST['impBonus'];
if (isset($_POST['impPreco']))          $precos     = $_POST['impPreco'];

if ($checados > 0)
{
    $html   = '';
    $virg   = '';

    foreach ($checados as $indice => $checado)
    {
        $itens                  = new lib\item();
        $itens->nome            = $nomes[$indice];
        $itens->nivel           = $niveis[$indice];
        $itens->tipo            = $tipos[$indice];
        $itens->eixo            = $eixos[$indice];
        $itens->limite          = $limites[$indice];
        $itens->bonus           = $bonus[$indice];
        $itens->preconormal     = $precos[$indice];
        $itens->ativo           = 1;

        $resultado  = $itens->Salvar();

        $resjson    .= "$virg{ \"item\": \"$itens->nome\", " .
                       "\"tipo\": \"$itens->tipo\", ";

        switch ($resultado)
        {
            case -1:
                $resjson    .= "\"nivelerr\": 0, \"menserr\": \"OK\"";
                break;
            case 1:
                $resjson    .= "\"nivelerr\": 3, \"menserr\": \"Item não salvo\"";
                break;
        }

        $resjson    .= ' }';
        $virg       = ', ';
    }

    $resjson    .= ' ]';
}
?>