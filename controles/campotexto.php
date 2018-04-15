<?php
namespace controles;

class campotexto
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura)
    {
        $nomecontrole   = "txt$campo";
        $readonly       = '';
        $colsm          = '';

        if ($leitura)
        {
            $readonly   = " readonly=\"readonly\"";
        }

        if ($tamanho < 12)
        {
            $colsm      = " col-sm-$tamanho";
        }

        echo("<div class=\"form-group\">\n");
        echo("\t<label for=\"$nomecontrole\">$rotulo:</label>\n");
        echo("\t<input class=\"form-control$colsm\" type=\"text\" value=\"$valor\" id=\"$nomecontrole\" name=\"$nomecontrole\"$readonly />\n");
        echo("</div>\n");
    }
}
?>