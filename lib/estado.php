<?php
namespace lib;

class estado
{
    const ESTADO_SIGLA  = 0;
    const ESTADO_NOME   = 1;

    public $id;
    public $nome;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT estadoSigla, estadoNome ' .
                  'FROM estados ' .
                  'ORDER BY estadoSigla';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $estado)
                {
                    $obj        = new estado();
                    $obj->id    = $estado[self::ESTADO_SIGLA];
                    $obj->nome  = $estado[self::ESTADO_NOME];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function SelecionarPorSigla($sigla)
    {
        $matriz = array();

        $sql    = 'SELECT estadoSigla, estadoNome ' .
                  'FROM estados ' .
                  "WHERE UPPER(estadoSigla) = UPPER('$sigla')";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $estado = $res[0];
                
                $this->id   = $estado[self::ESTADO_SIGLA];
                $this->nome = $estado[self::ESTADO_NOME];
            }
        }
    }

    public function Selecionar($sigla)
    {
        $sql    = "SELECT estadoSigla, estadoNome " .
                'FROM estados ' .
                "WHERE estadoSigla = '$sigla' " .
                'ORDER BY estadoNome';

                echo "SQL: ".$sql;                
                
        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $estado   = $res[0];

                $this->id   = $estado[self::ESTADO_SIGLA];
                $this->nome = $estado[self::ESTADO_NOME];
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
                '(estadoSigla, estadoNome) ' . 
                "VALUES ('$this->id', '$this->nome')";

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
        $sql    = 'UPDATE estados ' .
                "SET estadoNome = '$this->nome', " .
                "estadoSigla = '$this->sigla', " .
                "WHERE estadoSigla = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>