<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

$custom          = new lib\ws\jsgravacao();

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

    $cjs            = array('sexo', 'cabelo', 'pele');

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
//{ "sexo": 1, "cabelo": 2, "pele": 3 }
//eyAic2V4byI6IDEsICJjYWJlbG8iOiAyLCAicGVsZSI6IDMgfQ%3D%3D

//url exemplo:
//http://localhost/prjtrlsadm/ws/customperson.php?token=ZjJiMWRkNGUtZDNjYy0xMWU3LWIxZGYtNTJhZTc0M2JjODNk&valor=eyAic2V4byI6IDEsICJjYWJlbG8iOiAyLCAicGVsZSI6IDMgfQ%3D%3D

if (count($mensagens) == 0)
{
    $aluno  = new lib\aluno();
    $aluno->SelecionarPorUsuario($auto->usuario);

    if ($aluno->id != null)
    {
        $jogobj = new lib\jogador();
        $jogobj->Selecionar($aluno->id);

        if ($jogobj->id != null)
        {
            $jogobj->cabelo = $json->cabelo;
            $jogobj->pele   = $json->pele;
            $jogobj->sexo   = $json->sexo;

            if (!$jogobj->Salvar(false))
            {
                $mensagens[]    = 'Não foi possível alterar os dados do jogador';
            }
            else
            {
                $custom->gravou = true;
            }
        }
        else
        {
            $mensagens[]  = 'Jogador não foi cadastrado';
        }
    }
    else
    {
        $mensagens[]    = 'Aluno não encontrado';
    }
}

if (count($mensagens) > 0)
{
    $custom->erros  = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $custom->erros[$i]             = new lib\ws\jserro();
        $custom->erros[$i]->mensagem   = $mensagem;
        $i++;
    }

    $custom->gravou    = false;
}

$custom->token     = $token;
$custom->valor     = $valor;

echo(json_encode($custom));
?>