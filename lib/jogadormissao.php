<?php
namespace lib;

class jogadormissao
{
    const JOGADORMISSAO_ID          = 0;
    const ALUNO_ID                  = 1;
    const MISSAO_ID                 = 2;
    const MISSAO_ANO                = 3;
    const MISSAO_SEMESTRE           = 4;
    const MISSAO_SEQUENCIA          = 5;
    const MISSAO_OBRIGATORIA        = 6;
    const MISSAO_PAI                = 7;
    const JOGADORMISSAO_APROVADO    = 8;
    const JOGADORMISSAO_CUMPRIDA    = 9;
    const JOGADORMISSAO_JOGANDO     = 10;
    const JOGADORMISSAO_LIBERADA    = 11;

    public $id;
    public $aluno;
    public $missao;
    public $missaoAno;
    public $missaoSemestre;
    public $missaoSequencia;
    public $missaoObrigatoria;
    public $missaoPai;
    public $aprovado;
    public $cumprida;
    public $jogando;
    public $liberada;

    public function SelecionarPorMissao($aluno, $missao)
    {
        $matriz = array();
        
        $sql    = 'SELECT jogadormissaoId, alunoId, jm.missaoId, m.missaoAno, m.missaoSemestre, m.missaoSequencia, m.missaoObrigatoria, m.missaoPai, ' .
                  'jogadormissaoAprovado, jogadormissaoCumprida, jogadormissaoJogando, jogadormissaoLiberada ' .
                  'FROM jogadoresmissao jm ' .
                  'JOIN missoes m ON m.missaoId = jm.missaoId ' .
                  "WHERE missaoId = '$missao' " .
                  "AND alunoId = '$aluno'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

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

    public function ListarPorJogador($aluno)
    {
        $matriz = array();

        $sql    = 'SELECT jogadormissaoId, alunoId, jm.missaoId, m.missaoAno, m.missaoSemestre, m.missaoSequencia, m.missaoObrigatoria, m.missaoPai, ' .
                  'jogadormissaoAprovado, jogadormissaoCumprida, jogadormissaoJogando, jogadormissaoLiberada ' .
                  'FROM jogadoresmissao jm ' .
                  'JOIN missoes m ON m.missaoId = jm.missaoId ' .
                  "WHERE alunoId = '$aluno'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $jm)
                {
                    $obj                    = new jogadormissao();
                    $obj->id                = $jm[self::JOGADORMISSAO_ID];
                    $obj->aluno             = $jm[self::ALUNO_ID];
                    $obj->missao            = $jm[self::MISSAO_ID];
                    $obj->missaoAno         = $jm[self::MISSAO_ANO];
                    $obj->missaoSemestre    = $jm[self::MISSAO_SEMESTRE];
                    $obj->missaoSequencia   = $jm[self::MISSAO_SEQUENCIA];
                    $obj->missaoObrigatoria = $jm[self::MISSAO_OBRIGATORIA];
                    $obj->missaoPai         = $jm[self::MISSAO_PAI];
                    $obj->aprovado          = $jm[self::JOGADORMISSAO_APROVADO];
                    $obj->cumprida          = $jm[self::JOGADORMISSAO_CUMPRIDA];
                    $obj->jogando           = $jm[self::JOGADORMISSAO_JOGANDO];
                    $obj->liberada          = $jm[self::JOGADORMISSAO_LIBERADA];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>