<?php
class item
{
    const ITEM_ID			= 0;
    const ITEM_NOME			= 1;
    const ITEM_NIVEL		= 2;
    const ITEM_TIPO			= 3;
    const ITEM_COR 			= 4;
    const EIXO_ID			= 5;
    const EIXO_NOME         = 6;
    const ITEM_LIMITE		= 7;
    const ITEM_BONUS		= 8;
    const ITEM_PRECONORMAL	= 9;
    const ITEM_ATIVO		= 10;

    public $id;
    public $nome;
    public $nivel;
    public $tipo;
    public $cor;
    public $eixo;
    public $eixoNome;
    public $limite;
    public $bonus;
    public $preconormal;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT itemId, itemNome, itemNivel, itemTipo, itemCor, i.eixoId, eixoNome, itemLimite, itemBonus, itemPrecoNormal, itemAtivo ' .
                  'FROM itens i ' .
                  'JOIN eixos e ON e.eixoId = i.eixoId ' .
                  "WHERE itemTipo = 'I' " .
                  'ORDER BY itemNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                foreach ($res as $item)
                {
                    $obj                        = new item();
                    $obj->id                    = $item[self::ITEM_ID];
                    $obj->nome                  = $item[self::ITEM_NOME];
                    $obj->nivel                 = $item[self::ITEM_NIVEL];
                    $obj->tipo                  = $item[self::ITEM_TIPO];
                    $obj->cor                   = $item[self::ITEM_COR];
                    $obj->eixo                  = $item[self::EIXO_ID];
                    $obj->eixoNome              = $item[self::EIXO_NOME];
                    $obj->limite                = $item[self::ITEM_LIMITE];
                    $obj->bonus                 = $item[self::ITEM_BONUS];
                    $obj->preconormal           = $item[self::ITEM_PRECONORMAL];
                    $obj->ativo                 = $item[self::ITEM_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>