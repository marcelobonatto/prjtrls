<?php
class bonusdiario
{
    public static function ObterDiaMaximo()
    {
        $max    = 1;

        $sql    = 'SELECT MAX(bonusDia) AS dia FROM bonusdiario';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $max    = $res[0]['dia'];
            }
        }

        return $max;
    }

    public static function ObterValorDia($dia)
    {
        $bonus  = 0;

        $sql    = "SELECT bonusQuantidade FROM bonusdiario WHERE bonusDia = $dia";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $bonus    = $res[0]['bonusQuantidade'];
            }
        }

        return $bonus;
    }
}
?>