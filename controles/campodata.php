<?php
namespace controles;

class campodata
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura, $requerido)
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

        if ($requerido)
        {
            $txtreq     = " required";
        }

        echo("<div class=\"form-group\">\n");
        echo("\t<label for=\"$nomecontrole\">$rotulo:</label>\n");
        echo("\t<input class=\"form-control$colsm\" type=\"date\" value=\"$valor\" id=\"$nomecontrole\" name=\"$nomecontrole\"$readonly$txtreq />\n");
        echo("</div>\n");
    }
}
?>