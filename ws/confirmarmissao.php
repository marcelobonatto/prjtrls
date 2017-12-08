<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens      = array();

$conf           = new lib\ws\jsgravacao();

//GET apenas para testes

if (isset($_POST['token']))
//if (isset($_GET['token']))
{
    $token          = $_POST['token'];
//    $token          = $_GET['token'];

    $auto           = new lib\autorizacao();
    $autoresp       = $auto->Validar(base64_decode($token));

    switch ($autoresp)
    {
        case 1:
            $mensagens[]    = 'Token inválido';
            break;
        case 2:
            $mensagens[]    = 'Validade do token vencida';
            break;
        case 3:
            $mensagens[]    = 'Não consegui atualizar o token';
            break;
    }
}
else
{
    $mensagens[]    = 'Token não informado';
    $token          = '';
}

if (isset($_POST['valor']))
//if (isset($_GET['valor']))
{
    $valor         = $_POST['valor'];
//    $valor         = $_GET['valor'];
    
    $b64            = base64_decode($valor);
    $json           = json_decode($b64);

    $cjs            = array('aluno', 'missao', 'eixo');

    if (json_last_error() == JSON_ERROR_NONE)
    {
        foreach ($json as $cjsv => $valinfo)
        {
            if (array_search($cjsv, $cjs) === FALSE)
            {
                $mensagens[] = 'O JSON informado não é válido';
                break;
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

//Exemplo JSON
//{ "aluno": "ef88bb50-cd6a-11e7-91b8-00051b7601a3", "missao": "ef88bb50-cd6a-11e7-91b8-00051b7601a3", "eixo": "e885bc95-bb13-11e7-a2a8-00306776e789" }
//eyAiYWx1bm8iOiAiZWY4OGJiNTAtY2Q2YS0xMWU3LTkxYjgtMDAwNTFiNzYwMWEzIiwgIm1pc3NhbyI6ICJlZjg4YmI1MC1jZDZhLTExZTctOTFiOC0wMDA1MWI3NjAxYTMiLCAiZWl4byI6ICJlODg1YmM5NS1iYjEzLTExZTctYTJhOC0wMDMwNjc3NmU3ODkiIH0%3D

//url exemplo:
//http://localhost/prjtrlsadm/ws/confirmarmissao.php?token=ZjJiMWRkNGUtZDNjYy0xMWU3LWIxZGYtNTJhZTc0M2JjODNk&valor=eyAiYWx1bm8iOiAiZWY4OGJiNTAtY2Q2YS0xMWU3LTkxYjgtMDAwNTFiNzYwMWEzIiwgIm1pc3NhbyI6ICJlZjg4YmI1MC1jZDZhLTExZTctOTFiOC0wMDA1MWI3NjAxYTMiIH0%3D

if (count($mensagens) == 0)
{
    $eixoobj        = new lib\eixo();
    $eixoobj-> SelecionarPorSigla($json->eixo);

    $missaojog      = new lib\missaoaluno();
    $missaojog->Selecionar($json->aluno, $json->missao, $eixoobj->id);

    if ($missaojog->id != null)
    {
        $missaojog->status  = 2;
        $missaojog->Salvar();

        $conf->gravou       = true;

        $proxobj    = new lib\missaoaluno();
        $proxarr    = $proxobj->SelecionarProximo($json->aluno, $json->missao, $eixoobj->id);

        foreach ($proxarr as $prox)
        {
            $prox->status  = 1;
            $prox->Salvar();    
        }
    }
    else
    {
        $mensagens[]        = "A missão do aluno informado não existe";
    }
}

if (count($mensagens) > 0)
{
    $conf->erros    = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $conf->erros[$i]             = new lib\ws\jserro();
        $conf->erros[$i]->mensagem   = $mensagem;
        $i++;
    }

    $conf->gravou    = false;
}

$conf->token     = $token;
$conf->valor     = $valor;

echo(json_encode($conf));
?>