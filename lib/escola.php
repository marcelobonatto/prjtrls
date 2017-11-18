<?php
class cidade
{
    const ESCOLA_ID     = 0;
    const ESCOLA_NOME   = 1;
    const ESCOLA_BAIRRO = 2;
    const CIDADE_CODIGO = 3;
    const CIDADE_NOME   = 4;
    const ESTADO_SIGLA  = 5;
    const ESCOLA_ATIVO  = 6;

    public $id;
    public $nome;
    public $bairro;
    public $cidade;
    public $cidadenome;
    public $estado;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT escolaId, escolaNome, escolaBairro, e.cidadeCodigo, c.cidadeNome, e.estadoSigla, escolaAtivo ' .
                  'FROM escolas e ' .
                  'JOIN cidades c ON c.cidadeCodigo = e.cidadeCodigo ' .
                  'ORDER BY escolaNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                foreach ($res as $escola)
                {
                    $obj                = new cidade();
                    $obj->id            = $escola[self::ESCOLA_ID];
                    $obj->nome          = $escola[self::ESCOLA_NOME];
                    $obj->bairro        = $escola[self::ESCOLA_BAIRRO];
                    $obj->cidade        = $escola[self::CIDADE_CODIGO];
                    $obj->cidadenome    = $escola[self::CIDADE_NOME];
                    $obj->estado        = $escola[self::ESTADO_SIGLA];
                    $obj->ativo         = $escola[self::ESCOLA_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>