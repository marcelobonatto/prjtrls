<?php
include_once('autoload.php');

$siglaarquivo   = 'unidadeensino';
$titulo         = 'Registros Encontrados - Importação de Unidades de Ensino';
$paginaretorno  = 'escolasimp';
$arquivoleitura = 'lerarquivoescolas';
$acaoform       = 'escolasimpfinal';
$tabelaresult   = '{ "temsub": false, ' .
                  '"objeto": { "variavel": "escolas", "variavelitem": "escola" }, ' .
                  '"matrizes": [ ], ' .
                  '"colunas": [ { "propsup": "", "campo" : "nome", "titulo": "Nome", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impNome" }, ' .
                  '{ "propsup": "", "campo" : "bairro", "titulo": "Bairro", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impBairro" }, ' .
                  '{ "propsup": "", "campo" : "cidade", "titulo": "Cód. Cidade", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impCodCidade" }, ' .
                  '{ "propsup": "", "campo" : "cidadenome", "titulo": "Cidade", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impCidade" }, ' .
                  '{ "propsup": "", "campo" : "estado", "titulo": "Estado", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impEstado" }, ' .
                  '{ "propsup": "", "campo" : "ativo", "titulo": "Ativo", "subtitulo": "", "colunas": 1, "tipo": "check", "controle": "impAtivo" } ]' .
                  ' }';

include_once('importacaoarquivo.php');
?>