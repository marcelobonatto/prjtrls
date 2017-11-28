<?php
namespace lib;

class quiz
{
    const QUIZ_ID               = 0;
    const ALUNO_IDDESAFIANTE 	= 1;
    const ALUNO_IDDESAFIADO     = 2;
    const QUIZ_DATA             = 3;
    const QUIZ_LIMITE           = 4;
    const ALUNO_IDVENCEDOR      = 5;
    const QUIZ_DESAFIORESP      = 6;

    public $id;
    public $alunoDesafiante;
    public $alunoDesafiado;
    public $data;
    public $limite;
    public $vencedor;
    public $pedidoRespondido;

    public function ListarPorJogador($aluno)
    {
        $matriz = array();
        
        $sql    = 'SELECT quizId, alunoIdDesafiante, alunoIdDesafiado, quizData, quizLimite, alunoIdVencedor, quizDesafioResp ' .
                  'FROM quizzes ' .
                  "WHERE (alunoIdDesafiante = '$aluno' AND quizDesafianteViu = 0) " .
                  "OR (alunoIdDesafiado = '$aluno' AND quizDesafioResp = 0) " .
                  'ORDER BY quizData';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $quiz)
                {
                    $obj                    = new quiz();
                    $obj->id                = $quiz[self::QUIZ_ID];
                    $obj->alunoDesafiante   = $quiz[self::ALUNO_IDDESAFIANTE];
                    $obj->alunoDesafiado    = $quiz[self::ALUNO_IDDESAFIADO];
                    $obj->data              = $quiz[self::QUIZ_DATA];
                    $obj->limite            = $quiz[self::QUIZ_LIMITE];
                    $obj->vencedor          = $quiz[self::ALUNO_IDVENCEDOR];
                    $obj->pedidoRespondido  = $quiz[self::QUIZ_DESAFIORESP];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>