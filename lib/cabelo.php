<?php
namespace lib;

class cabelo
{
    public $id;
    public $nome;
    public $cor;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT corcabeloId, corcabeloNome, corcabeloCor, corcabeloAtivo ' .
                  'FROM corescabelo ' .
                  'ORDER BY corcabeloNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $coritem)
                {
                    $obj                = new cabelo();
                    $this->atribuirValores($obj, $coritem);
                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Selecionar($id)
    {
        $sql    = "SELECT corcabeloId, corcabeloNome, corcabeloCor, corcabeloAtivo " .
                  'FROM corescabelo ' .
                  "WHERE corcabeloId = '$id'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $this->atribuirValores($this, $res[0]);
            }
        }
    }

    function atribuirValores($obj, $cor)
    {
        $obj->id            = $cor['corcabeloId'];
        $obj->nome          = $cor['corcabeloNome'];
        $obj->cor           = $cor['corcabeloCor'];
        $obj->ativo         = $cor['corcabeloAtivo'];
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
        $sql    = 'INSERT INTO corescabelo ' .
                  '(corcabeloId, corcabeloNome, corcabeloCor, corcabeloAtivo) ' . 
                  "VALUES ('$id', '$this->nome', '$this->cor', $this->ativo)";

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
        $sql    = 'UPDATE corescabelo ' .
                  "SET corcabeloNome = '$this->nome', " .
                  "corcabeloCor = '$this->cor', " .
                  "corcabeloAtivo = $this->ativo " .
                  "WHERE corcabeloId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE corescabelo ' .
                  "SET corcabeloAtivo = $modo " .
                  "WHERE corcabeloId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>