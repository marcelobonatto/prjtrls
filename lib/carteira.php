<?php
class carteira
{
    const ITEM_ID			= 0;
    const ITEM_NOME			= 1;
    const ITEM_NIVEL		= 2;
    const ITEM_TIPO			= 3;
    const ITEM_LIMITE		= 4;
    const ITEM_PRECONORMAL	= 5;
    const ITEM_ATIVO		= 6;

    public $id;
    public $nome;
    public $nivel;
    public $tipo;
    public $limite;
    public $preconormal;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT itemId, itemNome, itemNivel, itemTipo, itemLimite, itemPrecoNormal, itemAtivo ' .
                  'FROM itens i ' .
                  "WHERE itemTipo = 'C' " .
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
                    $obj->limite                = $item[self::ITEM_LIMITE];
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