<?php
namespace controles;

class botoescadastro
{
    public static function Gerar()
    {
        echo("<hr />\n");
        echo("<button class=\"btn btn-info\">\n");
        echo("\tGravar\n");
        echo("</button>\n");
        echo("<button id=\"cmdVoltar\" type=\"button\" class=\"btn btn-danger\">\n");
        echo("\tVoltar\n");
        echo("</button>\n");
    }
}
?>