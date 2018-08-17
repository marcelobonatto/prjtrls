<?php
namespace controles;

class campotexto
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura)
    {
        campotexto::GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, 'text', false, '');
    }

    public static function GerarRequerido($rotulo, $campo, $valor, $tamanho, $leitura)
    {
        campotexto::GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, 'text', true, '');
    }

    public static function GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, $tipo, $requerido, $outrasprop)
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
        echo("\t<input class=\"form-control$colsm\" type=\"$tipo\" value=\"$valor\" id=\"$nomecontrole\" name=\"$nomecontrole\"$readonly $outrasprop />\n");
        echo("</div>\n");
    }
}
?>