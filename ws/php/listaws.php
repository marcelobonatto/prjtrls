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
        <h1>Lista de WS</h1>

        <table class="table table-striped w-100">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descri&ccedil;&atilde;o</th>
                <th>Resposta</th>
                <th>Entrada</th>
                <th>Sa&iacute;da</th>
            </tr>
            <tr>
                <td>01</td>
                <td><a href="frmcadastrarjogador.php">cadastrarjogador</a></td>
                <td>Permite o cadastramento do jogador no sistema</td>
                <td>POST</td>
                <td>
                    <ul>
                        <li>
                            <strong>chave</strong> string base 64 contendo:
                            <ul>
                                <li>
                                    Data e hora no formato yyyyMMddHHmmss
                                </li>
                                <li>
                                    Chave de sistema
                                </li>
                            </ul>
                        </li>
                        <li>
                            <strong>valor</strong> string base 64 contendo um JSON com os valores:
                            <ul>
                                <li>
                                    <strong>nome</strong> nome do usu&aacute;rio no Moodle
                                </li>
                                <li>
                                    <strong>senha</strong> senha do usu&aacute;rio
                                </li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>02</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>03</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>04</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>05</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>06</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>07</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>08</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>09</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>10</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>11</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>12</td>
                <td>cadastrarjogador</td>
            </tr>
            <tr>
                <td>13</td>
                <td>cadastrarjogador</td>
            </tr>
        </table>

        <script src="../../js/ext/jquery-3.2.1.min.js"></script>
        <script src="../../js/ext/popper.min.js"></script>
        <script src="../../js/ext/bootstrap.min.js"></script>
    </body>
</html>