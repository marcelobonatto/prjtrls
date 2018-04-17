<?php
namespace controles;

class campoarea
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura, $requerido, $linhas)
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
        echo("\t<textarea class=\"form-control$colsm\" id=\"$nomecontrole\" rows=\"$linhas\" name=\"$nomecontrole\"$readonly$txtreq>$valor</textarea>\n");
        echo("</div>\n");
    }
}
?>