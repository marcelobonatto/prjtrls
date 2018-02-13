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
    const MISSAO_DATADE         = 11;
    const MISSAO_DATAATE        = 12;

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
    public $referencia;
    public $eixos = array();
    public $falasnpc = array();
    public $datade;
    public $dataate;
    public $urlredir;

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai, missaoReferencia, missaoDataIni, missaoDataFim, missaoUrlRedir ' .
                  'FROM vw_missoes ' .
                  'ORDER BY missaoReferencia';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $missao)
                {
                    $obj                = new missao();
                    $this->atribuirValores($obj, $missao);
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
                  'missaoSequencia, missaoObrigatoria, missaoPai, missaoReferencia, missaoDataIni, missaoDataFim, missaoUrlRedir ' .
                  'FROM vw_missoes ' .
                  "WHERE missaoId <> '$id' ";

        if ($apenasObrigatorias)
        {
            $sql    .= 'AND missaoObrigatoria = 1 ';
        }

        $sql    .= 'ORDER BY missaoAno, missaoSemestre, missaoSequencia';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $missao)
                {
                    $obj                = new missao();
                    $this->atribuirValores($obj, $missao);
                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarTodosAtivos()
    {
        $matriz = array();
        
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai, missaoReferencia, missaoDataIni, missaoDataFim, missaoUrlRedir ' .
                  'FROM vw_missoes ' .
                  'WHERE missaoAtivo = 1 ' .
                  'ORDER BY missaoReferencia';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $missao)
                {
                    $obj                = new missao();
                    $this->atribuirValores($obj, $missao);
                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    function atribuirValores($obj, $missao)
    {
        $obj->id            = $missao['missaoId'];
        $obj->nome          = $missao['missaoNome'];
        $obj->titulo        = $missao['missaoTitulo'];
        $obj->descricao     = $missao['missaoDescricao'];
        $obj->ativo         = $missao['missaoAtivo'];
        $obj->idMoodle      = $missao['missaoIdMoodle'];
        $obj->ano           = $missao['missaoAno'];
        $obj->semestre      = $missao['missaoSemestre'];
        $obj->sequencia     = $missao['missaoSequencia'];
        $obj->obrigatoria   = $missao['missaoObrigatoria'];
        $obj->pai           = $missao['missaoPai'];
        $obj->referencia    = $missao['missaoReferencia'];
        $obj->urlredir      = $missao['missaoUrlRedir'];

        if ($missao['missaoDataIni'] != null)
        {
            $obj->datade        = \DateTime::createFromFormat('!Y-m-d', $missao['missaoDataIni']);
        }

        if ($missao['missaoDataFim'] != null)
        {
            $obj->dataate       = \DateTime::createFromFormat('!Y-m-d', $missao['missaoDataFim']);
        }
    }

    public function Selecionar($id)
    {
        $sql    = 'SELECT missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, ' . 
                  'missaoSequencia, missaoObrigatoria, missaoPai, missaoReferencia, missaoDataIni, missaoDataFim, missaoUrlRedir ' .
                  'FROM vw_missoes ' .
                  "WHERE missaoId = '$id'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $this->atribuirValores($this, $res[0]);
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
                  'missaoSequencia, missaoObrigatoria, missaoPai, missaoReferencia, missaoDataIni, missaoDataFim, missaoUrlRedir ' .
                  'FROM vw_missoes ' .
                  "WHERE missaoNome = '$nome'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $this->atribuirValores($this, $res[0]);
            }
        }
    }

    public function SelecionarMissaoAnterior($eixo, $referencia)
    {
        $sql    = 'SELECT m.missaoId, m.missaoNome, m.missaoTitulo, m.missaoDescricao, m.missaoAtivo, m.missaoIdMoodle, m.missaoAno, m.missaoSemestre, ' .
		          'm.missaoObrigatoria, m.missaoPai, m.missaoReferencia, m.missaoDataIni, m.missaoDataFim, m.missaoUrlRedir ' . 
                  'FROM vw_missoes m ' .
                  'JOIN missoeseixo me ON me.missaoId = m.missaoId ' .
                  'JOIN (SELECT MAX(m.missaoReferencia) AS referencia, me.eixoId ' .
			      'FROM missoes m JOIN missoeseixo me ON me.missaoId = m.missaoId ' .
			      "WHERE m.missaoReferencia < $referencia " .
                  'AND COALESCE(me.missaoeixoPontos, 0) > 0 ' .
		          ') ma ON ma.referencia = m.missaoReferencia ' .
                  "WHERE me.eixoId = '$eixo'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $this->atribuirValores($this, $res[0]);
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

        if ($this->datade == null)
        {
            $datade = 'NULL';
        }
        else
        {
            $datade = "'" . $this->datade->format('Y-m-d') . "'";
        }

        if ($this->dataate == null)
        {
            $dataate = 'NULL';
        }
        else
        {
            $dataate = "'" . $this->dataate->format('Y-m-d') . "'";
        }

        if ($this->urlredir == null)
        {
            $urlredir   = 'NULL';
        }
        else
        {
            $urlredir   = "'$this->urlredir'";
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id, $idmoodle, $pai, $datade, $dataate, $urlredir);
        }
        else
        {
            return $this->Atualizar($id, $idmoodle, $pai, $datade, $dataate, $urlredir);
        }
    }

    public function Incluir($id, $idmoodle, $pai, $datade, $dataate, $urlredir)
    {
        $erro   = -1;

        $sql    = 'INSERT INTO missoes ' .
                  '(missaoId, missaoNome, missaoTitulo, missaoDescricao, missaoAtivo, missaoIdMoodle, missaoAno, missaoSemestre, missaoSequencia, ' .
                  'missaoObrigatoria, missaoPai, missaoDataIni, missaoDataFim, missaoUrlRedir) ' .
                  "VALUES ('$id', '$this->nome', '$this->titulo', '$this->descricao', $this->ativo, $idmoodle, $this->ano, $this->semestre, $this->sequencia, " .
                  "$this->obrigatoria, $pai, $datade, $dataate, $urlredir)";

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

    public function Atualizar($id, $idmoodle, $pai, $datade, $dataate, $urlredir)
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
                  "missaoPai = $pai, " .
                  "missaoDataIni = $datade, " .
                  "missaoDataFim = $dataate, " .
                  "missaoUrlRedir = $urlredir " .
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

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE missoes ' .
                  "SET missaoAtivo = $modo " .
                  "WHERE missaoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>