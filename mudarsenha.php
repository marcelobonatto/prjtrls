<?php
include_once('autoload.php');

if (!isset($_GET['c']))
{
    header('Location: index.php');
}
else
{
    $chave  = $_GET['c'];
}

$valido     = 0;

$usuario    = new lib\usuario();

$chavex     = urldecode($chave);

if ($usuario->VerificarChaveReset($chavex))
{
    $valido = 1;
}

$chaved     = base64_decode($chavex);

$email      = substr($chaved, 14);

$datac      = new DateTime(substr($chaved, 0, 4) . '-' . substr($chaved, 4, 2)  . '-' . substr($chaved, 6, 2) . ' ' . 
                           substr($chaved, 8, 2) . ':' . substr($chaved, 10, 2) . ':' . substr($chaved, 12, 2));

$agora      = new DateTime('now');

$interval   = $datac->diff($agora);

if ((int)$interval->format('%a') >= 2)
{
    $valido = -1;
}
?>
<!doctype html>
<html lang="pt-BR" class="h-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Saga das Profissões</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/ext/bootstrap.min.css" />

        <link rel="stylesheet" href="css/ext/material-icons.css" />
        <link rel="stylesheet" href="css/prjtrls.css" />
    </head>
    <body class="h-100 fundointeiro">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-6">
                    <img src="img/logo.png" alt="Saga das Profissões" class="img-fluid" />
                </div>
                <div class="col-md-6">
                <?php
                switch ($valido)
                {
                    case -1:
                        echo('<div id="problemo" class="alert alert-danger" role="alert">' .
                                '<i class="material-icons">&#xE002;</i> Este c&oacute;digo j&aacute; n&atilde;o &eacute; mais v&aacute;lido.' .
                             '</div>' .
                             '<button id="voltar" type="button" class="btn btn-primary btninicial">Voltar</button>');
                        break;
                    case 0:
                        echo('<div id="problemo" class="alert alert-danger" role="alert">' .
                                '<i class="material-icons">&#xE002;</i> Este c&oacute;digo n&atilde;o existe.' .
                             '</div>' .
                             '<button id="voltar" type="button" class="btn btn-primary btninicial">Voltar</button>');
                        break;
                    case 1:
                ?>
                    <form id="needs_validation" class="container">
                        <h1 style="color: #C2924F; font-weight: bold">Trocar Senha</h1>
                        <div id="mensagem" class="alert alert-danger d-none" role="alert">
                        </div>
                        <br />
                        <input type="hidden" id="email" value="<?php echo($email); ?>" />
                        <div class="form-group">
                            <label for="novasenha" class="lblinicial">Nova senha</label>
                            <input type="password" class="form-control" id="novasenha" name="novasenha" placeholder="Informe uma nova senha" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="repeticao" class="lblinicial">Repita a nova senha</label>
                            <input type="password" class="form-control" id="repeticao" name="repeticao" placeholder="Repita a senha nova" required autocomplete="off" />
                        </div>
                        <button id="enviar" type="submit" class="btn btn-primary btninicial">Enviar</button>
                        <button id="voltar" type="button" class="btn btn-primary btninicial">Voltar</button>
                    </form>
                <?php
                    break;
                }
                ?>                    
                </div>
            </div>
        </div>

        <script src="js/ext/jquery-3.2.1.min.js"></script>
        <script src="js/ext/popper.min.js"></script>
        <script src="js/ext/bootstrap.min.js"></script>
        <script src="js/mudarsenha.js"></script>
    </body>
</html>