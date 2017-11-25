<?php
class aluno
{
    const ALUNO_ID        = 0;
    const ALUNO_NOME      = 1;
    const ALUNO_LOGINMOODLE = 2;
    const ESCOLA_ID       = 3;
    const ESCOLA_NOME     = 4;
    const ALUNO_MATRICULA = 5;
    const ALUNO_ATIVO     = 6;

    public $id;
    public $nome;
    public $loginMoodle;
    public $escola;
    public $escolaNome;
    public $matricula;
    public $ativo;

/*
    alunoId (id)
    alunoNome (nome)
    alunoLoginMoodle (loginMoodle) 
    escolaId (escola)
    alunoMatricula (matricula)
    alunoAtivo (ativo)
*/

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT alunoId, alunoNome, alunoLoginMoodle, n.escolaId, escolaNome, alunoMatricula, alunoAtivo ' .
                  'FROM alunos n ' .
                  'LEFT JOIN escolas e ON e.escolaId = n.escolaId ' .
                  'ORDER BY alunoNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $aluno)
                {
                    $obj                = new aluno();
                    $obj->id            = $aluno[self::ALUNO_ID];
                    $obj->nome          = $aluno[self::ALUNO_NOME];
                    $obj->loginMoodle         = $aluno[self::ALUNO_LOGINMOODLE];
                    $obj->escola          = $aluno[self::ESCOLA_ID];
                    $obj->escolaNome      = $aluno[self::ESCOLA_NOME];
                    $obj->matricula  = $aluno[self::ALUNO_MATRICULA];
                    $obj->ativo         = $aluno[self::ALUNO_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarSemImagens()
    {
        $matriz = array();
        
        $sql    = 'SELECT alunoId, alunoNome, alunoLoginMoodle, n.escolaId, escolaNome, NULL AS alunoMatricula, alunoAtivo ' .
                  'FROM alunos n ' .
                  'LEFT JOIN escolas e ON e.escolaId = n.escolaId ' .
                  'ORDER BY alunoNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $aluno)
                {
                    $obj                = new aluno();
                    $obj->id            = $aluno[self::ALUNO_ID];
                    $obj->nome          = $aluno[self::ALUNO_NOME];
                    $obj->loginMoodle         = $aluno[self::ALUNO_LOGINMOODLE];
                    $obj->escola          = $aluno[self::ESCOLA_ID];
                    $obj->escolaNome      = $aluno[self::ESCOLA_NOME];
                    $obj->matricula  = null;
                    $obj->ativo         = $aluno[self::ALUNO_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
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

echo "SQL (Atualizar): ".$sql;

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