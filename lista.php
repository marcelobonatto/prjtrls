<?php
include_once('header.php');
?>
    <div class="conteudo">
        <h1><?php echo($titulo); ?></h1>
        <br />
        <a href="<?php echo($cadastro); ?>.php?id=novo" class="btn btn-info" role="button">
            <i class="material-icons">&#xE145;</i> Novo
        </a>
        <button id="cmdExcluir" class="btn btn-danger">
            <i class="material-icons">&#xE15D;</i> Desabilitar Selecionados
        </button>
        <?php
        if ($podeImportar)
        {
            echo("<button id=\"cmdImportar\" class=\"btn btn-success\">\n");
            echo("<i class=\"material-icons\">&#xE890;</i> Importar\n");
            echo("</button>\n");
        }
        ?>
        <br />
        <br />
        <div id="lista"></div>
    </div>
<?php
$js[]   = 'js/lista.js';
$js[]   = "js/$meusscripts.js";
include_once('footer.php');
?>