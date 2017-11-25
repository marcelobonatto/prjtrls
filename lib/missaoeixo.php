<?php
namespace lib;

class missaoeixo
{
    const MISSAOEIXO_ID     = 0;
    const MISSAO_ID         = 1;
    const EIXO_ID           = 2;
    const MISSAOEIXO_PONTOS = 3;

    public $id;
    public $missao;
    public $eixo;
    public $sigla;
    public $pontos;

    public function ListarPorMissao($missao)
    {
        $matriz = array();

        $sql    = 'SELECT missaoeixoId, missaoId, eixoId, missaoeixoPontos ' .
                  'FROM missoeseixo ' .
                  "WHERE missaoId = '$missao'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $eixo)
                {
                    $obj                = new missao();
                    $obj->id            = $eixo[self::MISSAOEIXO_ID];
                    $obj->missao        = $eixo[self::MISSAO_ID];
                    $obj->eixo          = $eixo[self::EIXO_ID];
                    $obj->pontos        = $eixo[self::MISSAOEIXO_PONTOS];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Salvar()
    {
        if ($this->id == null)
        {
            $id = '{ID}';
        }
        else
        {
            $id = $this->id;
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id);
        }
        else if ($this->pontos > 0)
        {
            return $this->Atualizar($id);
        }
        else
        {
            return $this->Excluir($id);
        }
    }

    public function Incluir($id)
    {
        $sql    = 'INSERT INTO missoeseixo ' .
                  '(missaoeixoId, missaoId, eixoId, missaoeixoPontos) ' .
                  "VALUES ('$id', '$this->missao', '$this->eixo', $this->pontos)";

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

    public function Atualizar($id)
    {
        $sql    = 'UPDATE missoeseixo ' .
                  "SET missaoId = '$this->missao', " .
                  "eixoId = '$this->eixo', " .
                  "missaoeixoPontos = $this->pontos " .
                  "WHERE missaoeixoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Excluir($id)
    {
        $sql        = "DELETE FROM missoeseixo WHERE missaoeixoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>