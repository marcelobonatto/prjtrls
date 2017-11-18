<?php
class missaoeixo
{
    public $id;
    public $missao;
    public $eixo;
    public $sigla;
    public $pontos;

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
        else
        {
            return $this->Atualizar($id);
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
}
?>