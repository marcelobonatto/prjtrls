<?php
namespace lib;

class perguntadf
{
    const PERGUNTA_ID           = 0;
    const PERGUNTA_ENUNCIADO    = 1;
    const PERGUNTA_CODIGO       = 2;
    const PERGUNTA_DIFICULDADE  = 3;
    const PERGUNTA_ATIVO        = 4;

    public $id;
    public $enunciado;
    public $codigo;
    public $dificuldade;
    public $ativo;
    public $certa;
    public $erradas = array();

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT perguntadfId, perguntadfEnunciado, perguntadfCodigo, perguntadfDificuldade, perguntadfAtivo ' .
                  'FROM perguntasdf ' .
                  'ORDER BY perguntadfEnunciado';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $perg)
                {
                    $obj                = new perguntadf();
                    $obj->id            = $perg[self::PERGUNTA_ID];
                    $obj->enunciado     = $perg[self::PERGUNTA_ENUNCIADO];
                    $obj->codigo        = $perg[self::PERGUNTA_CODIGO];
                    $obj->dificuldade   = $perg[self::PERGUNTA_DIFICULDADE];
                    $obj->ativo         = $perg[self::PERGUNTA_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarPorNivel($nivel)
    {
        $matriz = array();
        
        $sql    = 'SELECT perguntadfId, perguntadfEnunciado, perguntadfCodigo, perguntadfDificuldade, perguntadfAtivo ' .
                  'FROM perguntasdf ' .
                  "WHERE perguntadfDificuldade = $nivel " .
                  'ORDER BY perguntadfEnunciado';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $perg)
                {
                    $obj                = new perguntadf();
                    $obj->id            = $perg[self::PERGUNTA_ID];
                    $obj->enunciado     = $perg[self::PERGUNTA_ENUNCIADO];
                    $obj->codigo        = $perg[self::PERGUNTA_CODIGO];
                    $obj->dificuldade   = $perg[self::PERGUNTA_DIFICULDADE];
                    $obj->ativo         = $perg[self::PERGUNTA_ATIVO];

                    $certa              = new respostadf();
                    $certa->SelecionarCerta($obj->id);
                    $obj->certa         = $certa;

                    $erradas            = new respostadf();
                    $obj->erradas       = $erradas->SelecionarErradas($obj->id);

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Salvar()
    {
        $erro       = -1;

        $sql        = 'INSERT INTO perguntasdf ' .
                      '(perguntadfId, perguntadfEnunciado, perguntadfCodigo, perguntadfDificuldade, perguntadfAtivo) ' . 
                      "VALUES ('{ID}', '$this->enunciado', '$this->codigo', $this->dificuldade, $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id != null)
        {
            if ($this->certa != null)
            {
                $rescerta   = $this->certa->Salvar($this->id);

                if (!$rescerta)
                {
                    $erro   = 2;
                }
            }

            if ($this->erradas != null)
            {
                foreach ($this->erradas as $errada)
                {
                    $errada->Salvar($this->id);

                    if (!$rescerta)
                    {
                        $erro   += 4;
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

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE perguntasdf ' .
                  "SET perguntadfAtivo = $modo " .
                  "WHERE perguntadfId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>