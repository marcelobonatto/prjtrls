<?php
require_once('../autoload.php');
require_once('../vendor/autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];

if (!isset($_POST['email']))
{
    $mensagem[] = 'Email n&atilde;o informado'; 
}
else
{
    $email = $_POST['email'];

    if ($id == null)
    {
        if (lib\usuario::ExisteEmail($email))
        {
            $mensagem[] = 'Este e-mail j&aacute; foi utilizado para outra conta de usu&aacute;rio';
        }
    }
}

if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $novo                   = ($id == null);

    $usuario                = new lib\usuario();

    $usuario->id            = $id;
    $usuario->nome          = $nome;
    $usuario->email         = $email;
    $usuario->ativo         = $ativo;

    if ($usuario->Salvar())
    {
        $msgtxt = '';

        if ($novo)
        {
            $contarq            = file_get_contents(realpath('../dados/config.json'));
            $json               = json_decode($contarq);
    
            $chave              = date('YmdHis') . $usuario->email;
            $chave              = base64_encode($chave);
            $chaved             = urlencode($chave);
    
            $html               = file_get_contents(realpath('../html/cadastronovousuario.html'));
            $htmls              = str_replace('{chave}', $chaved, str_replace('{url}', $json->endereco, $html));
    
            $usuario->AtualizarChaveNovaSenha($chave);

            $erro               = lib\email::Enviar($usuario->email, '', true, 
                                                    '[Saga das Profiss&otilde;es] Um administrador cadastrou voc&ecirc; no sistema', 
                                                    $htmls, $htmls);

            if ($erro != '')
            {
                $msgtxt = 'N&atilde;o foi poss&iacute; enviar o e-mail com o link da senha. Volte a lista, clique em editar e clique em Enviar E-mail para Troca de Senha.';
            }
        }

        echo("OK|$usuario->id|$msgtxt");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}

if (count($mensagem) > 0)
{
    $msgs   = '';

    foreach ($mensagem as $linha)
    {
        $msgs   .= "- $linha<br />"; 
    }

    echo($msgs);
}
?>