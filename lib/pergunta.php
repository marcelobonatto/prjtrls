<?php
namespace lib;

/*
id (i.d)
codigo (no.me)
enunciado (login.moodle)
eixo (esco.la)
ativo (ati.vo)
*/

class pergunta
{
    const PERGUNTA_ID           = 0;
    const PERGUNTA_ENUNCIADO    = 1;
    const PERGUNTA_CODIGO       = 2;
    const PERGUNTA_ATIVO        = 3;

    public $id;
    public $enunciado;
    public $codigo;
    public $ativo;
    public $certa;
    public $erradas = array();

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT perguntaId, perguntaEnunciado, perguntaCodigo, perguntaAtivo ' .
                  'FROM perguntas ' .
                  'ORDER BY perguntaEnunciado';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $perg)
                {
                    $obj                = new pergunta();
                    $obj->id            = $perg[self::PERGUNTA_ID];
                    $obj->enunciado     = $perg[self::PERGUNTA_ENUNCIADO];
                    $obj->codigo        = $perg[self::PERGUNTA_CODIGO];
                    $obj->ativo         = $perg[self::PERGUNTA_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Salvar()
    {
        $erro       = -1;

        $sql        = 'INSERT INTO perguntas ' .
                      '(perguntaId, perguntaEnunciado, perguntaCodigo, perguntaAtivo) ' . 
                      "VALUES ('{ID}', '$this->enunciado', '$this->codigo', $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id != null)
        {
            if ($this->certa != null)
            {
                $rescerta   = $this->certa->Salvar($this->id);

                if (!$rescerta)
                {
                    $erro   = 2;
                }
            }

            if ($this->erradas != null)
            {
                foreach ($this->erradas as $errada)
                {
                    $errada->Salvar($this->id);

                    if (!$rescerta)
                    {
                        $erro   += 4;
                    }
                }
            }
        }
        else
        {
            $erro   = 1;
        }

        return $erro;
    }

    public function Selecionar($id)
    {
        $sql    = "SELECT alunoId, alunoNome, alunoLoginMoodle, n.escolaId, escolaNome, alunoMatricula, alunoAtivo " .
                  'FROM alunos n ' .
                  'LEFT JOIN escolas e ON e.escolaId = n.escolaId ' .
                  "WHERE alunoId = '$id' " .
                  'ORDER BY alunoNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $aluno   = $res[0];

                $this->id                    = $aluno[self::ALUNO_ID];
                $this->nome                  = $aluno[self::ALUNO_NOME];
                $this->loginMoodle                 = $aluno[self::ALUNO_LOGINMOODLE];
                $this->escola                  = $aluno[self::ESCOLA_ID];
                $this->escolaNome              = $aluno[self::ESCOLA_NOME];
                $this->matricula          = $aluno[self::ALUNO_MATRICULA];
                $this->ativo                 = $aluno[self::ALUNO_ATIVO];
            }
        }
    }

    public function SalvarSemRespostas()
    {
        if ($this->id == null)
        {
            $id     = '{ID}';
        }
        else
        {
            $id     = $this->id;
        }

        if ($this->escola == '*')
        {
            $escola   = 'NULL';
        }
        else
        {
            $escola   = "'$this->escola'";
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id, $escola);
        }
        else
        {
            return $this->Atualizar($id, $escola);
        }
    }

    public function Incluir($id, $escola)
    {
        $sql    = 'INSERT INTO alunos ' .
                  '(alunoId, alunoNome, alunoLoginMoodle, escolaId, alunoMatricula, alunoAtivo) ' . 
                  "VALUES ('$id', '$this->nome', '$this->loginMoodle', $escola, $this->matricula, $this->ativo)";

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

    public function Atualizar($id, $escola)
    {
        $sql    = 'UPDATE alunos ' .
                  "SET alunoNome = '$this->nome', " .
                  "alunoLoginMoodle = '$this->loginMoodle', " .
                  "escolaId = $escola, " .
                  "alunoMatricula = $this->matricula, " .
                  "alunoAtivo = $this->ativo " .
                  "WHERE alunoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Excluir()
    {
        $sql    = 'UPDATE alunos ' .
                  "SET alunoAtivo = 0 " .
                  "WHERE alunoId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }    

}
?>