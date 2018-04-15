<?php
namespace controles;

class comboexterno
{
    public static function Gerar($rotulo, $campo, $valor, $classe, $campotexto, $campovalor)
    {
        $nomecontrole   = "cmb$campo";

        echo("<div class=\"form-group\">\n");
        echo("\t<label for=\"$nomecontrole\">$rotulo:</label>\n");

        $seltxt         = ' selected="selected"';
        $selecionado    = ($valor == "*");

        if ($selecionado)
        {
            $seltxtef   = $seltxt;
        }
        else
        {
            $seltxtef   = '';
        }
        
        $opcoes     = "<option value=\"*\"$seltxtef>[ Selecione ]</option>";

        $objeto     = new $classe();
        $lista      = $objeto->ListarCombo();

        foreach ($lista as $item)
        {
            $selecionado    = ($valor == $item->$campovalor);
            
            if ($selecionado)
            {
                $seltxtef   = $seltxt;
            }
            else
            {
                $seltxtef   = '';
            }

            $cmpvlr = $item->$campovalor;
            $cmptxt = $item->$campotexto;

            $opcoes .= "<option value=\"$cmpvlr\"$seltxtef>$cmptxt</option>";
        }

        echo("\t<select class=\"form-control col-sm-3\" id=\"$nomecontrole\" name=\"$nomecontrole\" required>\n");
        echo("\t\t$opcoes\n"); 
        echo("\t</select>\n");
        echo("</div>\n");
    }
}
?>