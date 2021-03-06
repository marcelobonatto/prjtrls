<?php
namespace lib;

class roupa
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

        $sql    = "SELECT itemId, itemNome, itemNivel, itemTipo, itemCor, i.eixoId, COALESCE(e.eixoNome, 'Todos') AS eixoNome, itemLimite, itemBonus, itemPrecoNormal, itemAtivo " .
                  'FROM itens i ' .
                  'LEFT JOIN eixos e ON e.eixoId = i.eixoId ' .
                  "WHERE itemTipo = 'R' " .
                  'ORDER BY itemNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
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

    public function Selecionar($id)
    {
        $sql    = "SELECT itemId, itemNome, itemNivel, itemTipo, itemCor, i.eixoId, COALESCE(e.eixoNome, 'Todos') AS eixoNome, itemLimite, itemBonus, itemPrecoNormal, itemAtivo " .
                  'FROM itens i ' .
                  'LEFT JOIN eixos e ON e.eixoId = i.eixoId ' .
                  "WHERE itemId = '$id' " .
                  'ORDER BY itemNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $item   = $res[0];

                $this->id                    = $item[self::ITEM_ID];
                $this->nome                  = $item[self::ITEM_NOME];
                $this->nivel                 = $item[self::ITEM_NIVEL];
                $this->tipo                  = $item[self::ITEM_TIPO];
                $this->cor                   = $item[self::ITEM_COR];
                $this->eixo                  = $item[self::EIXO_ID];
                $this->eixoNome              = $item[self::EIXO_NOME];
                $this->limite                = $item[self::ITEM_LIMITE];
                $this->bonus                 = $item[self::ITEM_BONUS];
                $this->preconormal           = $item[self::ITEM_PRECONORMAL];
                $this->ativo                 = $item[self::ITEM_ATIVO];
            }
        }
    }

    public function Salvar()
    {
        if ($this->id == null)
        {
            $id     = '{ID}';
        }
        else
        {
            $id     = $this->id;
        }

        if ($this->eixo == '*')
        {
            $eixo   = 'NULL';
        }
        else
        {
            $eixo   = "'$this->eixo'";
        }

        if ($this->limite == null)
        {
            $limite   = -1;
        }
        else
        {
            $limite   = $this->limite;
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id, $eixo, $limite);
        }
        else
        {
            return $this->Atualizar($id, $eixo, $limite);
        }
    }

    public function Incluir($id, $eixo, $limite)
    {
        $sql    = 'INSERT INTO itens ' .
                  '(itemId, itemNome, itemNivel, itemTipo, itemCor, eixoId, itemLimite, itemBonus, itemPrecoNormal, itemAtivo) ' . 
                  "VALUES ('$id', '$this->nome', $this->nivel, '$this->tipo', NULL, $eixo, $limite, $this->bonus, $this->preconormal, $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id != null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Atualizar($id, $eixo, $limite)
    {
        $sql    = 'UPDATE itens ' .
                  "SET itemNome = '$this->nome', " .
                  "itemNivel = $this->nivel, " .
                  "itemCor = NULL, " .
                  "eixoId = $eixo, " .
                  "itemLimite = $limite, " .
                  "itemBonus = $this->bonus, " .
                  "itemPrecoNormal = $this->preconormal, " .
                  "itemAtivo = $this->ativo " .
                  "WHERE itemId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE itens ' .
                  "SET itemAtivo = $modo " .
                  "WHERE itemId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>