<?php
include_once('header.php');
?>
    <div class="conteudo">
        <h1><?php echo($titulo); ?></h1>
        <br />
        <strong>Clique no botão abaixo para baixar a planilha para preencher os dados</strong>
        <br />
        <br />
        <a href="<?php echo("docs/$planilha.xls"); ?>" class="btn btn-warning" role="button" download>
            <i class="material-icons">&#xE2C4;</i> Baixar Arquivo XLS (Excel)
        </a>
        <a href="<?php echo("docs/$planilha.ods"); ?>" class="btn btn-warning" role="button" download>
            <i class="material-icons">&#xE2C4;</i> Baixar Arquivo ODS (LibreOffice)
        </a>
        <br />
        <br />
        <br />
        <strong>Após o download, abra a planilha e leia as instruções que estão na aba Instruções para saber como preencher a planilha</strong>
        <br />
        <strong>Depois de preencher, clique no botão abaixo para importar o arquivo CVS (Texto Separado por Vírgulas) gerado</strong>
        <br />
        <br />
        <form id="formCSV" method="post" action="<?php echo($leitorimp); ?>.php" enctype="multipart/form-data">
            <strong>Arquivo:</strong>
            <input id="fileCSV" name="fileCSV" type="file" />
            <button id="cmdImportar" class="btn btn-success">
                <i class="material-icons">&#xE2C6;</i> Importar CSV
            </button>
        </form>
    </div>
<?php
include_once('footer.php');
?>