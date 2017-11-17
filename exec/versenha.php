<?php
require_once('../autoload.php');

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
    
    if ($usuario->VerificarConexao($_POST['usuario'], $_POST['senha']))
    {
        echo('OK');
    }
    else
    {
        echo('Deu erro');
    }
}

/*if (!isset($_GET['usuario']))
{
    echo('Usuário não informado');
}
else if (!isset($_GET['senha']))
{
    echo('Senha não informada');
}
else
{
    $usuario = new usuario();
    
    if ($usuario->VerificarConexao($_GET['usuario'], $_GET['senha']))
    {
        echo('OK');
    }
    else
    {
        echo('Deu erro');
    }
}*/
?>