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
                        $escolas[$pos]->cidadenome  = $linha[$coluna];
                        break;
                    case 3:
                        $escolas[$pos]->estado      = $linha[$coluna];
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