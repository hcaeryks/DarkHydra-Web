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
    <link rel="stylesheet" href="./css/comunidade.css">
</head>

<body>
    <br>
    <div class="container">
        <span style="text-align: center; color: #F0F0F0;"><h1 class="display-4"><i class="fa fa-comment" aria-hidden="true"></i> Fale Conosco</h1></span>
        <br><br>
        <div class="container bluebg">
            <form method="post" action="./php/enviarMensagem.php">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-3">
                        <label for="exampleFormControlSelect2"><h1 style="color: #DEDEDE;">Tópico</h1></label>
                        <select class="form-control" id="exampleFormControlSelect2" name="topico">
                            <option value="Problema na plataforma">Problema na plataforma</option>
                            <option value="Dúvida">Dúvida</option>
                            <option value="Feedback">Feedback</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="col-8"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-6">
                        <h3 style="color: #DEDEDE;">Mensagem</h3>
                        <textarea name="txtMensagem" style="width: 100%; height: 300px; resize: none; border: none;"></textarea>
                    </div>
                    <div class="col-5"></div>
                </div>
                <br><br>
                <div class="d-flex justify-content-end">
                    <input type="submit" value="Enviar" class="btn btn-primary">
                </div>
                    <?php
                    if(isset($_SESSION['STATUS'])) {
                        if($_SESSION['STATUS'] == "SUCCESS") {
                        echo '
                        <br><div class="alert alert-success" role="alert">
                            Sucesso!
                        </div>';
                        $_SESSION['STATUS'] = "CLEAR";
                        } else if($_SESSION['STATUS'] == "ERROR"){
                        echo '
                        <br><div class="alert alert-danger" role="alert">
                            Erro!
                        </div>';
                        $_SESSION['STATUS'] = "CLEAR";
                        }
                    }
                    ?>
            </form>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>=
    <br>
</body>
</html>