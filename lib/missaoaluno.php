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
    public $referencia;

    public $missaoAno;
    public $missaoSemestre;
    public $missaoSequencia;
    public $missaoObrigatoria;
    public $missaoPai;

    public $eixo;
    public $eixoNome;

    public $aprovada;
    public $cumprida;
    public $jogando;
    public $liberada;

    public function ListarPorJogador($aluno)
    {
        $matriz = array();
        
        $sql    = 'SELECT missaoalunoId, ma.missaoId, alunoId, statusMissao, m.missaoAno, m.missaoSemestre, m.missaoSequencia, m.missaoObrigatoria, m.missaoPai, ' .
                  'e.eixoId, e.eixoNome, m.missaoReferencia ' .
                  'FROM missaoaluno ma ' .
                  'JOIN missoes m ON m.missaoId = ma.missaoId ' .
                  'JOIN missoeseixo me ON me.missaoId = m.missaoId ' . 
                  'JOIN eixos e ON e.eixoId = me.eixoId ' .
                  "WHERE alunoId = '$aluno' " .
                  'ORDER BY m.missaoReferencia';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $jm)
                {
                    $obj                        = new missaoaluno();

                    $obj->id                    = $jm['missaoalunoId'];
                    $obj->aluno                 = $jm['alunoId'];
                    $obj->missao                = $jm['missaoId'];
                    $obj->missaoAno             = $jm['missaoAno'];
                    $obj->missaoSemestre        = $jm['missaoSemestre'];
                    $obj->missaoSequencia       = $jm['missaoSequencia'];
                    $obj->missaoObrigatoria     = $jm['missaoObrigatoria'];
                    $obj->missaoPai             = $jm['missaoPai'];
                    $obj->referencia            = $jm['missaoReferencia'];

                    $aprovado   = 0;
                    $cumprida   = 0;
                    $jogando    = 0;
                    $liberada   = 0;

                    switch (intval($jm['statusMissao']))
                    {
                        case 1:
                            $liberada   = 1;
                            break;
                        case 2:
                            $jogando    = 1;
                            break;
                        case 3:
                            $cumprida   = 1;
                            break;
                        case 4:
                            $aprovado   = 1;
                            break;
                    }

                    $obj->aprovada              = $aprovado;
                    $obj->cumprida              = $cumprida;
                    $obj->jogando               = $jogando;
                    $obj->liberada              = $liberada;

                    $obj->eixo                  = $jm['eixoId'];
                    $obj->eixoNome              = $jm['eixoNome'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Selecionar($aluno, $missao, $eixo)
    {
        $sql    = 'SELECT missaoalunoId, ma.missaoId, alunoId, statusMissao ' .
                  'FROM missaoaluno ma ' .
                  'JOIN missoeseixo me ON me.missaoId = ma.missaoId ' .
                  "WHERE alunoId = '$aluno' " .
                  "AND ma.missaoId = '$missao'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            $ma = $res[0];

            $this->id                    = $ma['missaoalunoId'];
            $this->aluno                 = $ma['alunoId'];
            $this->missao                = $ma['missaoId'];
            $this->status                = $ma['statusMissao'];
        }
    }

    public function SelecionarProximo($aluno, $missao, $eixo)
    {
        $matriz = array();

        $sql    = 'SELECT 1 AS idx, missaoalunoId, ma.missaoId, alunoId, statusMissao, m.missaoReferencia ' .
                  'FROM missaoaluno ma ' .
                  'JOIN missoeseixo me ON me.missaoId = ma.missaoId '.
                  'JOIN missoes m ON m.missaoId = ma.missaoId ' .
                  "WHERE alunoId = '$aluno' " .
                  "AND me.eixoId = '$eixo' " .
                  "AND missaoReferencia > (SELECT m2.missaoReferencia FROM missoes m2 WHERE m2.missaoId = '$missao') " .
                  'UNION ' .
                  'SELECT 0 AS idx, missaoalunoId, ma.missaoId, alunoId, statusMissao, missaoReferencia ' .
                  'FROM missaoaluno ma ' .
                  'JOIN missoes m ON m.missaoId = ma.missaoId ' .
                  "WHERE alunoId = '$aluno' " .
                  "AND ma.missaoId = '$missao' " .
                  'ORDER BY 1, missaoReferencia';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $old    = substr($res[0]['missaoReferencia'], 0, 4);
                $max    = $old;
                $prim   = true;
                $agora  = "";

                foreach ($res as $jm)
                {
                    if (!$prim)
                    {
                        $agora  = substr($jm['missaoReferencia'], 0, 4);

                        if ($agora == $old)
                        {
                            $max    = $agora + 1;
                        }
                        else if ($agora != $old && $agora > $max)
                        {
                            break;
                        }    
                    }
                    else
                    {
                        $prim   = false;
                    }

                    if ($jm['idx'] > 0)
                    {
                        $obj            = new missaoaluno();

                        $obj->id       = $jm['missaoalunoId'];
                        $obj->aluno    = $jm['alunoId'];
                        $obj->missao   = $jm['missaoId'];
                        $obj->status   = $jm['statusMissao'];

                        array_push($matriz, $obj);
                    }
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