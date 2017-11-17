<?php
if (($objarq = fopen($arquivocompl, 'r')) !== FALSE)
{
    $missoes  = array();
    
    while (($linha = fgetcsv($objarq, 100000, ',')) !== FALSE)
    {            
        $colunas        = count($linha);

        for ($coluna = 0; $coluna < $colunas; $coluna++)
        {
            if ($linha[$coluna] != 'Missão' && $linha[$coluna] != 'Nome')
            {
                switch ($coluna)
                {
                    case 0:
                        $missoes[]                      = new missao();
                        $pos                            = count($missoes) - 1;
                        $missoes[$pos]->nome            = $linha[$coluna];
                        break;
                    case 1:
                        $missoes[$pos]->titulo          = $linha[$coluna];
                        break;
                    case 2:
                        $missoes[$pos]->descricao       = $linha[$coluna];
                        break;
                    case 3:
                        $missoes[$pos]->ativo           = $linha[$coluna];
                        break;
                    case 4:
                        $missoes[$pos]->idmoodle        = $linha[$coluna];
                        break;
                    case 5:
                        $missoes[$pos]->ano             = $linha[$coluna];
                        break;
                    case 6:
                        $missoes[$pos]->semestre        = $linha[$coluna];
                        break;
                    case 7:
                        $missoes[$pos]->sequencia       = $linha[$coluna];
                        break;
                    case 8:
                        $missoes[$pos]->obrigatoria     = $linha[$coluna];
                        break;
                    case 9:
                        //buscar pai
                        $posbusca   = array_search($linha[$coluna], array_column($missoes, 'nome'));

                        if ($pos !== FALSE)
                        {
                            $missoes[$pos]->pai         = "¬missoes@$posbusca";
                        }
                        else
                        {
                            $missaobusca                = new missao();
                            $missaobusca->SelecionarPorNome($linha[$coluna]);

                            if ($missaobusca->id != null)
                            {
                                $missoes[$pos]->pai     = $missaobusca->id;
                            }
                            else
                            {
                                $missoes[$pos]->pai     = '¬X';
                            }
                        }

                        break;
                    case 10:
                    case 12:
                    case 14:
                    case 16:
                        $missoes[$pos]->eixos[]                 = new eixo();
                        $poseixo                                = count($missoes[$pos]->eixos);
                        $missoes[$pos]->eixos[$poseixo]->sigla  = $linha[coluna];
                        break;
                    case 11:
                    case 13:
                    case 15:
                    case 17:
                        $missoes[$pos]->eixos[$poseixo]->pontos = $linha[$coluna];
                        break;
                }
            }
        }
    }
}
?>