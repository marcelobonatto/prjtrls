<?php
class respostadf
{
    public $id;
    public $texto;
    public $codigo;
    public $nivel;

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