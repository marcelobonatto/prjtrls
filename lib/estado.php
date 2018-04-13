<?php
namespace lib;

class estado
{
    const ESTADO_SIGLA  = 0;
    const ESTADO_NOME   = 1;

    public $id;
    public $nome;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT estadoSigla, estadoNome, estadoAtivo ' .
                  'FROM estados ' .
                  'ORDER BY estadoSigla';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $estado)
                {
                    $obj        = new estado();
                    $obj->id    = $estado['estadoSigla'];
                    $obj->nome  = $estado['estadoNome'];
                    $obj->ativo = $estado['estadoAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarCombo()
    {
        $matriz = array();

        $sql    = 'SELECT estadoSigla, estadoNome, estadoAtivo ' .
                  'FROM estados ' .
                  'ORDER BY estadoSigla';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $estado)
                {
                    $obj        = new estado();
                    $obj->id    = $estado['estadoSigla'];
                    $obj->nome  = $estado['estadoNome'];
                    $obj->ativo = $estado['estadoAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function SelecionarPorSigla($sigla)
    {
        $matriz = array();

        $sql    = 'SELECT estadoSigla, estadoNome, estadoAtivo ' .
                  'FROM estados ' .
                  "WHERE UPPER(estadoSigla) = UPPER('$sigla')";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $estado = $res[0];
                
                $this->id   = $estado['estadoSigla'];
                $this->nome = $estado['estadoNome'];
                $this->ativo = $estado['estadoAtivo'];
            }
        }
    }

    public function Selecionar($sigla)
    {
        $sql    =   "SELECT estadoSigla, estadoNome, estadoAtivo " .
                    'FROM estados ' .
                    "WHERE estadoSigla = '$sigla' " .
                    'ORDER BY estadoNome';

                echo "SQL: ".$sql;                
                
        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $estado     = $res[0];

                $this->id   = $estado['estadoSigla'];
                $this->nome = $estado['estadoNome'];
                $this->ativo = $estado['estadoAtivo'];
            }
        }
    }

    public function Salvar($id)
    {
        if ($id == 'novo' || $id == 'novosigla')
        {
            return $this->Incluir();
        }
        else
        {
            return $this->Atualizar();
        }
    }

    public function Incluir()
    {
        $sql    = 'INSERT INTO estados ' .
                  '(estadoSigla, estadoNome, estadoAtivo) ' . 
                  "VALUES ('$this->id', '$this->nome', $this->ativo)";

        $db         = new bancodados();
        $db->Executar($sql);

        if ($this->id != null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Atualizar()
    {
        $sql    =   'UPDATE estados ' .
                    "SET estadoNome = '$this->nome', " .
                    "estadoAtivo = $this->ativo " .
                    "WHERE estadoSigla = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE estados ' .
                  "SET estadoAtivo = $modo " .
                  "WHERE estadoSigla = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>