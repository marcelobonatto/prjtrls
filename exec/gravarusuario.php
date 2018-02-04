<?php
require_once('../autoload.php');

$mensagem   = array();

if (!isset($_POST['id'])) $id = null; else $id = $_POST['id'];
if (!isset($_POST['nome'])) $mensagem[] = 'Nome n&atilde;o informado'; else $nome = $_POST['nome'];
if (!isset($_POST['email'])) $mensagem[] = 'Email n&atilde;o informado'; else $email = $_POST['email'];
if (!isset($_POST['ativo'])) $mensagem[] = 'Indicador de ativo n&atilde;o informado'; else $ativo = $_POST['ativo'];

if (count($mensagem) == 0)
{
    $usuario = new lib\usuario();

    $usuario->id          = $id;
    $usuario->nome        = $nome;
    $usuario->email       = $email;
    $usuario->ativo       = $ativo;

    if ($usuario->Salvar())
    {
        $contarq            = file_get_contents(realpath('../dados/config.json'));
        $json               = json_decode($contarq);

        /* Enviar um e-mail para alteração de senha */
        $txtemail   = file_get_contents('../html/criouusuario.html');
        $txtmod     = str_replace('{NOMEPESSOA}', $usuario->nome, $txtemail);
        $txtmod     = str_replace('{ENDERECO}', $json->endereco, $txtmod);
        $txtmod     = str_replace('{CODIGO}', $usuario->codmod, $txtmod);

        $headers = "From: " . strip_tags($json->email_usu) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        mail($usuario->email, '[PROJETO TRILHAS] Cadastro de novo usuário', $txtmod, $headers);

        echo("OK|$usuario->id");
    }
    else
    {
        echo('Ocorreu um erro na hora de gravar');
    }
}
?>