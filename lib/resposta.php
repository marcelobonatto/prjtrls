<?php
class resposta
{
    public $id;
    public $texto;
    public $codigo;
    public $nivel;

    public function Salvar($pergunta)
    {
        $sql        = 'INSERT INTO respostas ' .
                      '(respostaId, perguntaId, respostaCodigo, respostaTexto, respostaNivel) ' . 
                      "VALUES ('{ID}', '$pergunta', '$this->codigo', '$this->texto', $this->nivel)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        return $this->id != null;
    }
}
?>