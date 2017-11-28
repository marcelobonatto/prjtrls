<?php
namespace lib;

class quiz
{
    public $id;
    public $alunoDesafiante;
    public $alunoDesafiado;
    public $data;
    public $limite;
    public $vencedor;
    public $pedidoRespondido;

    public function ListarPorAluno($aluno)
    {
        $matriz = array();
        
        $sql    = 'SELECT quizId, alunoIdDesafiante, alunoIdDesafiado, quizData, quizLimite, alunoIdVencedor, quizDesafioResp ' .
                  'FROM quizzes ' .
                  "WHERE alunoIdDesafiante = '$aluno' " .
                  "OR alunoIdDesafiado = '$aluno' " .
                  'ORDER BY quizData';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {//TODO: Continuar aqui!!!!
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
        
        //quizId 	alunoIdDesafiante 	alunoIdDesafiado 	quizData 	quizLimite 	alunoIdVencedor 	quizDesafioResp
    }
}
?>