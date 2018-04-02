<?php
namespace lib;

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
    public $email;
    public $ativo;
    public $codmod;
    public $datamod;

    public function VerificarConexao($usuario, $senha)
    {
        $ok     = false;

        $sql    = 'SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo ' .
                  'FROM usuarios ' .
                  "WHERE usuarioNome = '$usuario'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);
        
        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                if (password_verify($senha, $res[0]['usuarioSenha']))
                {
                    $usuario        = $res[0];

                    $this->id       = $usuario['usuarioId'];
                    $this->nome     = $usuario['usuarioNome'];
                    $this->senha    = $usuario['usuarioSenha'];
                    $this->sal      = $usuario['usuarioSal'];
                    $this->email    = $usuario['usuarioEmail'];
                    $this->ativo    = $usuario['usuarioAtivo'];

                    $ok             = true;
                }
            }
        }

        return $ok;
    }

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo ' .
                  'FROM usuarios ' .
                  'ORDER BY usuarioNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $usuario)
                {
                    $obj           = new usuario();
                    $obj->id       = $usuario['usuarioId'];
                    $obj->nome     = $usuario['usuarioNome'];
                    $obj->senha    = $usuario['usuarioSenha'];
                    $obj->sal      = $usuario['usuarioSal'];
                    $obj->email    = $usuario['usuarioEmail'];
                    $obj->ativo    = $usuario['usuarioAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Selecionar($id)
    {
        $sql    = "SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo " .
                'FROM usuarios ' .
                "WHERE usuarioId = '$id' " .
                'ORDER BY usuarioNome';
                
        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $usuario   = $res[0];

                $this->id       = $usuario['usuarioId'];
                $this->nome     = $usuario['usuarioNome'];
                $this->senha    = $usuario['usuarioSenha'];
                $this->sal      = $usuario['usuarioSal'];
                $this->email    = $usuario['usuarioEmail'];
                $this->ativo    = $usuario['usuarioAtivo'];
            }
        }
    }

    public function SelecionarPorNomeUsuario($nome)
    {
        $sql    = "SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo " .
                  'FROM usuarios ' .
                  "WHERE usuarioNome = '$nome' " .
                  'ORDER BY usuarioNome';
                
        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $usuario   = $res[0];

                $this->id       = $usuario['usuarioId'];
                $this->nome     = $usuario['usuarioNome'];
                $this->senha    = $usuario['usuarioSenha'];
                $this->sal      = $usuario['usuarioSal'];
                $this->email    = $usuario['usuarioEmail'];
                $this->ativo    = $usuario['usuarioAtivo'];
            }
        }
    }

    public function VerificarChaveReset($chave)
    {
        $sql    = "SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo " .
                  'FROM usuarios ' .
                  "WHERE usuarioCodMod = '$chave'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $usuario   = $res[0];

                $this->id       = $usuario['usuarioId'];
                $this->nome     = $usuario['usuarioNome'];
                $this->senha    = $usuario['usuarioSenha'];
                $this->sal      = $usuario['usuarioSal'];
                $this->email    = $usuario['usuarioEmail'];
                $this->ativo    = $usuario['usuarioAtivo'];

                return true;
            }
        }

        return false;
    }

    public function SelecionarPorEmail($email)
    {
        $sql    = "SELECT usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo " .
                  'FROM usuarios ' .
                  "WHERE usuarioEmail = '$email' " .
                  'ORDER BY usuarioNome';
                
        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $usuario   = $res[0];

                $this->id       = $usuario['usuarioId'];
                $this->nome     = $usuario['usuarioNome'];
                $this->senha    = $usuario['usuarioSenha'];
                $this->sal      = $usuario['usuarioSal'];
                $this->email    = $usuario['usuarioEmail'];
                $this->ativo    = $usuario['usuarioAtivo'];
            }
        }
    }

    public static function ExisteEmail($email)
    {
        $sql    = "SELECT usuarioId " .
                  'FROM usuarios ' .
                  "WHERE usuarioEmail = '$email'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                return true;
            }
        }
        
        return false;
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

        $senha  = password_hash($this->senha, PASSWORD_DEFAULT);

        if ($id == '{ID}')
        {
            $this->datamod  = date('Y-m-d H:i:s');
            $this->codmod   = base64_encode(str_replace('-', '', str_replace(':', '', str_replace(' ', '', $this->datamod))) . $this->email);

            return $this->Incluir($id, $senha);
        }
        else
        {
            return $this->Atualizar($id, $senha);
        }
    }

    public function Incluir($id, $senha)
    {
        $sql    = 'INSERT INTO usuarios ' .
                  '(usuarioId, usuarioNome, usuarioSenha, usuarioSal, usuarioEmail, usuarioAtivo, usuarioCodMod, usuarioDataMod) ' . 
                  "VALUES ('$id', '$this->nome', '$senha', '', '$this->email', $this->ativo, '$this->codmod', '$this->datamod')";

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

    public function Atualizar($id, $senha)
    {
        $sql    = 'UPDATE usuarios ' .
                  "SET usuarioNome = '$this->nome', " .
                  "usuarioSenha = '$senha', " .
                  "usuarioEmail = '$this->email', " .
                  "usuarioAtivo = $this->ativo " .
                  "WHERE usuarioId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function AtualizarChaveNovaSenha($chave)
    {
        $sql    = 'UPDATE usuarios ' .
                  "SET usuarioCodMod = '$chave' " .
                  "WHERE usuarioId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE usuarios ' .
                  "SET usuarioAtivo = $modo " .
                  "WHERE usuarioId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function GravarSenha($senha)
    {
        $senhac = password_hash($senha, PASSWORD_DEFAULT);

        $sql    = 'UPDATE usuarios ' .
                  "SET usuarioSenha = '$senhac', " .
                  "usuarioCodMod = '' " .
                  "WHERE usuarioId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>