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
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-image: url('./assets/navpattern3.png');">
        <div class="container">
            <a class="navbar-brand" style="color: #FFFFFF;"><img src="./assets/logo_arian.png" width="40" height="40"> Dark Hydra</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        Loja</a>
                    </li>
                    <?php
                            if(isset($_SESSION['LOGGED'])) {
                                include './php/config.php';
                                $sql = "SELECT nomeUsuario FROM usuario WHERE idUsuario = ".$_SESSION['ID'];
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $extraclass = "";
                                if($_GET['u'] == $_SESSION['ID']) {
                                    $extraclass = "active";
                                }
                                echo '
                                    <li class="nav-item '.$extraclass.'">
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
    <?php
        echo '<input type="hidden" id="hiddenID" value="'.$_GET['u'].'">';
    ?>
    <div class="container">
        <div class="perfil-header row">
            <div class="col-2" id="userFoto"></div>
            <div class="col-10" id="userData">
                <div class="row">
                    <span id="userNome"></span>
                    <br>
                    <span id="userDesc"></span>
                </div>
            </div>
        </div>
        <br>
        <div id="destHere">
        </div>
        <br>
        <div class="d-flex justify-content-end">
        <?php
            if($_GET['u'] == $_SESSION['ID']) {
                echo '<input type="button" class="btn btn-primary" value="Personalizar Perfil" onclick="personalizar();">';
                if($_SESSION['TIPO'] == "desenvolvedor") {
                    echo '&nbsp&nbsp<input type="button" class="btn btn-info" value="Enviar Jogo" onclick="upload();">';
                } else if($_SESSION['TIPO'] == "admin") {
                    echo '&nbsp&nbsp<input type="button" class="btn btn-info" value="Painel de Administração" onclick="admin();">';
                    echo '&nbsp&nbsp<input type="button" class="btn btn-info" value="Painel de Gestão" onclick="gestao();">';
                } else if($_SESSION['TIPO'] == "gestor") {
                    echo '&nbsp&nbsp<input type="button" class="btn btn-info" value="Painel de Gestão" onclick="gestao();">';
                }
            } else {
                include './php/config.php';

                $result = $conn->query("SELECT idRelacao FROM seguidor WHERE idSeguidor = ".$_SESSION['ID']." AND idSeguido = ".$_GET['u']);

                if ($result->num_rows > 0) {
                    echo '<input type="button" class="btn btn-warning" value="Deixar de Seguir" onclick="deixar();">&nbsp&nbsp';
                    echo '<input type="button" class="btn btn-danger" value="Denunciar" onclick="location.href = \'denunciar.php?u='.$_GET['u'].'\'">';
                } else {
                    echo '<input type="button" class="btn btn-info" value="Seguir Perfil" onclick="seguir();">&nbsp&nbsp';
                    echo '<input type="button" class="btn btn-danger" value="Denunciar" onclick="location.href = \'denunciar.php?u='.$_GET['u'].'\'">';
                }

                $result = $conn->query("SELECT tipoUsuario FROM usuario WHERE idUsuario = ".$_GET['u']);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if($row['tipoUsuario'] == "comum") {
                        echo '&nbsp&nbsp<input type="button" class="btn btn-dark" value="Tornar Gestor" onclick="gestor();">';
                        if($_SESSION['TIPO'] == "admin" || $_SESSION['TIPO'] == "gestor") {
                            echo '&nbsp&nbsp<input type="button" class="btn btn-danger" value="Banir Temporariamente" onclick="">';
                            echo '&nbsp&nbsp<input type="button" class="btn btn-danger" value="Banir Permanentemente" onclick="">';
                        }
                    } else if($row['tipoUsuario'] == "gestor") {
                        echo '&nbsp&nbsp<input type="button" class="btn btn-dark" value="Tornar Comum" onclick="comum();">';
                    }
                }

            }
        ?>
        </div>
        <br>
        <div class="row">
            <div class="col badmargin bluebg" id="okBoomer">
                <h5 class="display-4"><i class="fa fa-rocket" aria-hidden="true"></i> Jogos <span id="extra"></span>
                </h5>
                <br>
                <div id="meusJogos">                    
                </div>
            </div>
            <div class="col badmargin bluebg" id="hideThisToo">
                <h5 class="display-4"><i class="fa fa-users" aria-hidden="true"></i> Amigos
                </h5>
                <br>
                <div id="meusAmigos">                    
                </div>
            </div>
        </div>
        <br>
        <div class="row" id="hideThis">
            <div class="col badmargin bluebg">
                <h5 class="display-4"><i class="fa fa-list-ul" aria-hidden="true"></i> Seguidores
                </h5>
                <br>
                <div id="meusSeguidores">                    
                </div>
            </div>
            <div class="col badmargin bluebg">
                <h5 class="display-4"><i class="fa fa-list-ul" aria-hidden="true"></i> Seguindo
                </h5>
                <br>
                <div id="meusSeguidos">                    
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
        const id      = document.getElementById('hiddenID');
        const foto    = document.getElementById('userFoto');
        const nome    = document.getElementById('userNome');
        const desc    = document.getElementById('userDesc');
        const dest    = document.getElementById('destHere');
        let fullbody  = document.getElementById('meusJogos');
        let fullgames = document.getElementById('meusAmigos');
        let fullseg1  = document.getElementById('meusSeguidores');
        let fullseg2  = document.getElementById('meusSeguidos');
        let textg     = "";
        let texta     = "";
        let tipo      = "";
        let userType  = "";

        $(() => {
        $.ajax({ 
             type: "GET",
             dataType: "json",
             url: "https://sleepy-river-60466.herokuapp.com/user/perfil/p?u="+id.value,
             success: function(data){
                tipo = data['tipoUsuario'];
                if(tipo == "comum") {
                    userType = "<span style='color: #BA56E8;'>Usuário</span>";
                } else if(tipo == "desenvolvedor") {
                    userType = "<span style='color: #56A1E8;'>Desenvolvedor</span>";
                } else if(tipo == "gestor") {
                    userType = "<span style='color: #E8A956;'>Gestor</span>";
                } else if(tipo == "admin") {
                    userType = "<span style='color: #E85656;'>Administrador</span>";
                } else {
                    userType = "<span style='color: #E856DC;'>Não especificado</span>";
                }

                foto.innerHTML       = "<img src="+data['imagemPerfil']+" width='150' height='150' style='margin-top: 10px;'>"
                nome.innerHTML       = "<h1 class='display-4'>"+data['nomePerfil']+"</h1><h3>Perfil de "+userType+"</h3>";
                nome.style.marginTop = "10px";
                nome.style.color     = "#F0F0F0";
                desc.innerHTML       = data['descricaoPerfil'];
                desc.style.color     = "#E0E0E0";
                dest.innerHTML       = "<div class='card bg-dark text-white row'>"+
                                        "<img class='card-img' src='"+data['destaquePerfil']+"' alt='Card image'>"+
                                        "<div class='card-img-overlay'>"+
                                          "<h5 class='card-title'>Imagem Destaque</h5>"+
                                        "</div>"+
                                       "</div>";

                if(tipo != "desenvolvedor") {
                    $.ajax({ 
                        type: "GET",
                        dataType: "json",
                        url: "https://sleepy-river-60466.herokuapp.com/jogos/m?u="+id.value,
                        success: function(data){
                            for(var i = 0; i < data.length; i++) {
                                textg += '<div class=\'jogoSmall\' style=\'background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('+data[i]['imagem2']+'); background-size: cover;\' onclick=\'location.href = "jogo.php?id='+data[i]['idJogo']+'"\'>';
                                textg += '<img src="'+data[i]['imagem1']+'" width="140" height="140" style="float: left; margin-top: 5px; margin-left: 5px;">';
                                textg += '<span class="jogoPerfilSmall">'+data[i]['tituloJogo']+'</span>'
                                textg += '</div>';
                            }

                            fullbody.innerHTML = textg;
                        }
                    });

                    $.ajax({ 
                        type: "GET",
                        dataType: "json",
                        url: "https://sleepy-river-60466.herokuapp.com/user/perfil/seguidor/mutuo?u="+id.value,
                        success: function(data){
                            texta = "";
                            for(var i = 0; i < data.length; i++) {
                                texta += '<div class=\'pessoaSmall\' style=\'background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('+data[i]['destaquePerfil']+'); background-size: cover;\' onclick=\'location.href = "perfil.php?u='+data[i]['idSeguido']+'"\'>';
                                texta += '<img src="'+data[i]['imagemPerfil']+'" width="140" height="140" style="float: left; margin-top: 5px; margin-left: 5px;">';
                                texta += '<span class="nomePerfilSmall">'+data[i]['nomePerfil']+'</span>'
                                texta += '</div>';
                            }

                            fullgames.innerHTML = texta;
                        }
                    });

                    $.ajax({ 
                            type: "GET",
                            dataType: "json",
                            url: "https://sleepy-river-60466.herokuapp.com/user/perfil/seguidor/sigo?u="+id.value,
                            success: function(data){
                                texta = "";
                                for(var i = 0; i < data.length; i++) {
                                    texta += '<div class=\'pessoaSmall\' style=\'background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('+data[i]['destaquePerfil']+'); background-size: cover;\' onclick=\'location.href = "perfil.php?u='+data[i]['idSeguido']+'"\'>';
                                    texta += '<img src="'+data[i]['imagemPerfil']+'" width="140" height="140" style="float: left; margin-top: 5px; margin-left: 5px;">';
                                    texta += '<span class="nomePerfilSmall">'+data[i]['nomePerfil']+'</span>'
                                    texta += '</div>';
                                }

                                fullseg2.innerHTML = texta;
                            }
                    });

                    $.ajax({ 
                        type: "GET",
                        dataType: "json",
                        url: "https://sleepy-river-60466.herokuapp.com/user/perfil/seguidor/seguem?u="+id.value,
                        success: function(data){
                            texta = "";
                            for(var i = 0; i < data.length; i++) {
                                texta += '<div class=\'pessoaSmall\' style=\'background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('+data[i]['destaquePerfil']+'); background-size: cover;\' onclick=\'location.href = "perfil.php?u='+data[i]['idSeguidor']+'"\'>';
                                texta += '<img src="'+data[i]['imagemPerfil']+'" width="140" height="140" style="float: left; margin-top: 5px; margin-left: 5px;">';
                                texta += '<span class="nomePerfilSmall">'+data[i]['nomePerfil']+'</span>'
                                texta += '</div>';
                            }

                            fullseg1.innerHTML = texta;
                        }
                    });
                } else {
                    $.ajax({ 
                        type: "GET",
                        dataType: "json",
                        url: "https://sleepy-river-60466.herokuapp.com/jogos/e?u="+id.value,
                        success: function(data){
                            document.getElementById('extra').innerHTML = "deste Desenvolvedor"
                            for(var i = 0; i < data.length; i++) {
                                textg += '<div class=\'jogoSmall\' style=\'background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('+data[i]['imagem2']+'); background-size: cover;\' onclick=\'location.href = "jogo.php?id='+data[i]['idJogo']+'"\'>';
                                textg += '<img src="'+data[i]['imagem1']+'" width="140" height="140" style="float: left; margin-top: 5px; margin-left: 5px;">';
                                textg += '<span class="jogoPerfilSmall">'+data[i]['tituloJogo']+'</span>'
                                textg += '</div>';
                            }

                            fullbody.innerHTML = textg;
                        }
                    });

                    $("#hideThisToo").hide();
                    $("#hideThis").hide();
        }
            }
        });

        
      })

      function personalizar() {
          window.location.href = './personalizar.php';
      }      
      
      function seguir() {
          window.location.href = './php/seguir.php?u='+id.value;
      }   

      function deixar() {
          window.location.href = './php/deixar.php?u='+id.value;
      }

      function upload() {
          window.location.href = './enviarjogo.php';
      }

      function gestor() {
          window.location.href = './php/tornar_gestor.php?u='+id.value;
      }

      function comum() {
          window.location.href = './php/tornar_comum.php?u='+id.value;
      }

      function gestao() {
          window.location.href = './gestao.php';
      }

      function admin() {
          window.location.href = './administracao.php';
      }
    </script>
    <br><br><br>
    <footer class="page-footer font-small fixed-bottom">
      <div class="footer-copyright text-center py-3" style="color: #DEDEDE; background-image: url('./assets/navpattern3.png')">© 2019 Copyright:
        <a href="https://darkhydra.games"> DarkHydra</a> ◆ <a href="faleconosco.php">Fale Conosco</a> ◆ <a href="sobre.php">Sobre</a>
      </div>
    </footer>
</body>
</html>