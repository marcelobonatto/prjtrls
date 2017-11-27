<?php
namespace lib;

class respostadf
{
    const RESPOSTA_ID       = 0;
    const RESPOSTA_CODIGO   = 1;
    const RESPOSTA_TEXTO    = 2;
    const RESPOSTA_NIVEL    = 3;

    public $id;
    public $texto;
    public $codigo;
    public $nivel;

    public function SelecionarCerta($pergunta)
    {
        $sql    = 'SELECT respostadfId, respostadfCodigo, respostadfTexto, respostadfNivel ' .
                  'FROM respostasdf ' .
                  "WHERE perguntadfId = '$pergunta' " .
                  'AND respostadfNivel = 10';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $resp = $res[0];

                $this->id       = $resp[self::RESPOSTA_ID];
                $this->codigo   = $resp[self::RESPOSTA_CODIGO];
                $this->texto    = $resp[self::RESPOSTA_TEXTO];
                $this->nivel    = $resp[self::RESPOSTA_NIVEL];
            }
        }
    }

    public function SelecionarErradas($pergunta)
    {
        $matriz = array();

        $sql    = 'SELECT respostadfId, respostadfCodigo, respostadfTexto, respostadfNivel ' .
                  'FROM respostasdf ' .
                  "WHERE perguntadfId = '$pergunta' " .
                  'AND respostadfNivel < 10';
                  
        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $resp)
                {
                    $obj            = new resposta();

                    $obj->id        = $resp[self::RESPOSTA_ID];
                    $obj->codigo    = $resp[self::RESPOSTA_CODIGO];
                    $obj->texto     = $resp[self::RESPOSTA_TEXTO];
                    $obj->nivel     = $resp[self::RESPOSTA_NIVEL];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Salvar($pergunta)
    {
        $sql        = 'INSERT INTO respostasdf ' .
                      '(respostadfId, perguntadfId, respostadfCodigo, respostadfTexto, respostadfNivel) ' . 
                      "VALUES ('{ID}', '$pergunta', '$this->codigo', '$this->texto', $this->nivel)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        return $this->id != null;
    }
}
?>