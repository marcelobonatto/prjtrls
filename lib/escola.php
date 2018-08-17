<?php
namespace lib;

class escola
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

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $escola)
                {
                    $obj                = new escola();
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

    public function ListarCombo()
    {
        $matriz = array();

        $sql    = 'SELECT escolaId, escolaNome, escolaBairro, e.cidadeCodigo, c.cidadeNome, e.estadoSigla, escolaAtivo ' .
                  'FROM escolas e ' .
                  'JOIN cidades c ON c.cidadeCodigo = e.cidadeCodigo ' .
                  'ORDER BY escolaNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $escola)
                {
                    $obj                = new escola();
                    $obj->id            = $escola['escolaId'];
                    $obj->nome          = $escola['escolaNome'];
                    $obj->bairro        = $escola['escolaBairro'];
                    $obj->cidade        = $escola['cidadeCodigo'];
                    $obj->cidadenome    = $escola['cidadeNome'];
                    $obj->estado        = $escola['estadoSigla'];
                    $obj->ativo         = $escola['escolaAtivo'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarPorCidade($cidade)
    {
        $matriz = array();

        $sql    = 'SELECT escolaId, escolaNome, escolaBairro, e.cidadeCodigo, c.cidadeNome, e.estadoSigla, escolaAtivo ' .
                  'FROM escolas e ' .
                  'JOIN cidades c ON c.cidadeCodigo = e.cidadeCodigo ' .
                  "WHERE e.cidadeCodigo = '$cidade' " .
                  'ORDER BY escolaNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $escola)
                {
                    $obj                = new escola();
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

    public function Selecionar($id)
    {
        $sql    = "SELECT escolaId, escolaNome, escolaBairro, e.cidadeCodigo, c.cidadeNome, e.estadoSigla, escolaAtivo " .
                  'FROM escolas e ' .
                  'JOIN cidades c ON c.cidadeCodigo = e.cidadeCodigo ' .
                  "WHERE escolaId = '$id' " .
                  'ORDER BY escolaNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $escola   = $res[0];

                $this->id            = $escola[self::ESCOLA_ID];
                $this->nome          = $escola[self::ESCOLA_NOME];
                $this->bairro        = $escola[self::ESCOLA_BAIRRO];
                $this->cidade        = $escola[self::CIDADE_CODIGO];
                $this->cidadenome    = $escola[self::CIDADE_NOME];
                $this->estado        = $escola[self::ESTADO_SIGLA];
                $this->ativo         = $escola[self::ESCOLA_ATIVO];
            }
        }
    }

    public function Salvar()
    {
        if ($this->id == null)
        {
            $id = '{ID}';
        }
        else
        {
            $id = $this->id;
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
        $erro   = -1;

        $sql    = 'INSERT INTO escolas ' .
                  '(escolaId, escolaNome, escolaBairro, cidadeCodigo, estadoSigla, escolaAtivo) ' .
                  "VALUES ('$id', '$this->nome', '$this->bairro', '$this->cidade', '$this->estado', $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id == null)
        {
            $erro   = 1;
        }

        if ($this->cidade == null)
        {
            $erro   = 2;
        }

        if ($this->estado == null)
        {
            if ($erro < 2) $erro = 0;
            $erro   += 4;
        }

        return $erro;
    }

    public function Atualizar($id)
    {
        $sql    = 'UPDATE escolas ' .
                  "SET escolaNome = '$this->nome', " .
                  "escolaBairro = '$this->bairro', " .
                  "cidadeCodigo = '$this->cidade', " .
                  "estadoSigla = '$this->estado', " .
                  "escolaAtivo = $this->ativo " .
                  "WHERE escolaId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE escolas ' .
                  "SET escolaAtivo = $modo " .
                  "WHERE escolaId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>