<?php
require_once('../autoload.php');

use lib\usuario;
use lib\encriptacao;

if (!isset($_POST['usuario']))
{
    echo('Usuário não informado');
}
else if (!isset($_POST['senha']))
{
    echo('Senha não informada');
}
else
{
    $usuario = new usuario();

    $ok = $usuario->VerificarConexao($_POST['usuario'], $_POST['senha']);

    if ($ok === TRUE)
    {
        $encrip                 = new encriptacao();

        $usucod = "{ \"id\": \"$usuario->id\", \"nome\": \"$usuario->nome\" }";

        session_start();
        $_SESSION['u812hhy']    = $encrip->encriptar($usucod);

        echo('OK');
    }
    else
    {
        echo('Deu erro');
    }
}
?>