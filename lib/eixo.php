<?php
namespace lib;

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

        if ($res !== FALSE)
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

    public function ListarApenasAtivos()
    {
        $matriz = array();

        $sql    = 'SELECT eixoId, eixoNome, eixoSequencia, eixoSigla, eixoAtivo ' .
                  'FROM eixos ' .
                  "WHERE eixoAtivo = 1 " .
                  'ORDER BY eixoSequencia';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
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

        if ($res !== FALSE)
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

    public function Selecionar($id)
    {
        $sql    = "SELECT eixoId, eixoNome, eixoSequencia, eixoSigla, eixoAtivo " .
                  'FROM eixos ' .
                  "WHERE eixoId = '$id' " .
                  'ORDER BY eixoNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $eixo   = $res[0];

                $this->id                    = $eixo[self::EIXO_ID];
                $this->nome                  = $eixo[self::EIXO_NOME];
                $this->sequencia             = $eixo[self::EIXO_SEQUENCIA];
                $this->sigla                 = $eixo[self::EIXO_SIGLA];
                $this->ativo                 = $eixo[self::EIXO_ATIVO];
            }
        }
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
        $sql    = 'INSERT INTO eixos ' .
                  '(eixoId, eixoNome, eixoSequencia, eixoSigla, eixoAtivo) ' . 
                  "VALUES ('$id', '$this->nome', $this->sequencia, '$this->sigla', $this->ativo)";

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
        $sql    = 'UPDATE eixos ' .
                  "SET eixoNome = '$this->nome', " .
                  "eixoSequencia = $this->sequencia, " .
                  "eixoSigla = '$this->sigla', " .
                  "eixoAtivo = $this->ativo " .
                  "WHERE eixoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE eixos ' .
                  "SET eixoAtivo = $modo " .
                  "WHERE eixoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>