<?php
include_once('autoload.php');

$siglaarquivo   = 'missoes';
$titulo         = 'Registros Encontrados - Importação de Missões';
$paginaretorno  = 'missoesimp';
$arquivoleitura = 'lerarquivomissoes';
$acaoform       = 'missoesimpfinal';
$tabelaresult   = '{ "temsub": true, ' .
                  '"objeto": { "variavel": "missoes", "variavelitem": "missao" }, ' .
                  '"matrizes": [ { "matriz": "eixos", "variavelitem": "eixo" } ], ' .
                  '"colunas": [ { "propsup": "", "campo" : "nome", "titulo": "Nome", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impNome" }, ' .
                  '{ "propsup": "", "campo" : "titulo", "titulo": "Título", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impTitulo" }, ' .
                  '{ "propsup": "", "campo" : "descricao", "titulo": "Descrição", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impDescricao" }, ' .
                  '{ "propsup": "", "campo" : "ativo", "titulo": "Ativo", "subtitulo": "", "colunas": 1, "tipo": "check", "controle": "impAtivo" }, ' .
                  '{ "propsup": "", "campo" : "idmoodle", "titulo": "Id Moodle", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impIdMoodle" }, ' .
                  '{ "propsup": "", "campo" : "ano", "titulo": "Ano", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impAno" }, ' .
                  '{ "propsup": "", "campo" : "semestre", "titulo": "Semestre", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impSemestre" }, ' .
                  '{ "propsup": "", "campo" : "sequencia", "titulo": "Sequência", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impSequencia" }, ' .
                  '{ "propsup": "", "campo" : "obrigatoria", "titulo": "Obrigatória", "subtitulo": "", "colunas": 1, "tipo": "check", "controle": "impObrigatoria" }, ' .
                  '{ "propsup": "", "campo" : "pai", "titulo": "Pai", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impPai" }, ' .
                  '{ "propsup": "", "campo" : "nomepai", "titulo": "Nome Pai", "subtitulo": "", "colunas": 1, "tipo": "texto", "controle": "impNomePai" }, ' .
                  '{ "propsup": "eixo", "campo" : "sigla", "titulo": "Eixo", "subtitulo": "Sigla", "colunas": 2, "tipo": "texto", "controle": "impEixo" }, ' .
                  '{ "propsup": "eixo", "campo" : "pontos", "titulo": "Eixo", "subtitulo": "Pontos", "colunas": 1, "tipo": "texto", "controle": "impEixoPontos" } ]' .
                  ' }';

include_once('importacaoarquivo.php');
?>