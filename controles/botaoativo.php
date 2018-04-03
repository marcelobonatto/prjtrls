<?php
namespace controles;

class botaoativo
{
    public static function Gerar($rotulo, $valor, $nomectrl, $opcao1, $ropcao1, $opcao0, $ropcao0)
    {
        echo("<div class=\"form-group\">\n");
        echo("\t<label>$rotulo:</label>\n");
        echo("\t<br />\n");

        if ($valor == 1)
            {
                $ativo1 = ' active';
                $check1 = ' checked';
                $ativo0 = '';
                $check0 = '';
            }
            else
            {
                $ativo1 = '';
                $check1 = '';
                $ativo0 = ' active';
                $check0 = ' checked';
            }

        echo("\t<div class=\"btn-group\" data-toggle=\"buttons\">\n");
        echo("\t\t<label class=\"btn btn-success$ativo1\">\n");
        echo("\t\t\t<input type=\"radio\" name=\"opt$nomectrl\" id=\"opt$opcao1\" autocomplete=\"off\" value=\"1\"$check1> $ropcao1\n");
        echo("\t\t</label>\n");
        echo("\t\t<label class=\"btn btn-secondary$ativo0\">\n");
        echo("\t\t\t<input type=\"radio\" name=\"opt$nomectrl\" id=\"opt$opcao0\" autocomplete=\"off\" value=\"0\"$check0> $ropcao0\n");
        echo("\t\t</label>\n");
        echo("\t</div>\n");
        echo("</div>\n");
    }
}
?>