<?php
namespace controles;

class camponumero
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura, $requerido, $minimo, $maximo)
    {
        $nomecontrole   = "txt$campo";
        $readonly       = '';
        $colsm          = '';
        $txtreq         = '';

        if ($leitura)
        {
            $readonly   = " readonly=\"readonly\"";
        }

        if ($tamanho < 12)
        {
            $colsm      = " col-sm-$tamanho";
        }

        $minmax         = '';

        if ($minimo != null)
        {
            $minmax     = " min=\"$minimo\"";
        }

        if ($maximo != null)
        {
            $minmax     .= " max=\"$maximo\"";
        }

        if ($requerido)
        {
            $txtreq     = " required";
        }

        echo("<div class=\"form-group\">\n");
        echo("\t<label for=\"$nomecontrole\">$rotulo:</label>\n");
        echo("\t<input class=\"form-control$colsm\" type=\"number\" value=\"$valor\"$minmax id=\"$nomecontrole\" name=\"$nomecontrole\"$readonly$txtreq />\n");
        echo("</div>\n");
    }
}
?>