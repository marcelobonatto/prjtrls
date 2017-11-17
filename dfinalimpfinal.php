<?php
include_once('autoload.php');

$titulo             = 'Registros Importados - Importação do Desafio Final';
$arquivogravacao    = 'gravararquivodfinal';
$telavoltar         = 'dfinal';
$tabelaresult       = '[' .
                      ' { "titulo": "Código", "campo": "codigo" }, ' .
                      ' { "titulo": "Pergunta", "campo": "pergunta" } ' .
                      ']';

include_once('importacaofinalizar.php');
?>