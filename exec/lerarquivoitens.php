<?php
if (($objarq = fopen($arquivocompl, 'r')) !== FALSE)
{
    $itens  = array();

    while (($linha = fgetcsv($objarq, 100000, ',')) !== FALSE)
    {            
        $colunas        = count($linha);

        for ($coluna = 0; $coluna < $colunas; $coluna++)
        {
            if ($linha[$coluna] != 'Item' && $linha[$coluna] != 'Nome')
            {
                switch ($coluna)
                {
                    case 0:
                        $itens[]                        = new lib\item();
                        $pos                            = count($itens) - 1;
                        $itens[$pos]->nome              = $linha[$coluna];
                        break;
                    case 1:
                        $itens[$pos]->nivel             = $linha[$coluna];
                        break;
                    case 2:
                        $itens[$pos]->tipo              = $linha[$coluna];
                        break;
                    case 3:
                        $itens[$pos]->eixo              = $linha[$coluna];
                        break;
                    case 4:
                        $itens[$pos]->limite            = $linha[$coluna];
                        break;
                    case 5:
                        $itens[$pos]->bonus             = $linha[$coluna];
                        break;
                    case 6:
                        $itens[$pos]->preconormal       = $linha[$coluna];
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