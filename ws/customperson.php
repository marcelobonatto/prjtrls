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
//{ "sexo": 1, "cabelo": "fdebf0fa-119e-11e8-89d2-74d4359f41f2", "pele": "74f0a924-11aa-11e8-89d2-74d4359f41f2" }
//eyAic2V4byI6IDEsICJjYWJlbG8iOiAiZmRlYmYwZmEtMTE5ZS0xMWU4LTg5ZDItNzRkNDM1OWY0MWYyIiwgInBlbGUiOiAiNzRmMGE5MjQtMTFhYS0xMWU4LTg5ZDItNzRkNDM1OWY0MWYyIiB9

//url exemplo:
//http://localhost/prjtrlsadm/ws/customperson.php?token=eyAic2V4byI6IDEsICJjYWJlbG8iOiAiZmRlYmYwZmEtMTE5ZS0xMWU4LTg5ZDItNzRkNDM1OWY0MWYyIiwgInBlbGUiOiAiNzRmMGE5MjQtMTFhYS0xMWU4LTg5ZDItNzRkNDM1OWY0MWYyIiB9

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
            if ($json->sexo != 0 && $json->sexo != 1)
            {
                $mensagens[]    = 'Valor da chave sexo é inválida (deve ser 0 ou 1)';
            }

            $corcabelo = new lib\cabelo();
            $corcabelo->Selecionar($json->cabelo);

            if ($corcabelo->nome == null)
            {
                $mensagens[]    = 'Cor de cabelo não cadastrada';
            }

            $corpele = new lib\pele();
            $corpele->Selecionar($json->pele);

            if ($corpele->nome == null)
            {
                $mensagens[]    = 'Cor de pele não cadastrada';
            }

            if (count($mensagens) == 0)
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