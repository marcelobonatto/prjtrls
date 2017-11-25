<?php
namespace lib;

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

        if ($res !== FALSE)
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

    public function ListarRegistrosExceto($id, $apenasObrigatorias)
    {
        $matriz = array();
        
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai ' .
                  'FROM missoes ' .
                  "WHERE missaoId <> '$id' ";

        if ($apenasObrigatorias)
        {
            $sql    .= 'AND missaoObrigatoria = 1 ';
        }

        $sql    .= 'ORDER BY missaoAno, missaoSemestre, missaoSequencia';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
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

    public function Selecionar($id)
    {
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai ' .
                  'FROM missoes ' .
                  "WHERE missaoId = '$id'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $missao              = $res[0];

                $this->id            = $missao[self::MISSAO_ID];
                $this->nome          = $missao[self::MISSAO_NOME];
                $this->titulo        = $missao[self::MISSAO_TITULO];
                $this->descricao     = $missao[self::MISSAO_DESCRICAO];
                $this->ativo         = $missao[self::MISSAO_ATIVO];
                $this->idMoodle      = $missao[self::MISSAO_IDMOODLE];
                $this->ano           = $missao[self::MISSAO_ANO];
                $this->semestre      = $missao[self::MISSAO_SEMESTRE];
                $this->sequencia     = $missao[self::MISSAO_SEQUENCIA];
                $this->obrigatoria   = $missao[self::MISSAO_OBRIGATORIA];
                $this->pai           = $missao[self::MISSAO_PAI];
            }
        }
    }

    public function SelecionarComEixo($id)
    {
        $this->Selecionar($id);

        $eixo           = new missaoeixo();
        $this->eixos    = $eixo->ListarPorMissao($id);
    }

    public function SelecionarComOutrosCadastros($id)
    {
        $this->SelecionarComEixo($id);

        $fala           = new dialogonpc();
        $this->falasnpc = $fala->ListarPorMissao($id);
    }

    public function SelecionarPorNome($nome)
    {
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai ' .
                  'FROM missoes ' .
                  "WHERE missaoNome = '$nome'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $missao             = $res[0];

                $this->id            = $missao[self::MISSAO_ID];
                $this->nome          = $missao[self::MISSAO_NOME];
                $this->titulo        = $missao[self::MISSAO_TITULO];
                $this->descricao     = $missao[self::MISSAO_DESCRICAO];
                $this->ativo         = $missao[self::MISSAO_ATIVO];
                $this->idMoodle      = $missao[self::MISSAO_IDMOODLE];
                $this->ano           = $missao[self::MISSAO_ANO];
                $this->semestre      = $missao[self::MISSAO_SEMESTRE];
                $this->sequencia     = $missao[self::MISSAO_SEQUENCIA];
                $this->obrigatoria   = $missao[self::MISSAO_OBRIGATORIA];
                $this->pai           = $missao[self::MISSAO_PAI];
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
                    $eixo->missao   = $this->id;
                    $reseixos       = $eixo->Salvar();

                    if (!$reseixos)
                    {
                        $erro   = 2;
                    }
                }
            }

            if ($this->falasnpc != null)
            {
                foreach ($this->falasnpc as $fala)
                {
                    $fala->missao   = $this->id;
                    $resfalas       = $fala->Salvar();

                    if (!$resfalas)
                    {
                        $erro   = 4;
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
        $sql    = 'UPDATE missoes ' .
                  "SET missaoNome = '$this->nome', " .
                  "missaoTitulo = '$this->titulo', " .
                  "missaoDescricao = '$this->descricao', " .
                  "missaoAtivo = $this->ativo, " .
                  "missaoIdMoodle = $idmoodle, " .
                  "missaoAno = $this->ano, " .
                  "missaoSemestre = $this->semestre, " .
                  "missaoSequencia = $this->sequencia, " .
                  "missaoObrigatoria = $this->obrigatoria, " .
                  "missaoPai = $pai " .
                  "WHERE missaoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        if ($this->eixos != null)
        {
            foreach ($this->eixos as $eixo)
            {
                $eixo->missao   = $this->id;
                $eixo->Salvar();
            }
            
            if ($this->falasnpc != null)
            {
                foreach ($this->falasnpc as $fala)
                {
                    $fala->missao   = $this->id;
                    $resfalas       = $fala->Salvar();
                }
            }
        }

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