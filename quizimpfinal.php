<?php
include_once('autoload.php');

$titulo             = 'Registros Importados - Importação do Quiz';
$arquivogravacao    = 'gravararquivoquiz';
$telavoltar         = 'quizes';
$tabelaresult       = '[' .
                      ' { "titulo": "Código", "campo": "codigo" }, ' .
                      ' { "titulo": "Pergunta", "campo": "pergunta" } ' .
                      ']';

include_once('importacaofinalizar.php');
?>