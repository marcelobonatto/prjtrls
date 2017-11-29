<?php
include_once('../autoload.php');

//header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

//if (isset($_POST['chave']))
if (isset($_GET['chave']))
{
//    $chave          = $_POST['chave'];
    $chave          = $_GET['chave'];

    $chobj          = new lib\chave();
    $chobj->descompactar($chave);

    switch ($chobj->erro)
    {
        case 1:
            $mensagens[]    = 'A chave informada não tem o tamanho esperado';
            break;
        case 2:
            $mensagens[]    = 'As posições da data de pedido não estão com o valor esperado';
            break;
        case 3:
            $mensagens[]    = 'A chave não pertence a nenhuma plataforma esperada';
            break;
    }
}
else
{
    $mensagens[]    = 'Chave não informada';
    $chave          = '';
}

//if (isset($_POST['valor']))
if (isset($_GET['valor']))
{
//    $valor         = $_POST['valor'];
    $valor          = $_GET['valor'];

    $b64            = base64_decode($valor);
    $json           = json_decode($b64);

    $cjs            = array("nome", "usuario", "unidade", "ano");

    if (json_last_error() == JSON_ERROR_NONE)
    {
        foreach ($json as $cjsv => $valinfo)
        {
            if (array_search($cjsv, $cjs) === FALSE)
            {
                $mensagens[] = 'O JSON informado não é válido';
            }
        }
    }
    else
    {
        $mensagens[]    = 'Não foi informado um JSON com os valores a serem cadastrados';
    }
}
else
{
    $mensagens[]    = 'Os valores do cadastro não foram informados';
    $valor          = '';
}

if (count($mensagens) == 0)
{

}

if (count($mensagens) > 0)
{
    $jogador          = new lib\ws\jscadastrarerros();

    $jogador->erros = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $jogador->erros[$i]             = new lib\ws\jserro();
        $jogador->erros[$i]->mensagem   = $mensagem;
        $i++;
    }
}

$jogador->chave     = $chave;
$jogador->valor     = $valor;

echo(json_encode($jogador));
?>