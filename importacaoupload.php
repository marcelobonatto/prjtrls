<?php
$diretorio      = realpath('tmp/');
$arquivo        = $_FILES['fileCSV']['name'];
$arquivocompl   = $diretorio . '/' . basename($siglaarquivo . '_' . date('YmdHis') . '.csv');
$arquivotmp     = $_FILES['fileCSV']['tmp_name'];

$erro           = 0;

if ($arquivo != null)
{
    $tipoArquivo    = pathinfo($arquivo, PATHINFO_EXTENSION);

    if (strtoupper($tipoArquivo) == 'CSV')
    {
        if (!move_uploaded_file($arquivotmp, $arquivocompl))
        {
            $erro   = 1;
        }
    }
    else
    {
        $erro       = 2;
    }
}
else
{
    $erro   = 3;
}
?>