<?php
namespace lib;

class eixomissaoeixo
{
    const MISSAOEIXO_ID     = 0;
    const EIXO_ID           = 1;
    const EIXO_NOME         = 2;
    const MISSAOEIXO_PONTOS = 3;

    public $id;
    public $missao;
    public $eixo;
    public $eixoNome;
    public $pontos;

    public function ListarRegistros($missao)
    {
        $matriz = array();

        $sql    = 'SELECT me.missaoeixoId, e.eixoId, e.eixoNome, me.missaoeixoPontos ' .
                  'FROM	eixos e ' .
                  'LEFT JOIN missoeseixo me ON me.eixoId = e.eixoId ' .
                  "AND me.missaoId = '$missao'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $eixo)
                {
                    $obj                = new eixomissaoeixo();
                    $obj->id            = $eixo[self::MISSAOEIXO_ID];
                    $obj->missao        = $missao;
                    $obj->eixo          = $eixo[self::EIXO_ID];
                    $obj->eixoNome      = $eixo[self::EIXO_NOME];
                    $obj->pontos        = $eixo[self::MISSAOEIXO_PONTOS];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>