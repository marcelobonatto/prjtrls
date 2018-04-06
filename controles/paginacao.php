<?php
namespace controles;

class paginacao
{
    public static function Gerar($pagina, $total)
    {
        $numpaginas     = intval(floor($total / 50) + 1);
        //array de botões: Primeiro, Anterior, ... Anterior, ... Posterior, Próximo e Último
        $botoes         = array('p' => false, 'a' => false, 'ra' => false, 'rx' => false, 'x' => false, 'u' => false);
        /*
        Página 1
        £1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | ... | Próximo > | Último >
    
        Página 2
        < Primeiro | < Anterior | 1 | £2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | ... | Próximo > | Último >
    
        Página 7
        < Primeiro | < Anterior | ... | 2 | 3 | 4 | 5 | £6 | 7 | 8 | 9 | 10 | 11 | ... | Próximo > | Último >
    
        Página 19
        < Primeiro | < Anterior | ... | 15 | 16 | 17 | 18 | £19 | 20 | 21 | 22 | 23 | 24 | ... | Próximo > | Último >
    
        Página 25
        < Primeiro | < Anterior | ... | 16 | 17 | 18 | 19 | 20 | 21 | 22 | 23 | 24 | £25
        */
        $botoes['p']    = ($pagina > 1);
        $botoes['a']    = ($pagina > 1);
        $botoes['x']    = ($pagina < $numpaginas);
        $botoes['u']    = ($pagina < $numpaginas);
        $botoes['ra']   = ($numpaginas > 10 && $pagina > 5);
        $botoes['rx']   = ($numpaginas > 10 && $pagina < $numpaginas - 5);

        //Páginas de 1 a 5 ou se o total de páginas forem até 10
        if ($pagina <= 5 || $numpaginas <= 10)
        {
            $min            = 1;
            $max            = ($numpaginas < 10 ? $numpaginas : 10);
        }
        //Páginas maiores que as 5 últimas páginas (ex: se tem 25 no total, então verifica se a página é de 21 a 25)
        else if ($pagina >= $numpaginas - 5)
        {
            $min            = ($numpaginas > 10 ? $numpaginas - 9 : $numpaginas);
            $max            = $numpaginas;
        }
        //Isto só executará se tiver mais de 10 páginas e se não forem as últimas páginas
        else
        {
            $min            = ($pagina - 4 < $numpaginas - 9 && $pagina + 5 < $numpaginas ? $pagina - 4 : $numpaginas - 9);
            $max            = ($pagina - 4 < $numpaginas - 9 && $pagina + 5 < $numpaginas ? $pagina + 5 : $numpaginas);
        }
    
        echo("<div class=\"row\">\n");
        echo("<div class=\"col-sm-6\">\n");

        $minreg = ((($pagina - 1) * 50) + 1);
        $maxreg = ($pagina * 50);

        if ($maxreg > $total)
        {
            $maxreg = $total;
        }

        echo("Listando registros de <strong>$minreg</strong> a <strong>$maxreg</strong> de um total de <strong>$total</strong>");
        echo("</div>\n");
        echo("<div class=\"col-sm-6\">\n");
        echo("<nav>\n");
        echo("\t<ul class=\"pagination flex-wrap justify-content-sm-end\">\n");
    
        if ($botoes['p'])
        {
            echo("\t\t<li class=\"page-item\">\n");
            echo("\t\t\t<a class=\"page-link\" href=\"javascript:carregarTabela(1);\">Primeiro</a>\n");
            echo("\t\t</li>\n");
        }
    
        if ($botoes['a'])
        {
            $ant    = $pagina - 1;
    
            echo("\t\t<li class=\"page-item\">\n");
            echo("\t\t\t<a class=\"page-link\" href=\"javascript:carregarTabela($ant);\">Anterior</a>\n");
            echo("\t\t</li>\n");
        }
    
        if ($botoes['ra'])
        {
            $minant = $min - 1;
    
            echo("\t\t<li class=\"page-item\">\n");
            echo("\t\t\t<a class=\"page-link\" href=\"javascript:carregarTabela($minant);\">...</a>\n");
            echo("\t\t</li>\n");
        }
    
        for ($pag = $min; $pag <= $max; $pag++)
        {
            $ativo      = '';
    
            if ($pag == $pagina)
            {
                $ativo  = ' active';
            }
    
            echo("\t\t<li class=\"page-item$ativo\"><a class=\"page-link\" href=\"javascript:carregarTabela($pag);\">$pag</a></li>\n");
        }
    
        if ($botoes['rx'])
        {
            $maxprox    = $max - 1;
    
            echo("\t\t<li class=\"page-item\">\n");
            echo("\t\t\t<a class=\"page-link\" href=\"javascript:carregarTabela($maxprox);\">...</a>\n");
            echo("\t\t</li>\n");
        }
    
        if ($botoes['x'])
        {
            $prox   = $pagina + 1;
    
            echo("\t\t<li class=\"page-item\">\n");
            echo("\t\t\t<a class=\"page-link\" href=\"javascript:carregarTabela($prox);\">Próximo</a>\n");
            echo("\t\t</li>\n");
        }
    
        if ($botoes['u'])
        {
            echo("\t\t<li class=\"page-item\">\n");
            echo("\t\t\t<a class=\"page-link\" href=\"javascript:carregarTabela($numpaginas);\">Último</a>\n");
            echo("\t\t</li>\n");
        }
        
        echo("\t</ul>\n");
        echo("</nav>\n");
        echo("</div>\n");
        echo("</div>\n");
    }
}
?>