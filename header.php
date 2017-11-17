<?php
$js     = array();
?>
<!doctype html>
<html lang="pt-BR" class="h-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Projeto Trilhas</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />

        <link rel="stylesheet" href="css/material-icons.css" />
        <link rel="stylesheet" href="css/prjtrls.css" />
    </head>
    <body class="h-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fundo">
            <a class="navbar-brand" href="#">
                <img src="img/logobranco.png" height="50" alt="Projeto Trilhas" />
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
                <div class="navbar-text text-right" style="color: #cddc29">
                    Conectado como <strong>{ Nome do Usuário }</strong>
                    <br />
                    <a href="sair.php" class="lnkinicial">Sair</a>
                </div>
            </div>            
        </nav>