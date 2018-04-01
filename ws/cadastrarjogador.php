<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

if (isset($_POST['chave']))
//if (isset($_GET['chave']))
{
    $chave          = $_POST['chave'];
//    $chave          = $_GET['chave'];

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

if (isset($_POST['valor']))
//if (isset($_GET['valor']))
{
    $valor         = $_POST['valor'];
//    $valor          = $_GET['valor'];

    $b64            = base64_decode($valor);
    $json           = json_decode($b64);

    $cjs            = array('nome', 'usuario', 'senha', 'email', 'unidade', 'matricula', 'ano');

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
//{ "nome": "Aluno 4", "usuario": "aluno4", "unidade": "ef88bb50-cd6a-11e7-91b8-00051b7601a3", "matricula": 1951, "ano": 1 }
//eyAibm9tZSI6ICJBbHVubyA0IiwgInVzdWFyaW8iOiAiYWx1bm80IiwgInVuaWRhZGUiOiAiZWY4OGJiNTAtY2Q2YS0xMWU3LTkxYjgtMDAwNTFiNzYwMWEzIiwgIm1hdHJpY3VsYSI6IDE5NTEsICJhbm8iOiAxIH0%3D

//url exemplo:
//http://localhost/prjtrlsadm/ws/cadastrarjogador.php?chave=MjAxNzExMjkxMTIxMDUtaG15fDpkakNsZUB8NiZ5ZGQ7Lyk%2FL2NzLCd3NVA5cyJgaF9nK1BNfUlGVS0jflQtJE02RFUlM0VbVEBea3d0ZXN0ZQ0K&valor=eyAibm9tZSI6ICJBbHVubyA0IiwgInVzdWFyaW8iOiAiYWx1bm80IiwgInVuaWRhZGUiOiAiZWY4OGJiNTAtY2Q2YS0xMWU3LTkxYjgtMDAwNTFiNzYwMWEzIiwgIm1hdHJpY3VsYSI6IDE5NTEsICJhbm8iOiAxIH0%3D

if (count($mensagens) == 0)
{
    $usuario            = new lib\usuario();
    $usuario->SelecionarPorNomeUsuario($json->usuario);

    if ($usuario->id == null)
    {
        $jogador            = new lib\ws\jscadastrar();

        $usuario->nome      = $json->usuario;
        $usuario->senha     = $chobj->texto;
        $usuario->ativo     = 1;
        
        if ($usuario->Salvar())
        {
            $aluno              = new lib\aluno();
            $aluno->usuario     = $usuario->id;
            $aluno->nome        = $json->nome;
            $aluno->loginMoodle = $json->usuario;
            $aluno->email       = $json->email;
            $aluno->ano         = $json->ano;            
            $aluno->escola      = $json->unidade;
            $aluno->matricula   = $json->matricula;
            $aluno->ativo       = 1;

            $jogador->idusuario = $usuario->id;
            $jogador->gravou    = true;

            if (!$aluno->Salvar())
            {
                $mensagens[]    = 'Não foi possível salvar no banco o novo aluno';
            }
        }
        else
        {
            $mensagens[]    = 'Não foi possível salvar no banco o novo usuário';
        }

        if (count($mensagens) == 0)
        {
            $jogobj             = new lib\jogador();
            $jogobj->id         = $aluno->id;
            $jogobj->dinheiro   = 0;
            $jogobj->pontos     = 0;
            $jogobj->cabelo     = null;
            $jogobj->pele       = null;
            $jogobj->sexo       = 0;
            $jogobj->ano        = $json->ano;
            $jogobj->diabonus   = 0;
            $jogobj->databonus  = date('Y-m-d H:i:s');
            $jogobj->tickets    = 20;

            if (!$jogobj->Salvar(true))
            {
                $mensagens[]    = 'Não foi possível gravar os dados do jogador';
            }
        }

        if (count($mensagens) == 0)
        {
            $misobj         = new lib\missao();
            $misarr         = $misobj->ListarTodosAtivos();

            foreach ($misarr as $misitm)
            {
                $misalu             = new lib\missaoaluno();
                $misalu->missao     = $misitm->id;
                $misalu->aluno      = $aluno->id;

                $anostr = substr($misobj->referencia, 0, 1);
                $seqstr = substr($misobj->referencia, 2, 2);

                if ($json->ano <= $anostr)
                {
                    if ($json->ano > $anostr || ($json->ano == $anostr && $seqstr == '01'))
                    {
                        $misalu->status     = 1;
                    }
                    else
                    {
                        $misalu->status     = 0;
                    }
                }

                if (!$misalu->Salvar())
                {
                    $mensagens[]    = 'Não foi possível gravar os dados de missão do aluno';
                    break;
                }
            }
        }

        if (count($mensagens) == 0)
        {
            $eixobj         = new lib\eixo();
            $eixarr         = $eixobj->ListarApenasAtivos();

            foreach ($eixarr as $eixitm)
            {
                $eixalu             = new lib\jogadoreixo();
                $eixalu->aluno      = $aluno->id;
                $eixalu->eixo       = $eixitm->id;
                $eixalu->pontos     = 0;

                if (!$eixalu->Salvar())
                {
                    $mensagens[]    = 'Não foi possível gravar os dados de missão do aluno';
                    break;
                }
            }
        }

        if (count($mensagens) == 0)
        {
            $auto           = new lib\autorizacao();
            $auto->usuario  = $usuario->id;
            $auto->data     = DateTime::createFromFormat('Y-m-d H:i:s', 'now');

            if ($auto->Salvar())
            {
                $jogador->token = base64_encode($auto->id);
            }
            else
            {
                $mensagens[]    = 'Não foi possível obter autorização para o jogador';
            }
        }

    }
    else
    {
        $mensagens[]    = 'Nome de usuário já utilizado';
    }
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

    $jogador->gravou    = false;
}

$jogador->chave     = $chave;
$jogador->valor     = $valor;

echo(json_encode($jogador));
?>