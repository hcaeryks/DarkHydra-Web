<?php
    session_start();

    if(!isset($_SESSION['LOGGED'])) {
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
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>DarkHydra</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/painel.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-image: url('./assets/navpattern3.png');">
        <div class="container">
            <a class="navbar-brand" style="color: #FFFFFF;"><img src="./assets/logo_arian.png" width="40" height="40"> Dark Hydra</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        Loja <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                            if(isset($_SESSION['LOGGED'])) {
                                include './php/config.php';
                                $sql = "SELECT nomeUsuario FROM usuario WHERE idUsuario = ".$_SESSION['ID'];
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo '
                                    <li class="nav-item">
                                      <a class="nav-link" href="perfil.php?u='.$_SESSION['ID'].'"><i class="fa fa-user"></i>
                                      '.$row['nomeUsuario'].'</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="comunidade.php"><i class="fa fa-users" aria-hidden="true"></i>
                                        Comunidade</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="./php/session_finish.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                        Sair</a>
                                    </li>
                                ';
                            } else {
                                echo '
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                    Login
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <form method="post" action="./php/session_starter.php">
                                          <div class="container">
                                            Login: <br><input type="text" name="txtLogin">
                                            Senha: <br><input type="password" name="txtSenha">
                                            <div class="dropdown-divider"></div>
                                            <input class="btn btn-primary" type="submit" value="Entrar">
                                          </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    Cadastro
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <form method="post" action="./php/session_create.php">
                                          <div class="container">
                                            Email: <br><input type="text" name="txtEmail">
                                            Login: <br><input type="text" name="txtLogin">
                                            Senha: <br><input type="password" name="txtSenha">
                                            <div class="dropdown-divider"></div>
                                            <input class="btn btn-primary" type="submit" value="Cadastrar"><br>
                                            <a href="./login.php">Sou um desenvolvedor.</a>
                                          </div>
                                        </form>
                                    </div>
                                </li>
                                ';
                            }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-6">
            <h1 class="display-4" style="color: #D1D1D1;"><i class="fa fa-code" aria-hidden="true"></i> Formulário</h1>
            <form method="post" action="./php/form_pedido.php" id="frmStyle">
                            <?php
                                if(isset($_SESSION['STATUS'])) {
                                    if($_SESSION['STATUS'] == "ERROR") {
                                        echo '<div class="alert alert-danger">Erro</div>';
                                        $_SESSION['STATUS'] = "CLEAR";
                                    } else if($_SESSION['STATUS'] == "SUCCESS") {
                                        echo '<div class="alert alert-success">Sucesso! Seu jogo será revisado e poderá ser aceito ou não na plataforma.</div>';
                                        $_SESSION['STATUS'] = "CLEAR";
                                    } else {
                                        $_SESSION['STATUS'] = "CLEAR";
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nome do Jogo</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="nomeJogo">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição do Jogo</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="descJogo"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tags do Jogo</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="tagsJogo" placeholder="Ex: Luta, Aventura, Corrida">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Link para Download</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="zipJogo">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">URL: Imagem 1</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="imagem1" placeholder="Utilize imgur para botar as imagens">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">URL: Imagem 2</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="imagem2">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">URL: Imagem 3</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="imagem3">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">URL: Imagem 4</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="imagem4">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Caminho para o Executável</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="pathExec" placeholder="Jogo.exe">
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary" value="Enviar">
                            </div>
                        </form>
            </div>
            <div class="col-6"></div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
    </script>
    <br><br><br>
    <footer class="page-footer font-small fixed-bottom">
      <div class="footer-copyright text-center py-3" style="color: #DEDEDE; background-image: url('./assets/navpattern3.png')">© 2019 Copyright:
        <a href="https://darkhydra.games"> DarkHydra</a> ◆ <a href="faleconosco.php">Fale Conosco</a> ◆ <a href="sobre.php">Sobre</a>
      </div>
    </footer>
</body>
</html>