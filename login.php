<?php
    session_start();

    if(isset($_SESSION['LOGGED'])) {
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Plataforma de games indie moderna.">
        <meta name="keywords" content="Games, Indie, Plataform">
        <meta name="author" content="Matheus Laureano">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>DarkHydra</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/login.css">
    </head>
    <body>
        <div class="container">
            <form method="post" action="./php/session_create_dev.php">
                <div class="sidenav">
                    <div class="login-main-text">
                        <h2>DarkHydra<br> Registro de Desenvolvedor</h2>
                        <p>Se cadastre aqui para receber acesso à plataforma.</p>
                    </div>
                </div>
                <div class="main">
                    <div class="col-md-6 col-sm-12">
                        <div class="login-form">
                            <form>
                        <div class="form-group">
                            <label>Nome de Usuário</label>
                            <input type="text" class="form-control" name="txtNome">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="txtEmail">
                        </div>
                        <div class="form-group">
                            <label>Razão Social</label>
                            <input type="text" class="form-control" name="txtRazao">
                        </div>
                        <div class="form-group">
                            <label>CNPJ</label>
                            <input type="text" class="form-control" name="txtCNPJ">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="txtSenha">
                        </div>
                        <button type="submit" class="btn btn-black">Registrar</button>
                    </form>
                </div>
         </div>
      </div>
            </form>
        </div>
        <script src="./js/jquery.min.js"></script>
        <script src="./js/popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
    </body>
</html>