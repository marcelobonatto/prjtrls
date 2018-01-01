<?php
include_once('autoload.php');

$siglaarquivo   = 'quiz';
$titulo         = 'Registros Encontrados - Importação do Quiz';
$paginaretorno  = 'quizimp';
$arquivoleitura = 'lerarquivoquiz';
$acaoform       = 'quizimpfinal';
$tabelaresult   = '{ "temsub": true, ' .
                  '"objeto": { "variavel": "perguntas", "variavelitem": "pergunta" }, ' .
                  '"matrizes": [ { "matriz": "erradas", "variavelitem": "errada" } ], ' .
                  '"colunas": [ { "propsup": "", "campo" : "codigo", "titulo": "Código", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impCodigo" }, ' .
                  '{ "propsup": "", "campo" : "enunciado", "titulo": "Pergunta", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impPergunta" }, ' .
                  '{ "propsup": "", "campo" : "eixo", "titulo": "Eixo", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impEixo" }, ' .
                  '{ "propsup": "", "campo" : "ativo", "titulo": "Ativo", "subtitulo": "", "colunas": 1, "tipo": "check", "controle": "impAtivo" }, ' .
                  '{ "propsup": "certa", "campo" : "codigo", "titulo": "Resposta Certa", "subtitulo": "Código", "colunas": 2, "tipo": "texto", "controle": "impCodigoCerta" }, ' .
                  '{ "propsup": "certa", "campo" : "texto", "titulo": "Resposta Certa", "subtitulo": "Texto", "colunas": 1, "tipo": "texto", "controle": "impTextoCerta" }, ' .
                  '{ "propsup": "errada", "campo" : "codigo", "titulo": "Outras Respostas", "subtitulo": "Código", "colunas": 3, "tipo": "texto", "controle": "impCodigoErrada" }, ' .
                  '{ "propsup": "errada", "campo" : "texto", "titulo": "Outras Respostas", "subtitulo": "Texto", "colunas": 1, "tipo": "texto", "controle": "impTextoErrada" }, ' .
                  '{ "propsup": "errada", "campo" : "nivel", "titulo": "Outras Respostas", "subtitulo": "Nível", "colunas": 1, "tipo": "texto", "controle": "impNivelErrada" } ]' .
                  ' }';

include_once('importacaoarquivo.php');
?>