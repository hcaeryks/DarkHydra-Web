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
        <span style="text-align: center; color: #F0F0F0;"><h1 class="display-4"><i class="fa fa-users" aria-hidden="true"></i> Usuários</h1></span>
        <br><br>
        <div class="container bluebg">
            <span style="color: #DEDEDE; font-size: 20px;">Pesquisa:</span> 
            <input class="form-control" type="text" id="txtPesquisa">
        </div>
        <br>
        <div class="container bluebg">
            <div id="peopleList">
            </div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
        const people = document.getElementById('peopleList');
        let text = "";
        let userType = "";

        $("#txtPesquisa").keyup(function(){
            var query = $(this).val();
            $('.personSmall').show();
            $('.personSmall:not(:contains("'+query+'"))').hide();
        });

        $(() => {
            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/user/perfil/t",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        if(data[i]['tipoUsuario'] == "comum") {
                            userType = "<span style='color: #BA56E8; font-size: 16px;'>Usuário</span>";
                        } else if(data[i]['tipoUsuario'] == "desenvolvedor") {
                            userType = "<span style='color: #56A1E8; font-size: 16px;'>Desenvolvedor</span>";
                        } else if(data[i]['tipoUsuario'] == "gestor") {
                            userType = "<span style='color: #E8A956; font-size: 16px;'>Gestor</span>";
                        } else if(data[i]['tipoUsuario'] == "admin") {
                            userType = "<span style='color: #E85656; font-size: 16px;'>Administrador</span>";
                        } else {
                            userType = "<span style='color: #E856DC; font-size: 16px;'>Administrador</span>";
                        }

                        text = "";
                        text += "<div class='personSmall' style='background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url("+data[i]['destaquePerfil']+"); background-size: cover;' onclick='window.location.href = \"perfiljava.php?u="+data[i]['idPerfil']+"\"'>";
                        text += "<img class='perfilFoto' src='"+data[i]['imagemPerfil']+"' width='75' height='75'>";
                        text += "<h5 class='perfilNome'>"+data[i]['nomePerfil']+" <span style='font-size: 20px;'>("+data[i]['nomeUsuario']+")</span> "+userType+"</h5>"
                        text += "</div>";
                        
                        people.innerHTML += text;
                    }

                }
            });
        })
    </script>
    <br>
</body>
</html>