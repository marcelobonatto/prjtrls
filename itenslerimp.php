<?php
include_once('autoload.php');

$siglaarquivo   = 'itensjogo';
$titulo         = 'Registros Encontrados - Importação de Itens';
$paginaretorno  = 'itensimp';
$arquivoleitura = 'lerarquivoitens';
$acaoform       = 'itensimpfinal';
$tabelaresult   = '{ "temsub": true, ' .
                  '"objeto": { "variavel": "itens", "variavelitem": "item" }, ' .
                  '"matrizes": [ ], ' .
                  '"colunas": [ { "propsup": "", "campo" : "nome", "titulo": "Nome", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impNome" }, ' .
                  '{ "propsup": "", "campo" : "nivel", "titulo": "Nível", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impNivel" }, ' .
                  '{ "propsup": "", "campo" : "tipo", "titulo": "Tipo", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impTipo" }, ' .
                  '{ "propsup": "", "campo" : "eixo", "titulo": "Eixo", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impEixo" }, ' .
                  '{ "propsup": "", "campo" : "limite", "titulo": "Limite", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impLimite" }, ' .
                  '{ "propsup": "", "campo" : "bonus", "titulo": "Bônus", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impBonus" }, ' .
                  '{ "propsup": "", "campo" : "preconormal", "titulo": "Preço", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impPreco" } ]' .
                  ' }';

include_once('importacaoarquivo.php');
?>