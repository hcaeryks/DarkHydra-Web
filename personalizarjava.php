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
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/perfil.css">
</head>
<body>
    <br>
    <div class="container">
        <?php
            echo '<input type="hidden" id="idPessoa" value="'.$_SESSION['ID'].'">';
        ?>
        <h1 class="display-4" style="color: #F0F0F0;"><i class="fa fa-pencil" aria-hidden="true"></i> Personalizar Perfil</h1>
        <br>
        <form method="post" action="./php/personalizar_post_java.php">
            <?php
                if(isset($_SESSION['STATUS']) && $_SESSION['STATUS'] == 'ERRORFILL') {
                    echo '
                    <div class="row">
                    <div class="col-5">
                        <div class="alert alert-warning">Preencha todos os campos antes de enviar o formulário.</div>
                    </div>
                    <div class="col-5">
                    </div>
                </div>';
                    $_SESSION['STATUS'] = 'CLEAR';
                }
            ?>
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" style="color: #DEDEDE;">Nome</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="txtName">
                    </div>
                </div>
                <div class="col-5">
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" style="color: #DEDEDE;">Descrição</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="txtDesc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" style="color: #DEDEDE;">URL da foto de perfil</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="urlFoto">
                    </div>
                </div>
                <div class="col-5">
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" style="color: #DEDEDE;">URL da imagem de destaque</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="urlDest">
                    </div>
                </div>
                <div class="col-5">
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
                <div class="col-5">
                </div>
            </div>
        </form>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
        $(() => {
            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/user/perfil/p?u="+$('#idPessoa').val(),
                success: function(data){
                    $('input[name="txtName"]').val(data['nomePerfil']);
                    $('textarea[name="txtDesc"]').val(data['descricaoPerfil']);
                    $('input[name="urlFoto"]').val(data['imagemPerfil']);
                    $('input[name="urlDest"]').val(data['destaquePerfil']);
                }
            });
        })
    </script>
    <br><br><br>
</body>
</html>