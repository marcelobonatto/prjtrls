<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

if (isset($_POST['token']))
//if (isset($_GET['token']))
{
    $token          = $_POST['token'];
//    $token          = $_GET['token'];
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
}

if (isset($_POST['pedido']))
//if (isset($_GET['pedido']))
{
    $pedido         = $_POST['pedido'];
//    $pedido         = $_GET['pedido'];
}
else
{
    $mensagens[]    = 'Pedido de quiz não informado';
    $pedido         = '';
}

if (count($mensagens) == 0)
{
    $quiz               = new lib\ws\jsquiz();

    $eixoobj            = new lib\eixo();
    $eixoarr            = $eixoobj->ListarRegistros(1);
    $maxcont            = count($eixoarr);

    if ($maxcont > 0)
    {
        $escolha          = mt_rand(1, $maxcont);
        //$escolha            = 1;
        $categ              = $eixoarr[$escolha - 1];

        $quiz->categoria    = $categ->nome;

        $pergobj            = new lib\pergunta();
        $pergarr            = $pergobj->ListarPorCategoria($categ->id);
        $chaves             = array_keys($pergarr);

        if (count($chaves) > 0)
        {
            $max                = (count($chaves) > 10 ? 10 : count($chaves));
            $quiz->perguntas    = array();

            for ($pos = 0; $pos < $max; $pos++)
            {
                $totalperg              = count($chaves);
                $posrnd                 = mt_rand(1, $totalperg);

                $quiz->perguntas[]      = new lib\ws\jsquizpergunta();
                $posperg                = count($quiz->perguntas) - 1;
                $escperg                = $pergarr[$chaves[$posrnd - 1]];
                $pergunta               = $quiz->perguntas[$posperg];

                $pergunta->codigo       = $escperg->id;
                $pergunta->enunciado    = $escperg->enunciado;

                $maxresp                = (count($escperg->erradas) > 3 ? 3 : count($escperg->erradas));
                $disp                   = array();

                for ($d = 0; $d < $maxresp; $d++)
                {
                    array_push($disp, $d);
                }

                $chavesresp             = array_keys($escperg->erradas);

                $pergunta->respostas    = array($maxresp + 1);
                $naofoicerta            = true;

                for ($posr = 0; $posr < 4; $posr++)
                {
                    $totalresp                  = count($chavesresp);
                    $posrndr                    = mt_rand(1, $totalresp);
                    $totaldisp                  = count($disp);
                    $posordresp                 = mt_rand(1, $totaldisp);
                    $ehcerta                    = mt_rand(0, 100);

                    $pergunta->respostas[$posr] = new lib\ws\jsquizresposta();
                    $resposta                   = $pergunta->respostas[$posr];

                    if ($ehcerta && $naofoicerta)
                    {
                        $escresp                = $escperg->certa;
                        $resposta->correta      = true;
                        $naofoicerta            = false;            
                    }
                    else
                    {
                        $escresp                = $escperg->erradas[$posrndr - 1];
                        $resposta->correta      = false;
                    }

                    $resposta->codigo       = $escresp->id;
                    $resposta->texto        = $escresp->texto;
                }

                array_splice($chaves, $posrnd - 1, 1);
            }
        }
        else
        {
            $mensagens[]    = 'A categoria sorteada não possui perguntas';
        }
    }
    else
    {
        $mensagens[]    = 'Não existe nenhuma categoria cadastrada';
    }
}

if (count($mensagens) > 0)
{
    $quiz           = new lib\ws\jsquizerros();

    $quiz->erros    = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $quiz->erros[$i]            = new lib\ws\jserro();
        $quiz->erros[$i]->mensagem  = $mensagem;
        $i++;
    }
}

$quiz->token    = $token;
$quiz->pedido   = $pedido;

echo(json_encode($quiz));
?>