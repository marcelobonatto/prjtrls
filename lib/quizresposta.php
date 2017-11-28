<?php
namespace lib;

class quizresposta
{
    public $id;
    public $aluno;
    public $pergunta;
    public $responda;
    public $correta;
    public $tempo;

    //qprId	quizId	alunoId	perguntaId	respostaIdRespondida	qprCorreta	qprTempoResposta

    public function ContarPontos($aluno, $quiz)
    {
        $sql    = 'SELECT COALESCE(pontos, 0) AS pontos ' . 
                  'FROM (SELECT SUM(COALESCE(qprCorreta, 0)) AS pontos ' .
                  'FROM quizzespergresp ' .
                  "WHERE quizId = '$quiz' " .
                  "AND alunoId = '$aluno') p";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        $retorno    = 0;

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $retorno = $res[0][0];
            }
        }

        return $retorno;
    }
}
?>