<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['email'])) $mensagem[] = 'E-mail n&atilde;o informado'; else $email = $_POST['email'];
if (!isset($_POST['senha'])) $mensagem[] = 'Senha n&atilde;o informada'; else $senha = $_POST['senha'];

if (count($mensagem) == 0)
{
    $usuario    = new lib\usuario();
    $usuario->SelecionarPorEmail($email);

    if ($usuario->id != null)
    {
        $usuario->GravarSenha($senha);
        echo("OK");
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