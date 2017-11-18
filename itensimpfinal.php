<?php
include_once('autoload.php');

$titulo             = 'Registros Importados - Importação de Itens';
$arquivogravacao    = 'gravararquivoitens';
$telavoltar         = 'itens';
$tabelaresult       = '[' .
                      ' { "titulo": "Item", "campo": "item" }, ' .
                      ' { "titulo": "Tipo", "campo": "tipo" } ' .
                      ']';

include_once('importacaofinalizar.php');
?>