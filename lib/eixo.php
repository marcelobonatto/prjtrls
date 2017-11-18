<?php
class eixo
{
    const EIXO_ID           = 0;
    const EIXO_NOME         = 1;
    const EIXO_SEQUENCIA    = 2;
    const EIXO_SIGLA        = 3;
    const EIXO_ATIVO        = 4;

    public $id;
    public $nome;
    public $sequencia;
    public $sigla;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT eixoId, eixoNome, eixoSequencia, eixoSigla, eixoAtivo ' .
                  'FROM eixos ' .
                  'ORDER BY eixoSequencia';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                foreach ($res as $eixo)
                {
                    $obj            = new eixo();
                    $obj->id        = $eixo[self::EIXO_ID];
                    $obj->nome      = $eixo[self::EIXO_NOME];
                    $obj->sequencia = $eixo[self::EIXO_SEQUENCIA];
                    $obj->sigla     = $eixo[self::EIXO_SIGLA];
                    $obj->ativo     = $eixo[self::EIXO_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function SelecionarPorSigla($sigla)
    {
        $sql    = 'SELECT eixoId, eixoNome, eixoSequencia, eixoSigla, eixoAtivo ' .
                  'FROM eixos ' .
                  "WHERE eixoSigla = '$sigla'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $eixo               = $res[0];
                
                $this->id           = $eixo[self::EIXO_ID];
                $this->nome         = $eixo[self::EIXO_NOME];
                $this->sequencia    = $eixo[self::EIXO_SEQUENCIA];
                $this->sigla        = $eixo[self::EIXO_SIGLA];
                $this->ativo        = $eixo[self::EIXO_ATIVO];
            }
        }
    }
}
?>