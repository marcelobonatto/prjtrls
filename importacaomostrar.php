<?php

function mostrarArquivo($jsonimp, $valores, $acaoform)
{    
    $rowspan    = '';
    $spanlinhac = 1;

    if ($jsonimp->temsub)
    {
        $spanlinhac = 2;
    }

    $numlinhas  = 0;
    $numcolunas = 0;

    $tabela     = new lib\ui\tabela();

    //Criação dos títulos
    $linhaobj   = criarTabelaTitulo($tabela, $numlinhas);
    $celulaobj  = criarTabelaLinhaTitulo($linhaobj, $numcolunas, $spanlinhac, 1, 'center', '&nbsp;');

    $numcolunas++;

    if ($jsonimp->temsub)
    {
        $numlinhas++;
        $linhasub   = criarTabelaTitulo($tabela, $numlinhas);
    }

    $numcolunasub   = 0;

    foreach ($jsonimp->colunas as $jitem)
    {
        if ($jitem->subtitulo == '')
        {
            criarTabelaLinhaTitulo($linhaobj, $numcolunas, $spanlinhac, 1, 'left', $jitem->titulo);
            $numcolunas++;
        }
        else
        {
            if ($jitem->colunas > 1)
            {
                criarTabelaLinhaTitulo($linhaobj, $numcolunas, 1, $jitem->colunas, 'center', $jitem->titulo);
                $numcolunas++;
            }

            criarTabelaLinhaTitulo($linhasub, $numcolunasub, 1, 1, 'left', $jitem->subtitulo);
            $numcolunasub++;                                
        }                            
    }

    $numlinhas++;

    //Criação das linhas
    $varitm = $jsonimp->objeto->variavelitem;

    foreach ($valores as $numlinha => $item)
    {
        $linhasjuntas   = 1;
        $numcolunas     = 0;

        foreach ($jsonimp->matrizes as $matriz)
        {
            $propmatriz     = $matriz->matriz;

            $arrsubcls[]    = $item->$propmatriz;
            $varsubitm[]    = $matriz->variavelitem;
            $contarrsub     = count($item->$propmatriz);

            if ($linhasjuntas < $contarrsub)
            {
                $linhasjuntas   = $contarrsub;
            }
        }

        $linha  = criarTabelaNormal($tabela, $numlinhas);
        criarCelulaCheckBox($linha, $numcolunas, $linhasjuntas, 1, 'center', '1', true, 'imp', '', true, true);
        $numcolunas++;

        foreach ($jsonimp->colunas as $jitem)
        {
            $campo      = $jitem->campo;
            $prop       = $jitem->propsup;
            $ehsub      = false;

            if ($prop == '')
            {
                $valor      = $item->$campo;
            }
            else
            {
                $chave      = array_search($prop, $varsubitm);

                if ($chave === FALSE)
                {
                    $valor  = $item->$prop->$campo;
                }
                else
                {
                    $arrvlr = $arrsubcls[$chave];
                    $ehsub  = true;
                }
            }

            $controle       = $jitem->controle;
            $chknome        = '';
            $acrescimo      = 0;

            if (!$ehsub)
            {
                $checado        = false;

                if ($jitem->tipo == 'check')
                {
                    $checado    = ($valor == 1);
                    $chknome    = $controle;
                }    

                criarCelulaControle($linha, $numcolunas, $linhasjuntas, 1, 'left', $jitem->tipo, $valor, $checado, $chknome, $controle, true, false, -1, '');
                $acrescimo++;
            }
            else
            {
                $numlinmny      = $numlinhas;
                $linhavarios    = null;

                foreach ($arrvlr as $vlrs)
                {
                    if ($numlinmny != $numlinhas)
                    {
                        if (!array_key_exists($numlinmny, $tabela->linhas))
                        {
                            $linhavarios    = criarTabelaNormal($tabela, $numlinmny);
                        }
                        else
                        {
                            $linhavarios    = $tabela->linhas[$numlinmny];
                        }
                    }
                    else
                    {
                        $linhavarios        = $tabela->linhas[$numlinmny];
                    }

                    $valor          = $vlrs->$campo;
                    $checado        = false;
                    
                    if ($jitem->tipo == 'check')
                    {
                        $checado    = ($valor == 1);
                        $chknome    = $controle;
                    }

                    criarCelulaControle($linhavarios, $numcolunas, 1, 1, 'left', $jitem->tipo, $valor, $checado, $chknome, $controle, true, false, $numlinha, '');

                    $acrescimo++;
                    $numlinmny++;
                }
            }

            $numcolunas++;
        }
        
        $numlinhas += $acrescimo;
    }

    echo("<form action=\"$acaoform.php\" method=\"post\">\n");
    echo($tabela->Gerar());
    echo("<button class=\"btn btn-info\">Gravar Selecionados</button>\n");
    echo("</form>\n");
}

