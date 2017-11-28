<?php
namespace lib;

class jogadoreixo
{
    const JOGADOREIXO_ID        = 0;
    const ALUNO_ID              = 1;
    const EIXO_ID               = 2;
    const EIXO_NOME             = 3;
    const JOGADOREIXO_PONTOS    = 4;

    public $id;
    public $aluno;
    public $eixo;
    public $eixoNome;
    public $pontos;

    public function ListarPorAluno($aluno)
    {
        $matriz = array();
        
        $sql    = 'SELECT jogadoreixoId, alunoId, je.eixoId, e.eixoNome, jogadoreixoPontos ' .
                  'FROM jogadoreseixo je ' .
                  'JOIN eixos e ON e.eixoId = je.eixoId ' .
                  "WHERE je.alunoId = '$aluno' " .
                  'ORDER BY e.eixoNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $usuario)
                {
                    $obj            = new jogadoreixo();
                    $obj->id        = $usuario[self::JOGADOREIXO_ID];
                    $obj->aluno     = $usuario[self::ALUNO_ID];
                    $obj->eixo      = $usuario[self::EIXO_ID];
                    $obj->eixoNome  = $usuario[self::EIXO_NOME];
                    $obj->pontos    = $usuario[self::JOGADOREIXO_PONTOS];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>