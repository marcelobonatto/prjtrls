<?php
include_once('autoload.php');

$siglaarquivo   = 'dfinal';
$titulo         = 'Registros Encontrados - Importação do Desafio Final';
$paginaretorno  = 'dfinalimp';
$arquivoleitura = 'lerarquivodfinal';
$acaoform       = 'dfinalimpfinal';
$tabelaresult   = '{ "temsub": true, ' .
                  '"objeto": { "variavel": "perguntas", "variavelitem": "pergunta" }, ' .
                  '"matrizes": [ { "matriz": "erradas", "variavelitem": "errada" } ], ' .
                  '"colunas": [ { "propsup": "", "campo" : "codigo", "titulo": "Código", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impCodigo" }, ' .
                  '{ "propsup": "", "campo" : "enunciado", "titulo": "Pergunta", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impPergunta" }, ' .
                  '{ "propsup": "", "campo" : "dificuldade", "titulo": "Dificuldade", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impDificuldade" }, ' .
                  '{ "propsup": "", "campo" : "ativo", "titulo": "Ativo", "subtitulo": "", "colunas": 1, "tipo": "check", "controle": "impAtivo" }, ' .
                  '{ "propsup": "certa", "campo" : "codigo", "titulo": "Resposta Certa", "subtitulo": "Código", "colunas": 2, "tipo": "texto", "controle": "impCodigoCerta" }, ' .
                  '{ "propsup": "certa", "campo" : "texto", "titulo": "Resposta Certa", "subtitulo": "Texto", "colunas": 1, "tipo": "texto", "controle": "impTextoCerta" }, ' .
                  '{ "propsup": "errada", "campo" : "codigo", "titulo": "Outras Respostas", "subtitulo": "Código", "colunas": 3, "tipo": "texto", "controle": "impCodigoErrada" }, ' .
                  '{ "propsup": "errada", "campo" : "texto", "titulo": "Outras Respostas", "subtitulo": "Texto", "colunas": 1, "tipo": "texto", "controle": "impTextoErrada" }, ' .
                  '{ "propsup": "errada", "campo" : "nivel", "titulo": "Outras Respostas", "subtitulo": "Nível", "colunas": 1, "tipo": "texto", "controle": "impNivelErrada" } ]' .
                  ' }';

include_once('importacaoarquivo.php');
?>