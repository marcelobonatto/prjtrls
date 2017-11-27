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

if (isset($_POST['nivel']))
//if (isset($_GET['nivel']))
{
    $nivel         = $_POST['nivel'];
//    $nivel         = $_GET['nivel'];

    if ($nivel < 1 && $nivel > 6)
    {
        $mensagens[]    = 'Nível informado é inválido';
    }
}
else
{
    $mensagens[]    = 'Nível não informado';
    $nivel          = '';
}

if (count($mensagens) == 0)
{
    $df                 = new lib\ws\jsdf();

    $pergobj            = new lib\perguntadf();
    $pergarr            = $pergobj->ListarPorNivel($nivel);
    $chaves             = array_keys($pergarr);

    if (count($chaves) > 0)
    {
        $contarq            = file_get_contents(realpath('../dados/config.json'));
        $json               = json_decode($contarq);

        $numperg            = $json->desafiofinal[$nivel - 1]->perguntas;
        $max                = (count($chaves) > $numperg ? $numperg : count($chaves));
        $df->perguntas      = array();

        for ($pos = 0; $pos < $max; $pos++)
        {
            $totalperg              = count($chaves);
            $posrnd                 = mt_rand(1, $totalperg);

            $df->perguntas[]        = new lib\ws\jsdfpergunta();
            $posperg                = count($df->perguntas) - 1;
            $escperg                = $pergarr[$chaves[$posrnd - 1]];
            $pergunta               = $df->perguntas[$posperg];

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

                $pergunta->respostas[$posr] = new lib\ws\jsdfresposta();
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
        $mensagens[]    = 'Não existem perguntas cadastradas';
    }
}

if (count($mensagens) > 0)
{
    $df             = new lib\ws\jsdferros();
    
    $df->erros      = array();
    $i              = 0;
        
    foreach ($mensagens as $mensagem)
    {
        $df->erros[$i]            = new lib\ws\jserro();
        $df->erros[$i]->mensagem  = $mensagem;
        $i++;
    }
}

$df->token          = $token;
$df->nivel          = $nivel;

echo(json_encode($df));
?>