<?php
if (($objarq = fopen($arquivocompl, 'r')) !== FALSE)
{
    $perguntas  = array();

    while (($linha = fgetcsv($objarq, 100000, ',')) !== FALSE)
    {            
        $colunas        = count($linha);

        for ($coluna = 0; $coluna < $colunas; $coluna++)
        {
            if ($linha[$coluna] != 'Perguntas' && $linha[$coluna] != 'Código')
            {
                switch ($coluna)
                {
                    case 0:
                        $perguntas[]                    = new lib\perguntadf();
                        $pos                            = count($perguntas) - 1;
                        $perguntas[$pos]->codigo        = $linha[$coluna];
                        break;
                    case 1:
                        $perguntas[$pos]->enunciado     = $linha[$coluna];
                        break;
                    case 2:
                        $perguntas[$pos]->dificuldade   = $linha[$coluna];
                        break;
                    case 3:
                        $perguntas[$pos]->ativo         = $linha[$coluna];
                        break;
                    case 4:
                        $perguntas[$pos]->certa         = new lib\respostadf();
                        $perguntas[$pos]->certa->codigo = $linha[$coluna];
                        break;
                    case 5:
                        $perguntas[$pos]->certa->texto  = $linha[$coluna];
                        break;
                    case 6:
                    case 9:
                    case 12:
                    case 15:
                    case 18:
                    case 21:
                    case 24:
                    case 27:
                    case 30:
                    case 33:
                        if (strlen($linha[$coluna]) > 0)
                        {
                            $perguntas[$pos]->erradas[]                 = new lib\respostadf();
                            $posresp                                    = count($perguntas[$pos]->erradas) - 1;
                            $perguntas[$pos]->erradas[$posresp]->codigo = $linha[$coluna];
                        }
                        else
                        {
                            $posresp    = -1;
                        }

                        break;
                    case 7:
                    case 10:
                    case 13:
                    case 16:
                    case 19:
                    case 22:
                    case 25:
                    case 28:
                    case 31:
                    case 34:
                        if ($posresp    > -1)
                        {
                            if (strlen($linha[$coluna]) > 0)
                            {
                                $perguntas[$pos]->erradas[$posresp]->texto  = $linha[$coluna];
                            }
                            else
                            {
                                array_pop($perguntas[$pos]->erradas);
                                $posresp    = -1;
                            }
                        }

                        break;
                    case 8:
                    case 11:
                    case 14:
                    case 17:
                    case 20:
                    case 23:
                    case 26:
                    case 29:
                    case 32:
                    case 35:
                        if ($posresp    > -1)
                        {
                            if (strlen($linha[$coluna]) > 0)
                            {
                                $perguntas[$pos]->erradas[$posresp]->nivel  = $linha[$coluna];
                            }
                            else
                            {
                                array_pop($perguntas[$pos]->erradas);
                                $posresp    = -1;
                            }
                        }

                        break;
                }
            }
            else
            {
                break;
            }
        }
    }

    fclose($objarq);
}
else
{
    $erro   = 4;
}
?>