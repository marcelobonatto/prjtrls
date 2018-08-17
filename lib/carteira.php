<?php
namespace lib;

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
                    $obj->limite                = $item[self::ITEM_LIMITE];
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
        $sql    = "SELECT itemId, itemNome, itemNivel, itemTipo, itemLimite, itemBonus, itemPrecoNormal, itemAtivo " .
                  'FROM itens i ' .
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
                $this->limite                = $item[self::ITEM_LIMITE];
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
            return $this->Incluir($id, $limite);
        }
        else
        {
            return $this->Atualizar($id, $limite);
        }
    }

    public function Incluir($id, $limite)
    {
        $sql    = 'INSERT INTO itens ' .
                  '(itemId, itemNome, itemNivel, itemTipo, itemLimite, itemPrecoNormal, itemAtivo) ' . 
                  "VALUES ('$id', '$this->nome', $this->nivel, '$this->tipo', $this->limite, $this->preconormal, $this->ativo)";

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

    public function Atualizar($id, $limite)
    {
        $sql    = 'UPDATE itens ' .
                  "SET itemNome = '$this->nome', " .
                  "itemNivel = $this->nivel, " .
                  "itemLimite = $this->limite, " .
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