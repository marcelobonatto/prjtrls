<?php
include_once('autoload.php');

use lib\usuario;

if (isset($_POST['hidId']))
{
    $id = $_POST['hidId'];
}
else
{
    header('Location: usuarios.php');
}

include('header.php');
?>
    <div class="conteudo">
    <h1>Cadastro de Usuario - Nova Senha</h1>
    <br />
    </div>
<?php
include('footer.php');
?>