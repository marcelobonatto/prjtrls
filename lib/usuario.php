<?php
header('Content-type: text/html; charset=utf-8');

class usuario
{
    const USUARIO_ID    = 0;
    const USUARIO_NOME  = 1;
    const USUARIO_SENHA = 2;
    const USUARIO_SAL   = 3;
    const USUARIO_ATIVO = 4;

    public $id;
    public $nome;
    public $senha;
    public $sal;
    public $ativo;

    public function VerificarConexao($usuario, $senha)
    {
        $ok     = false;

        $sql    = 'SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioAtivo ' .
                  'FROM usuarios ' .
                  "WHERE usuarioNome = '$usuario'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                if (password_verify($senha, $res[0][self::USUARIO_SENHA]))
                {
                    $ok     = true;
                }
            }
        }

        return $ok;
    }

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioAtivo ' .
                  'FROM usuarios ' .
                  'ORDER BY usuarioNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $usuario)
                {
                    $obj        = new usuario();
                    $obj->id    = $usuario[self::USUARIO_ID];
                    $obj->nome  = $usuario[self::USUARIO_NOME];
                    $obj->senha = $usuario[self::USUARIO_SENHA];
                    $obj->sal   = $usuario[self::USUARIO_SAL];
                    $obj->ativo = $usuario[self::USUARIO_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

//Usar quando for fazer a gravação de usuários
//echo password_hash($_POST['senha'], PASSWORD_DEFAULT);


    public function Selecionar($id)
    {
        $sql    = "SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioAtivo " .
                'FROM usuarios ' .
                "WHERE usuarioId = '$id' " .
                'ORDER BY usuarioNome';

                echo "SQL: ".$sql;                
                
        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $usuario   = $res[0];

                $this->id                = $usuario[self::USUARIO_ID];
                $this->nome              = $usuario[self::USUARIO_NOME];
                $this->senha             = $usuario[self::USUARIO_SENHA];
                $this->sal               = $usuario[self::USUARIO_SAL];
                $this->ativo             = $usuario[self::USUARIO_ATIVO];
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
        $sql    = 'INSERT INTO usuarios ' .
                '(usuarioId, usuarioNome, usuarioSenha, usuarioAtivo) ' . 
                "VALUES ('$id', '$this->nome', '$this->senha', $this->ativo)";

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
        $sql    = 'UPDATE usuarios ' .
                "SET usuarioNome = '$this->nome', " .
                "usuarioSenha = '$this->senha', " .
                "usuarioAtivo = $this->ativo " .
                "WHERE usuarioId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Excluir()
    {
        $sql    = 'UPDATE usuarios ' .
                "SET usuarioAtivo = 0 " .
                "WHERE usuarioId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }    
}
?>