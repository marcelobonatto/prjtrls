<?php
namespace lib;

class cidade
{
    public $id;
    public $nome;
    public $estado;
    public $ativo;

    public function Contar()
    {
        $qtde   = 0;

        $sql    = 'SELECT COUNT(*) AS qtde ' .
                  'FROM cidades';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            $qtde   = $res[0]['qtde'];
        }

        return $qtde;
    }

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        $ini    = ($pagina - 1) * 50;

        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo ' .
                  'FROM cidades ' .
                  'ORDER BY estadoSigla, cidadeNome ' .
                  "LIMIT $ini, 50";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $cidade)
                {
                    $obj            = new cidade();
                    $obj->id        = $cidade['cidadeCodigo'];
                    $obj->nome      = $cidade['cidadeNome'];
                    $obj->estado    = $cidade['estadoSigla'];
                    $obj->ativo     = $cidade['cidadeAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarPorEstado($estado)
    {
        $matriz = array();

        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo ' .
                  'FROM cidades c ' .
                  "WHERE estadoSigla = '$estado' " .
                  'AND EXISTS (SELECT NULL FROM escolas e WHERE e.cidadeCodigo = c.cidadeCodigo) ' .
                  'ORDER BY cidadeNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $cidade)
                {
                    $obj            = new cidade();
                    $obj->id        = $cidade['cidadeCodigo'];
                    $obj->nome      = $cidade['cidadeNome'];
                    $obj->estado    = $cidade['estadoSigla'];
                    $obj->ativo     = $cidade['cidadeAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Selecionar($id)
    {
        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo ' .
                  'FROM cidades ' .
                  "WHERE cidadeCodigo = $id";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $cidade = $res[0];

                $this->id        = $cidade['cidadeCodigo'];
                $this->nome      = $cidade['cidadeNome'];
                $this->estado    = $cidade['estadoSigla'];
                $this->ativo     = $cidade['cidadeAtivo'];
            }
        }
    }

    public function SelecionarPorNome($nome)
    {
        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo ' .
                  'FROM cidades ' .
                  "WHERE UPPER(cidadeNome) = UPPER('$nome')";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $cidade = $res[0];

                $this->id        = $cidade['cidadeCodigo'];
                $this->nome      = $cidade['cidadeNome'];
                $this->estado    = $cidade['estadoSigla'];
                $this->ativo     = $cidade['cidadeAtivo'];
            }
        }
    }

    public static function Existe($id)
    {
        $existe = false;

        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo ' .
                  'FROM cidades ' .
                  "WHERE cidadeCodigo = '$id'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            $existe = (count($res) > 0);
        }

        return $existe;
    }

    public function ListarRegistrosPorEstados($estado)
    {
        $matriz = array();

        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo ' .
                  'FROM cidades ' .
                  'ORDER BY estadoSigla, cidadeNome '.
                  "WHERE UPPER(estadoSigla) = UPPER('$estado')";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $cidade)
                {
                    $obj            = new cidade();
                    $obj->id        = $cidade['cidadeCodigo'];
                    $obj->nome      = $cidade['cidadeNome'];
                    $obj->estado    = $cidade['estadoSigla'];
                    $obj->ativo     = $cidade['cidadeAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Salvar($novo)
    {
        if ($novo)
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
        $sql    = 'INSERT INTO cidades ' .
                  '(cidadeCodigo, cidadeNome, estadoSigla, cidadeAtivo) ' . 
                  "VALUES ('$this->id', '$this->nome', '$this->estado', $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->Executar($sql);

        return true;
    }

    public function Atualizar()
    {
        $sql    = 'UPDATE cidades ' .
                  "SET cidadeNome = '$this->nome', " .
                  "estadoSigla = '$this->estado', " .
                  "cidadeAtivo = $this->ativo " .
                  "WHERE cidadeCodigo = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE cidades ' .
                  "SET cidadeAtivo = $modo " .
                  "WHERE cidadeCodigo = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>