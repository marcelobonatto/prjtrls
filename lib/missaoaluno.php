<?php
namespace lib;

class missaoaluno
{
    const MISSAOALUNO_ID     = 0;
    const MISSAO_ID          = 1;
    const ALUNO_ID           = 2;
    const STATUSMISSAO       = 3;

    public $id;
    public $missao;
    public $aluno;
    public $statusMissao;

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
        $sql    = 'INSERT INTO missaoaluno ' .
                  '(missaoalunoId, missaoId, alunoId, statusMissao) ' .
                  "VALUES ('$id', '$this->missao', '$this->aluno', $this->statusMissao)";

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
        $sql    = 'UPDATE missaoaluno ' .
                  "SET missaoId = '$this->missao', " .
                  "alunoId = '$this->aluno', " .
                  "statusMissao = $this->statusMissao " .
                  "WHERE missaoalunoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>