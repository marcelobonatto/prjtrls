<?php
namespace lib;

class pele
{
    public $id;
    public $nome;
    public $cor;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT corpeleId, corpeleNome, corpeleCor, corpeleAtivo ' .
                  'FROM corespele ' .
                  'ORDER BY corpeleNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $coritem)
                {
                    $obj                = new pele();
                    $this->atribuirValores($obj, $coritem);
                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
    
    public function Selecionar($id)
    {
        $sql    = "SELECT corpeleId, corpeleNome, corpeleCor, corpeleAtivo " .
                  'FROM corespele ' .
                  "WHERE corpeleId = '$id'";

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
        $obj->id            = $cor['corpeleId'];
        $obj->nome          = $cor['corpeleNome'];
        $obj->cor           = $cor['corpeleCor'];
        $obj->ativo         = $cor['corpeleAtivo'];
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
        $sql    = 'INSERT INTO corespele ' .
                  '(corpeleId, corpeleNome, corpeleCor, corpeleAtivo) ' . 
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
        $sql    = 'UPDATE corespele ' .
                  "SET corpeleNome = '$this->nome', " .
                  "corpeleCor = '$this->cor', " .
                  "corpeleAtivo = $this->ativo " .
                  "WHERE corpeleId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE corespele ' .
                  "SET corpeleAtivo = $modo " .
                  "WHERE corpeleId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>