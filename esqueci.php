<!doctype html>
<html lang="pt-BR" class="h-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Projeto Trilhas</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/ext/bootstrap.min.css" />

        <link rel="stylesheet" href="css/ext/material-icons.css" />
        <link rel="stylesheet" href="css/prjtrls.css" />
    </head>
    <body class="h-100 fundointeiro">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-6">
                    <img src="img/logo.png" alt="Projeto Trilhas" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <form id="needs_validation" class="container">
                        <h1 style="color: #C2924F; font-weight: bold">Esqueci Minha Senha</h1>
                        <div id="mensagem" class="alert alert-danger d-none" role="alert">
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="email" class="lblinicial">E-mail para enviar a senha</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Informe o e-mail do seu usuário" required autocomplete="off" />
                        </div>
                        <button id="enviar" type="submit" class="btn btn-primary btninicial">Enviar</button>
                        <button id="voltar" type="button" class="btn btn-primary btninicial">Voltar</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/ext/jquery-3.2.1.min.js"></script>
        <script src="js/ext/popper.min.js"></script>
        <script src="js/ext/bootstrap.min.js"></script>
        <script src="js/esqueci.js"></script>
    </body>
</html>