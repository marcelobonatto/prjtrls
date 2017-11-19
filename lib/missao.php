<?php
class missao
{
    const MISSAO_ID             = 0;
    const MISSAO_NOME           = 1;
    const MISSAO_TITULO         = 2;
    const MISSAO_DESCRICAO      = 3;
    const MISSAO_ATIVO          = 4;
    const MISSAO_IDMOODLE       = 5;
    const MISSAO_ANO            = 6;
    const MISSAO_SEMESTRE       = 7; 
    const MISSAO_SEQUENCIA      = 8;
    const MISSAO_OBRIGATORIA    = 9;
    const MISSAO_PAI            = 10;

    public $id;
    public $nome;
    public $titulo;
    public $descricao;
    public $ativo;
    public $idMoodle;
    public $ano;
    public $semestre;
    public $sequencia;
    public $obrigatoria;
    public $pai;
    public $painome;
    public $eixos = array();
    public $falasnpc = array();

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai ' .
                  'FROM missoes ' .
                  'ORDER BY missaoAno, missaoSemestre, missaoSequencia';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                foreach ($res as $missao)
                {
                    $obj                = new missao();
                    $obj->id            = $missao[self::MISSAO_ID];
                    $obj->nome          = $missao[self::MISSAO_NOME];
                    $obj->titulo        = $missao[self::MISSAO_TITULO];
                    $obj->descricao     = $missao[self::MISSAO_DESCRICAO];
                    $obj->ativo         = $missao[self::MISSAO_ATIVO];
                    $obj->idMoodle      = $missao[self::MISSAO_IDMOODLE];
                    $obj->ano           = $missao[self::MISSAO_ANO];
                    $obj->semestre      = $missao[self::MISSAO_SEMESTRE];
                    $obj->sequencia     = $missao[self::MISSAO_SEQUENCIA];
                    $obj->obrigatoria   = $missao[self::MISSAO_OBRIGATORIA];
                    $obj->pai           = $missao[self::MISSAO_PAI];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function SelecionarPorNome($nome)
    {
        $matriz = array();
        
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai ' .
                  'FROM missoes ' .
                  "WHERE missaoNome = '$nome'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $missao = $res[0];

                $obj                = new missao();
                $obj->id            = $missao[self::MISSAO_ID];
                $obj->nome          = $missao[self::MISSAO_NOME];
                $obj->titulo        = $missao[self::MISSAO_TITULO];
                $obj->descricao     = $missao[self::MISSAO_DESCRICAO];
                $obj->ativo         = $missao[self::MISSAO_ATIVO];
                $obj->idMoodle      = $missao[self::MISSAO_IDMOODLE];
                $obj->ano           = $missao[self::MISSAO_ANO];
                $obj->semestre      = $missao[self::MISSAO_SEMESTRE];
                $obj->sequencia     = $missao[self::MISSAO_SEQUENCIA];
                $obj->obrigatoria   = $missao[self::MISSAO_OBRIGATORIA];
                $obj->pai           = $missao[self::MISSAO_PAI];

                array_push($matriz, $obj);
            }
        }

        return $matriz;
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

        if ($this->idMoodle == null)
        {
            $idmoodle   = 'NULL';
        }
        else
        {
            $idmoodle   = "'$this->idMoodle'";
        }

        if ($this->pai == null)
        {
            $pai        = 'NULL';
        }
        else
        {
            $pai        = "'$this->pai'";
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id, $idmoodle, $pai);
        }
        else
        {
            return $this->Atualizar($id, $idmoodle, $pai);
        }
    }

    public function Incluir($id, $idmoodle, $pai)
    {
        $erro   = -1;

        $sql    = 'INSERT INTO missoes ' .
                  '(missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, missaoSequencia, ' .
                  'missaoObrigatoria, missaoPai) ' .
                  "VALUES ('$id', '$this->nome', '$this->titulo', '$this->descricao', $this->ativo, $idmoodle, $this->ano, $this->semestre, $this->sequencia, " .
                  "$this->obrigatoria, $pai)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id != null)
        {
            if ($this->eixos != null)
            {
                foreach ($this->eixos as $eixo)
                {
                    $eixoobj            = new missaoeixo();
                    $eixoobj->missao    = $this->id;
                    $eixoobj->eixo      = $eixo;

                    $reseixos   = $eixo->Salvar();

                    if (!$reseixos)
                    {
                        $erro   = 2;
                    }
                }
            }
        }
        else
        {
            $erro   = 1;
        }

        return $erro;
    }

    public function Atualizar($id, $idmoodle, $pai)
    {
        $sql    = 'UPDATE itens ' .
                  "SET itemNome = '$this->nome', " .
                  "itemNivel = $this->nivel, " .
                  "itemCor = NULL, " .
                  "eixoId = $eixo, " .
                  "itemLimite = $limite, " .
                  "itemBonus = $this->bonus, " .
                  "itemPrecoNormal = $this->preconormal, " .
                  "itemAtivo = $this->ativo " .
                  "WHERE itemId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Excluir()
    {
        $sql    = 'UPDATE itens ' .
                  "SET itemAtivo = 0 " .
                  "WHERE itemId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>