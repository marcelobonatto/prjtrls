<?php
class estado
{
    const ESTADO_SIGLA  = 0;
    const ESTADO_NOME   = 1;

    public $sigla;
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
                    $obj->sigla = $estado[self::ESTADO_SIGLA];
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
                
                $this->sigla = $estado[self::ESTADO_SIGLA];
                $this->nome  = $estado[self::ESTADO_NOME];
            }
        }
    }
}
?>