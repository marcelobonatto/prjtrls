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
    public $status;

    public function SelecionarPorMissao($aluno, $missao)
    {
        $matriz = array();
        
        $sql    = 'SELECT jogadormissaoId, alunoId, jm.missaoId, m.missaoAno, m.missaoSemestre, m.missaoSequencia, m.missaoObrigatoria, m.missaoPai, ' .
                  'jogadormissaoAprovado, jogadormissaoCumprida, jogadormissaoJogando, jogadormissaoLiberada ' .
                  'FROM missaoaluno jm ' .
                  'JOIN missoes m ON m.missaoId = jm.missaoId ' .
                  "WHERE missaoId = '$missao' " .
                  "AND alunoId = '$aluno'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $jm                         = $res[0];

                $this->id                   = $jm[self::JOGADORMISSAO_ID];
                $this->aluno                = $jm[self::ALUNO_ID];
                $this->missao               = $jm[self::MISSAO_ID];
                $this->missaoAno            = $jm[self::MISSAO_ANO];
                $this->missaoSemestre       = $jm[self::MISSAO_SEMESTRE];
                $this->missaoSequencia      = $jm[self::MISSAO_SEQUENCIA];
                $this->missaoObrigatoria    = $jm[self::MISSAO_OBRIGATORIA];
                $this->missaoPai            = $jm[self::MISSAO_PAI];
                $this->aprovado             = $jm[self::JOGADORMISSAO_APROVADO];
                $this->cumprida             = $jm[self::JOGADORMISSAO_CUMPRIDA];
                $this->jogando              = $jm[self::JOGADORMISSAO_JOGANDO];
                $this->liberada             = $jm[self::JOGADORMISSAO_LIBERADA];
            }
        }
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
        else
        {
            return $this->Atualizar($id);
        }
    }

    public function Incluir($id)
    {
        $sql    = 'INSERT INTO missaoaluno ' .
                  '(missaoalunoId, missaoId, alunoId, statusMissao) ' .
                  "VALUES ('$id', '$this->missao', '$this->aluno', $this->status)";

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
                  "statusMissao = $this->status " .
                  "WHERE missaoalunoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>