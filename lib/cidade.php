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

    public function SelecionarPorNome($nome)
    {
        $matriz = array();

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
}
?>