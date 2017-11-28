<?php
include_once('../autoload.php');

header('Content-Type: application/json');

$mensagens  = array();

//GET apenas para testes

//if (isset($_POST['usuario']))
if (isset($_GET['usuario']))
{
//    $usuario          = $_POST['usuario'];
    $usuario          = $_GET['usuario'];
}
else
{
    $mensagens[]    = 'Nome de usuário não informado';
    $usuario        = '';
}

//if (isset($_POST['chave']))
if (isset($_GET['chave']))
{
//    $chave         = $_POST['chave'];
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
    $desc          = '';
}

if (count($mensagens) == 0)
{
    $login      = new lib\ws\jslogin();
    $usuobj     = new lib\usuario();

    if ($usuobj->VerificarConexao($usuario, $chobj->texto))
    {
        $auto           = new lib\autorizacao();
        $auto->usuario  = $usuobj->id;
        $auto->data     = $chobj->real;
        
        if ($auto->Salvar())
        {
            $login->token       = base64_encode($auto->id);
            $login->nome        = $usuobj->nome;

            $aluobj             = new lib\aluno();
            $aluobj->SelecionarPorUsuario($usuobj->id);

            $jogobj             = new lib\jogador();
            $jogobj->Selecionar($aluobj->id);

            $login->sexo        = $jogobj->sexo;
            $login->cabelo      = $jogobj->cabelo;
            $login->pele        = $jogobj->pele;
            $login->ano         = $jogobj->ano;
            $login->semestre    = (date('M') < 7 ? 1 : 2);
            $login->dinheiro    = $jogobj->dinheiro;
            $login->pontos      = $jogobj->pontos;

            $jeobj              = new lib\jogadoreixo();
            $jearr              = $jeobj->ListarPorAluno($aluobj->id);

            $login->eixos       = array();

            foreach ($jearr as $je)
            {
                $login->eixos[]                 = new lib\ws\jslogineixo();
                $poseixo                        = count($login->eixos) - 1;
                $login->eixos[$poseixo]->nome   = $je->eixoNome;
                $login->eixos[$poseixo]->pontos = $je->pontos;
            }
        
            $jmobj              = new lib\jogadormissao();
            $jmarr              = $jmobj->ListarPorJogador($aluobj->id);

            $login->missoes     = array();
            
            foreach ($jmarr as $jm)
            {
                $login->missoes[]                           = new lib\ws\jsloginmissao();
                $posmissao                                  = count($login->missoes) - 1;

                $login->missoes[$posmissao]->ano            = $jm->missaoAno;
                $login->missoes[$posmissao]->semestre       = $jm->missaoSemestre;
                $login->missoes[$posmissao]->codigo         = $jm->missao;
                $login->missoes[$posmissao]->sequencia      = $jm->missaoSequenca;
                $login->missoes[$posmissao]->obrigatorio    = $jm->missaoObrigatoria;
                $login->missoes[$posmissao]->ligadoa        = $jm->missaoPai;
                $login->missoes[$posmissao]->liberada       = $jm->liberada;
                $login->missoes[$posmissao]->cumprida       = $jm->cumprida;
                $login->missoes[$posmissao]->jogando        = $jm->jogando;
                $login->missoes[$posmissao]->aprovada       = $jm->liberada;
            }
        }
        else
        {
            $mensagens[]    = 'Não foi possível obter autorização do servidor';
        }
    }
    else
    {
        $mensagens[]        = 'As informações de autenticação são inválidas';
    }
}

if (count($mensagens) > 0)
{
    $login         = new lib\ws\jsloginerros();

    $login->erros  = array();
    $i              = 0;
    
    foreach ($mensagens as $mensagem)
    {
        $login->erros[$i]              = new lib\ws\jserro();
        $login->erros[$i]->mensagem    = $mensagem;
        $i++;
    }
}

$login->usuario = $usuario;

echo(json_encode($login));
?>