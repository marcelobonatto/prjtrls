<?php
include_once('../autoload.php');

//header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

//if (isset($_POST['token']))
if (isset($_GET['token']))
{
//    $token          = $_POST['token'];
    $token          = $_GET['token'];
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
}

//if (isset($_POST['codigo']))
if (isset($_GET['pedido']))
{
//    $codigo         = $_POST['codigo'];
    $codigo         = $_GET['pedido'];
}
else
{
    $mensagens[]    = 'Pedido de quiz não informado';
    $codigo         = '';
}

if (count($mensagens) == 0)
{
    $quiz           = new lib\ws\jsquiz();

    $eixoobj        = new lib\eixo();
    $eixoarr        = $eixoobj->ListarRegistros(1);
    $maxcont        = count($eixoarr);
    //$escolha        = mt_rand(1, $maxcont);
    $escolha        = 3;

    $pergobj        = new lib\pergunta();
    $pergarr        = $pergobj->ListarPorCategoria($eixoarr[$escolha - 1]->id);
    $chaves         = array_keys($pergarr);
    $escperg        = array();

    $max            = (count($chaves) > 10 ? 10 : count($chaves));

    var_dump($chaves);

    for ($pos = 0; $pos < $max; $pos++)
    {
        $totalperg      = count($chaves);
        $posrnd         = mt_rand(1, $totalperg);
        $escperg[]      = $pergarr[$posrnd - 1];

        array_splice($chaves, $posrnd - 1, 1);

        var_dump($chaves);
        var_dump($escperg);
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

echo(json_encode($quiz));
?>