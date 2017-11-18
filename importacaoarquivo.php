<?php
include_once('header.php');
include_once('importacaoupload.php');
include_once('importacaomostrar.php');
?>
    <div class="conteudo">
        <h1><?php echo($titulo); ?></h1>
        <br />
        <?php
        $botaoerro  = "<a href=\"$paginaretorno.php\" class=\"btn btn-danger\"><i class=\"material-icons\">&#xE5C4;</i> Voltar</a>";
        $html       = '';

        switch ($erro)
        {
            case 1:
                $html = "Ocorreu um erro na hora de carregar o arquivo!\n<br />\n<br />\n$botaoerro\n";
                break;
            case 2:
                $html = "O arquivo carregado não é um CSV!\n<br />\n<br />\n$botaoerro\n";
                break;
            case 3:
                $html = "Não foi informado nenhum arquivo!\n<br />\n<br />\n$botaoerro\n";
                break;
            default:
                include_once("exec/$arquivoleitura.php");

                if ($erro == 4)
                {
                    $html = "Não conseguimos ler o arquivo!\n<br />\n<br />\n$botaoerro\n";
                }
                else
                {
                    if (count($pos) > 0)
                    {
                        $jsonimp    = json_decode($tabelaresult);
                        $arrvar     = $jsonimp->objeto->variavel;
                        mostrarArquivo($jsonimp, $$arrvar, $acaoform);
                    }
                    else
                    {
                        $html = "O arquivo não tem registros!\n<br />\n<br />\n$botaoerro\n";
                    }
                }

                break;
        }

        if ($html != '')
        {
            echo($html);
        }
        ?>
    </div>
<?php
include_once('footer.php');
?>