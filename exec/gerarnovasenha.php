<?php
require_once('../autoload.php');
require_once('../vendor/autoload.php');

$mensagem   = array();

if (!isset($_POST['email'])) $mensagem[] = 'E-mail n&atilde;o informado'; else $email = $_POST['email'];

if (count($mensagem) == 0)
{
    $usuario    = new lib\usuario();
    $usuario->SelecionarPorEmail($email);

    if ($usuario->id != null)
    {
        $contarq            = file_get_contents(realpath('../dados/config.json'));
        $json               = json_decode($contarq);

        $chave              = date('YmdHis') . $usuario->email;
        $chave              = base64_encode($chave);
        $chaved             = urlencode($chave);

        $html               = file_get_contents(realpath('../html/mudarsenha.html'));
        $htmls              = str_replace('{chave}', $chaved, str_replace('{url}', $json->endereco, $html));

        $usuario->AtualizarChaveNovaSenha($chave);

        $erro               = lib\email::Enviar($usuario->email, '', true, 
                                                '[Saga das Profiss&otilde;es] Voc&ecirc; pediu para reiniciar a senha?', 
                                                $htmls, $htmls);

        if ($erro == '')
        {
            echo('OK');
        }
        else
        {
            $mensagem[] = $erro;
        }
    }
    else
    {
        $mensagem[] = 'N&atilde;o existe nenhum usu&aacute;rio com este e-mail relacionado';
    }
}

if (count($mensagem) > 0)
{
    foreach ($mensagem as $linha)
    {
        $html   .= "- $linha<br />"; 
    }

    echo($html);
}
?>