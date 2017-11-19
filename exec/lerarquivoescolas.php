<?php
if (($objarq = fopen($arquivocompl, 'r')) !== FALSE)
{
    $escolas  = array();

    while (($linha = fgetcsv($objarq, 100000, ',')) !== FALSE)
    {            
        $colunas        = count($linha);

        for ($coluna = 0; $coluna < $colunas; $coluna++)
        {
            if ($linha[$coluna] != 'Unidades de Ensino' && $linha[$coluna] != 'Nome')
            {
                switch ($coluna)
                {
                    case 0:
                        $escolas[]                  = new escola();
                        $pos                        = count($escolas) - 1;
                        $escolas[$pos]->nome        = $linha[$coluna];
                        break;
                    case 1:
                        $escolas[$pos]->bairro      = $linha[$coluna];
                        break;
                    case 2:
                        $cidade                     = new cidade();
                        $cidade->SelecionarPorNome($linha[$coluna]);

                        if ($cidade->codigo != null)
                        {
                            $escolas[$pos]->cidade      = $cidade->codigo;
                            $escolas[$pos]->cidadenome  = $cidade->nome;
                        }
                        else
                        {
                            $escolas[$pos]->cidade      = null;
                            $escolas[$pos]->cidadenome  = null;
                        }

                        break;
                    case 3:
                        $estado                     = new estado();
                        $estado->SelecionarPorSigla($linha[$coluna]);

                        if ($estado->sigla != null)
                        {
                            $escolas[$pos]->estado      = $estado->sigla;
                        }
                        else
                        {
                            $escolas[$pos]->estado      = null;
                        }

                        break;
                    case 4:
                        $escolas[$pos]->ativo       = $linha[$coluna];
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