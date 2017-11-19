<?php
include_once('autoload.php');

$titulo             = 'Registros Importados - Importação de Unidades de Ensino';
$arquivogravacao    = 'gravararquivoescolas';
$telavoltar         = 'escolas';
$tabelaresult       = '[' .
                      ' { "titulo": "Nome", "campo": "nome" }, ' .
                      ' { "titulo": "Cidade", "campo": "cidade" }, ' .
                      ' { "titulo": "Estado", "campo": "estado" } ' .
                      ']';

include_once('importacaofinalizar.php');

?>