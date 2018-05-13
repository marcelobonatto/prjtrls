<!DOCTYPE html>
<html lang="pt-BR" class="h-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Saga das Profissões</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../css/ext/bootstrap.min.css" />

        <link rel="stylesheet" href="../../css/ext/material-icons.css" />
        <link rel="stylesheet" href="../../css/prjtrls.css" />
    </head>
    <body class="h-100">
        <h1>Teste de WS - Cadastrar Usu&aacute;rio</h1>

        <div class="form-group">
            <label for="txtChave">Chave</label>
            <input type="text" class="form-control" id="txtChave" aria-describedby="txtChaveAjuda" placeholder="Informe a chave do sistema" required />
            <small id="txtChaveAjuda" class="form-text text-muted">
                A chave consiste em uma data no formato aaaaMMMddHHmmss e a chave do sistema
            </small>
        </div>
        <div class="form-group">
            <label for="txtValor">Valor</label>
            <input type="text" class="form-control" id="txtValor" aria-describedby="txtValorAjuda" placeholder="Informe um JSON com o valor" required />
            <small id="txtValorAjuda" class="form-text text-muted">
                Um JSON no formato <span style="font-family: monospace">{ "nome": <i>"nome do usuário"</i>, "senha": <i>"senha do usuário"</i> }</span>
            </small>
        </div>
        <button id="cmdExecutar" type="submit" class="btn btn-primary">Executar</button>
        <br />
        <br />
        <div class="jumbotron">
            <h2>Informado</h2>
            <div id="divInformado" style="font-family: monospace"></div>
            <br />
            <h2>Resultado</h2>
            <div id="divResultado" style="font-family: monospace"></div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#cmdExecutar").click(function() {
                    
                });
            });
        </script>
    </body>
</html>