function mostrarFinal($valcols, $valores)
{
    $numlinhas  = 0;
    $numcolunas = 0;

    $tabela = new lib\ui\tabela();
    $linha  = criarTabelaTitulo($tabela, $numlinhas);
    
    foreach ($valcols as $numcoluna => $valcol)
    {
        criarTabelaLinhaTitulo($linha, $numcoluna, 1, 1, 'left', $valcol->titulo);
        $numcolunas = $numcoluna;
    }

    $numcolunas++;
    criarTabelaLinhaTitulo($linha, $numcolunas, 1, 1, 'left', 'Resultado');

    $totalcolunas   = $numcolunas;

    $numlinhas++;

    foreach ($valores as $valor)
    {
        $linha  = criarTabelaNormal($tabela, $numlinhas);

        for ($poscol = 0; $poscol <= $totalcolunas; $poscol++)
        {
            if ($poscol == $totalcolunas)
            {
                switch ($valor->nivelerr)
                {
                    case 0:
                        $classe = 'bg-success';
                        break;
                    case 1:
                        $classe = 'bg-info';
                        break;
                    case 2:
                        $classe = 'bg-warning';
                        break;
                    case 3:
                        $classe = 'bg-danger';
                        break;
                }

                criarCelulaTextoComClasse($linha, $poscol, 1, 1, 'left', $valor->menserr, $classe);
            }
            else
            {
                $nmcampo    = $valcols[$poscol]->campo;
                $vlcampo    = $valor->$nmcampo;

                criarCelulaTexto($linha, $poscol, 1, 1, 'left', $vlcampo);
            }
        }

        $numlinhas++;
    }

    echo($tabela->Gerar());
}

function criarTabelaTitulo($tabela, $numlinha)
{
    return criarLinha($tabela, $numlinha, true);
}

function criarTabelaNormal($tabela, $numlinha)
{
    return criarLinha($tabela, $numlinha, false);
}

function criarLinha($tabela, $numlinha, $ehtitulo)
{
    $tabela->linhas[$numlinha]              = new lib\ui\linhatabela();
    $tabela->linhas[$numlinha]->ehtitulo    = $ehtitulo;

    return $tabela->linhas[$numlinha];
}

function criarTabelaLinhaTitulo($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, $valor)
{
    return criarCelulaControle($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, 'texto', $valor, false, '', '', false, false, -1, '');
}

function criarCelulaTexto($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, $valor)
{
    return criarCelulaControle($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, 'texto', $valor, false, '', '', false, false, -1, '');
}

function criarCelulaTextoComClasse($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, $valor, $classe)
{
    return criarCelulaControle($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, 'texto', $valor, false, '', '', false, false, -1, $classe);
}

function criarCelulaCheckBox($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, $valor, $checado, $nomecontrole, $nomectrlhidden, $ehmatriz, $habilitado)
{
    return criarCelulaControle($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, 'check', $valor, $checado, $nomecontrole, $nomectrlhidden, $ehmatriz, $habilitado, -1, '');
}

function criarCelulaControle($linha, $numcoluna, $spanlinha, $spancoluna, $alinhamento, $tipo, $valor, $checado, $nomecontrole, $nomectrlhidden, $ehmatriz, $habilitado, $pai, $classe)
{
    $linha->celulas[$numcoluna]                     = new lib\ui\celulatabela();
    $linha->celulas[$numcoluna]->spanlinha          = $spanlinha;
    $linha->celulas[$numcoluna]->spancoluna         = $spancoluna;
    $linha->celulas[$numcoluna]->alinhamento        = $alinhamento;
    $linha->celulas[$numcoluna]->tipovalor          = $tipo;
    $linha->celulas[$numcoluna]->valor              = $valor;
    $linha->celulas[$numcoluna]->checado            = $checado;
    $linha->celulas[$numcoluna]->nomecontrole       = $nomecontrole;
    $linha->celulas[$numcoluna]->ehmatrizcontr      = $ehmatriz;
    $linha->celulas[$numcoluna]->nomecontresc       = $nomectrlhidden;
    $linha->celulas[$numcoluna]->ehmatrizcontr      = $ehmatriz;
    $linha->celulas[$numcoluna]->habilitado         = $habilitado;
    $linha->celulas[$numcoluna]->indicepai          = $pai;
    $linha->celulas[$numcoluna]->classe             = $classe;

    return $linha;
}
?>