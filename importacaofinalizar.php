<?php
include_once('header.php');
include_once('importacaomostrar.php');
?>
    <div class="conteudo">
        <h1><?php echo($titulo); ?></h1>
        <br />
        <?php
        include_once("exec/$arquivogravacao.php");

        $jsontr     = json_decode($tabelaresult);
        $jsonres    = json_decode($resjson);

        mostrarFinal($jsontr, $jsonres);

        echo("<a href=\"$telavoltar.php\" class=\"btn btn-danger\"><i class=\"material-icons\">&#xE5C4;</i> Voltar</a>");
        ?>
    </div>
<?php
include_once('footer.php');
?>