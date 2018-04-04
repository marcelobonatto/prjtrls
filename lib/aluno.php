<?php
namespace lib;

class aluno
{
    const ALUNO_ID          = 0;
    const ALUNO_NOME        = 1;
    const ALUNO_LOGINMOODLE = 2;
    const ALUNO_EMAIL       = 3;
    const ALUNO_ANO         = 4;    
    const ESCOLA_ID         = 5;
    const ESCOLA_NOME       = 6;
    const ALUNO_MATRICULA   = 7;
    const ALUNO_ATIVO       = 8;

    public $id;
    public $nome;
    public $loginMoodle;
    public $email;
    public $ano;    
    public $escola;
    public $escolaNome;
    public $matricula;
    public $usuario;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT alunoId, alunoNome, alunoLoginMoodle, alunoEmail, alunoAno, n.escolaId, escolaNome, alunoMatricula, alunoAtivo ' .
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
                    $obj->email      = $aluno[self::ALUNO_EMAIL];
                    $obj->ano  = $aluno[self::ALUNO_ANO];                    
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
        
        $sql    = 'SELECT alunoId, alunoNome, alunoLoginMoodle, alunoEmail, alunoAno, n.escolaId, escolaNome, NULL AS alunoMatricula, alunoAtivo ' .
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
                    $obj->email      = $aluno[self::ALUNO_EMAIL];
                    $obj->ano  = $aluno[self::ALUNO_ANO];                         
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
        $sql    = "SELECT alunoId, alunoNome, alunoLoginMoodle, alunoEmail, alunoAno, n.escolaId, escolaNome, alunoMatricula, alunoAtivo " .
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
                $this->email              = $aluno[self::ALUNO_EMAIL];
                $this->ano          = $aluno[self::ALUNO_ANO];                
                $this->escola                  = $aluno[self::ESCOLA_ID];
                $this->escolaNome              = $aluno[self::ESCOLA_NOME];
                $this->matricula          = $aluno[self::ALUNO_MATRICULA];
                $this->ativo                 = $aluno[self::ALUNO_ATIVO];
            }
        }
    }

    public function SelecionarPorUsuario($usuario)
    {
        $sql    = "SELECT alunoId, alunoNome, alunoLoginMoodle, alunoEmail, alunoAno, n.escolaId, escolaNome, alunoMatricula, alunoAtivo " .
                  'FROM alunos n ' .
                  'LEFT JOIN escolas e ON e.escolaId = n.escolaId ' .
                  "WHERE usuarioId = '$usuario' " .
                  'ORDER BY alunoNome';
                  
        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $aluno   = $res[0];

                $this->id           = $aluno[self::ALUNO_ID];
                $this->nome         = $aluno[self::ALUNO_NOME];
                $this->loginMoodle  = $aluno[self::ALUNO_LOGINMOODLE];
                $this->email              = $aluno[self::ALUNO_EMAIL];
                $this->ano          = $aluno[self::ALUNO_ANO];                  
                $this->escola       = $aluno[self::ESCOLA_ID];
                $this->escolaNome   = $aluno[self::ESCOLA_NOME];
                $this->matricula    = $aluno[self::ALUNO_MATRICULA];
                $this->ativo        = $aluno[self::ALUNO_ATIVO];
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
                  '(alunoId, alunoNome, alunoLoginMoodle, alunoEmail, alunoAno, escolaId, alunoMatricula, alunoAtivo, usuarioId) ' . 
                  "VALUES ('$id', '$this->nome', '$this->loginMoodle', '$this->email', $this->ano, $escola, $this->matricula, $this->ativo, '$this->usuario')";

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
                  "alunoEmail = $this->email, " .
                  "alunoAno = $this->ano, " .                  
                  "escolaId = $escola, " .
                  "alunoMatricula = $this->matricula, " .
                  "alunoAtivo = $this->ativo " .
                  "WHERE alunoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE alunos ' .
                  "SET alunoAtivo = $modo " .
                  "WHERE alunoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>