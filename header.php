<?php
$js     = array();
header('Content-Type: text/html; charset=utf-8');

include_once('autoload.php');

session_start();

if (!isset($_SESSION['u812hhy']))
{
    header('Location: index.php');
}
else
{
    $encrip     = new lib\encriptacao();

    $usucod     = $_SESSION['u812hhy'];
    $usudesc    = json_decode($encrip->descriptar($usucod));
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
    <body class="h-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fundo">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" height="100" alt="Projeto Trilhas" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menus" aria-controls="menus" aria-expanded="false" aria-label="Navegação Alternada">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menus">
                <ul id="ulmenu" class="navbar-nav mr-auto">
                    <?php
                    $json   = file_get_contents('dados/menus.json');
                    $jsond  = json_decode($json, true);
                    $i      = 0;

                    foreach ($jsond as $menu)
                    {
                        $i++;
                        echo("<li class=\"nav-item dropdown\">\n");
                        echo("\t<a class=\"nav-link dropdown-toggle lnkinicial\" href=\"#\" id=\"mnu$i\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n");
                        echo("\t\t$menu[nome]\n");
                        echo("\t</a>\n");
                        echo("\t<div class=\"dropdown-menu\" aria-labelledby=\"mnu$i\">\n");

                        foreach($menu['menus'] as $item)
                        {
                            if ($item['nome'] != '---')
                            {
                                $url    = $item['url'];

                                if ($url != "#")
                                {
                                    $url    .= '.php';
                                }

                                echo("\t\t<a class=\"dropdown-item\" href=\"$url\">$item[nome]</a>\n");
                            }
                            else
                            {
                                echo("\t\t<div class=\"dropdown-divider\"></div>\n");
                            }
                        }

                        echo("\t</div>\n");
                        echo("</li>\n");
                    }
                    ?>
                </ul>
                <div class="navbar-text text-right" style="color: #f0e0be">
                    Conectado como <strong><?php echo($usudesc->nome); ?></strong>
                    <br />
                    <a href="sair.php" class="lnkinicial">Sair</a>
                </div>
            </div>            
        </nav>