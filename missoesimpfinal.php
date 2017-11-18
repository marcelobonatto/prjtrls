<?php
include_once('autoload.php');

$titulo             = 'Registros Importados - Importação de Missões';
$arquivogravacao    = 'gravararquivomissoes';
$telavoltar         = 'missoes';
$tabelaresult       = '[' .
                      ' { "titulo": "Nome", "campo": "nome" }, ' .
                      ' { "titulo": "Título", "campo": "titulo" } ' .
                      ']';

include_once('importacaofinalizar.php');
?>