<?php
namespace lib;

class grupo
{
    const GRUPO_ID    = 0;
    const GRUPO_NOME  = 1;
    const GRUPO_ATIVO = 2;

    public $id;
    public $nome;
    public $ativo;

    public function VerificarConexao($grupo, $senha)
    {
        $ok     = false;

        $sql    = 'SELECT grupoId, grupoNome, grupoAtivo ' .
                  'FROM gruposusu ' .
                  "WHERE grupoNome = '$grupo'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                if (password_verify($senha, $res[0][self::GRUPO_SENHA]))
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

        $sql    = 'SELECT grupoId, grupoNome, grupoAtivo ' .
                  'FROM gruposusu ' .
                  'ORDER BY grupoNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $grupo)
                {
                    $obj        = new grupo();
                    $obj->id    = $grupo[self::GRUPO_ID];
                    $obj->nome  = $grupo[self::GRUPO_NOME];
                    $obj->ativo = $grupo[self::GRUPO_ATIVO];

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
        $sql    = "SELECT grupoId, grupoNome, grupoAtivo " .
                'FROM gruposusu ' .
                "WHERE grupoId = '$id' " .
                'ORDER BY grupoNome';

                echo "SQL: ".$sql;                
                
        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $grupo   = $res[0];

                $this->id                = $grupo[self::GRUPO_ID];
                $this->nome              = $grupo[self::GRUPO_NOME];
                $this->ativo             = $grupo[self::GRUPO_ATIVO];
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
        $sql    = 'INSERT INTO gruposusu ' .
                '(grupoId, grupoNome, grupoAtivo) ' . 
                "VALUES ('$id', '$this->nome', $this->ativo)";



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
        $sql    = 'UPDATE gruposusu ' .
                "SET grupoNome = '$this->nome', " .
                "grupoAtivo = $this->ativo " .
                "WHERE grupoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE gruposusu ' .
                  "SET grupoAtivo = $modo " .
                  "WHERE grupoId = '$id'";

        $db     = new bancodados();
        $db->Executar($sql);

        return true;
    }    
}
?>