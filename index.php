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
                        <div id="mensagem" class="alert alert-danger d-none" role="alert">
                        </div>
                        <div class="form-group">
                            <label for="usuario" class="lblinicial">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Informe o nome do seu usuário" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="senha" class="lblinicial">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe a sua senha" required autocomplete="off" />
                        </div>
                        <button id="entrar" type="submit" class="btn btn-primary btninicial">Entrar</button>
                        <br />
                        <br />
                        <a href="esqueci.php" class="lnkinicial">Esqueci minha senha</a>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/ext/jquery-3.2.1.min.js"></script>
        <script src="js/ext/popper.min.js"></script>
        <script src="js/ext/bootstrap.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>