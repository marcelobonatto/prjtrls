<?php
class cidade
{
    const CIDADE_CODIGO     = 0;
    const CIDADE_NOME       = 1;
    const ESTADO_SIGLA      = 2;

    public $codigo;
    public $nome;
    public $estado;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla ' .
                  'FROM cidades ' .
                  'ORDER BY estadoSigla, cidadeNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $cidade)
                {
                    $obj            = new cidade();
                    $obj->codigo    = $cidade[self::CIDADE_CODIGO];
                    $obj->nome      = $cidade[self::CIDADE_NOME];
                    $obj->estado    = $cidade[self::ESTADO_SIGLA];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function SelecionarPorNome($nome)
    {
        $matriz = array();

        $sql    = 'SELECT cidadeCodigo, cidadeNome, estadoSigla ' .
                  'FROM cidades ' .
                  "WHERE UPPER(cidadeNome) = UPPER('$nome')";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $cidade = $res[0];

                $this->codigo    = $cidade[self::CIDADE_CODIGO];
                $this->nome      = $cidade[self::CIDADE_NOME];
                $this->estado    = $cidade[self::ESTADO_SIGLA];
            }
        }
    }
}
?>