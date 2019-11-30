<?php
    session_start();

    if(!isset($_SESSION['LOGGED'])) {
        header('location:index.php');
    } else if($_SESSION['TIPO'] != "admin") {
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
                        Loja</a>
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
        <h1 class="display-4" style="color: #F0F0F0;"><i class="fa fa-terminal" aria-hidden="true"></i> Painel de Administração</h1>
        <br><br>
        <div class="d-flex">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Fale Conosco</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Denuncias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Desenvolvedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#jogos" role="tab" aria-controls="contact" aria-selected="false">Jogos</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <div class="row">
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye-slash" aria-hidden="true"></i> Não Lidos</h1>
                        <div id="faleNao"></div>
                    </div>
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye" aria-hidden="true"></i> Já Lidos</h1>
                        <div id="faleSim"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                <div class="row">
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye-slash" aria-hidden="true"></i> Não Revisados</h1>
                        <div id="denunNao"></div>
                    </div>
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye" aria-hidden="true"></i> Já Revisados</h1>
                        <div id="denunSim"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <br>
                <div class="row">
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye-slash" aria-hidden="true"></i> Não Ativados</h1>
                        <div id="devNao"></div>
                    </div>
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye" aria-hidden="true"></i> Já Ativados</h1>
                        <div id="devSim"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="jogos" role="tabpanel" aria-labelledby="jogos-tab">
                <br>
                <div class="row">
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-eye-slash" aria-hidden="true"></i> Pedidos não Vistos</h1>
                        <div id="jogoNao"></div>
                    </div>
                    <div class="col">
                        <h1 class="titles"><i class="fa fa-gamepad" aria-hidden="true"></i> Formulário</h1>
                        <form method="post" action="./php/form_jogo.php" id="frmStyle">
                            <?php
                                if(isset($_SESSION['STATUS'])) {
                                    if($_SESSION['STATUS'] == "ERROR") {
                                        echo '<div class="alert alert-danger">Erro</div>';
                                        $_SESSION['STATUS'] = "CLEAR";
                                    } else if($_SESSION['STATUS'] == "SUCCESS") {
                                        echo '<div class="alert alert-success">Sucesso</div>';
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
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="tagsJogo">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nome do .Zip</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="zipJogo">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">URL: Imagem 1</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="imagem1">
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
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="pathExec">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Produtora</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="produtora">
                                    <?php
                                        include './php/config.php';

                                        $result = $conn->query("SELECT idUsuario, razaoSocial FROM usuario WHERE tipoUsuario = 'desenvolvedor'");

                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='".$row['idUsuario']."'>".$row['idUsuario']." - ".$row['razaoSocial']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary" value="Enviar">
                            </div>
                        </form>
                        <h1 class="titles"><i class="fa fa-eye" aria-hidden="true"></i> Já Vistos</h1>
                        <div id="jogoSim"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
        const faleconoscoNew = document.getElementById('faleNao');
        const faleconoscoOld = document.getElementById('faleSim');
        let faleNew = "";
        let faleOld = "";
        const denunciasNew = document.getElementById('denunNao');
        const denunciasOld = document.getElementById('denunSim');
        let denuNew = "";
        let denuOld = "";
        const desenvolvedorNew = document.getElementById('devNao');
        const desenvolvedorOld = document.getElementById('devSim');
        let devNew = "";
        let devOld = "";
        const jogosNew = document.getElementById('jogoNao');
        const jogosOld = document.getElementById('jogoSim');
        let jogNew = "";
        let jogOld = "";

        $(() => {
            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/faleconosco/new",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        faleNew += '<div class="faleconosco bluebg">';
                        faleNew += '<form method="post" action="./php/faleconosco_visto.php">';
                        faleNew += '<input type="hidden" name="idThing" value="'+data[i]['idMensagem']+'">';
                        faleNew += '<span class="personitem" onclick="location.href = \'perfil.php?u='+data[i]['idPerfil']+'\'"><img src="'+data[i]['imagemPerfil']+'" width="50" height="50" style="display: inline; border-radius: 50%;">';
                        faleNew += '<span class="nomes"><span>'+data[i]['nomePerfil']+'</span><span> ('+data[i]['nomeUsuario']+')</span></span></span>';
                        faleNew += '<br>';
                        faleNew += '<h3 style="display: inline;">Email: </h3><h5 style="display: inline;">'+data[i]['emailUsuario']+'</h5>';
                        faleNew += '<br>';
                        faleNew += '<h3 style="display: inline;">Tópico: </h3><h5 style="display: inline;">'+data[i]['topico']+'</h5>';
                        faleNew += '<h3>Mensagem:</h3>';
                        faleNew += '<h5 class="wraptext">'+data[i]['mensagem']+'</h5>';
                        faleNew += '<div class="d-flex justify-content-end">';
                        faleNew += '<input type="submit" class="btn btn-primary" value="Marcar como Lido">';
                        faleNew += '</div>';
                        faleNew += '</form>';
                        faleNew += '</div>';
                    }
                    faleconoscoNew.innerHTML = faleNew;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/faleconosco/old",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        faleOld += '<div class="faleconosco bluebg">';
                        faleOld += '<form method="post" action="./php/faleconosco_naovisto.php">';
                        faleOld += '<input type="hidden" name="idThing" value="'+data[i]['idMensagem']+'">';
                        faleOld += '<span class="personitem" onclick="location.href = \'perfil.php?u='+data[i]['idPerfil']+'\'"><img src="'+data[i]['imagemPerfil']+'" width="50" height="50" style="display: inline; border-radius: 50%;">';
                        faleOld += '<span class="nomes"><span>'+data[i]['nomePerfil']+'</span><span> ('+data[i]['nomeUsuario']+')</span></span></span>';
                        faleOld += '<br>';
                        faleOld += '<h3 style="display: inline;">Email: </h3><h5 style="display: inline;">'+data[i]['emailUsuario']+'</h5>';
                        faleOld += '<br>';
                        faleOld += '<h3 style="display: inline;">Tópico: </h3><h5 style="display: inline;">'+data[i]['topico']+'</h5>';
                        faleOld += '<h3>Mensagem:</h3>';
                        faleOld += '<h5 class="wraptext">'+data[i]['mensagem']+'</h5>';
                        faleOld += '<div class="d-flex justify-content-end">';
                        faleOld += '<input type="submit" class="btn btn-warning" value="Marcar como não Lido">';
                        faleOld += '</div>';
                        faleOld += '</form>';
                        faleOld += '</div>';
                    }
                    faleconoscoOld.innerHTML = faleOld;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/denuncias/new",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        denuNew += '<div class="faleconosco bluebg">';
                        denuNew += '<form method="post" action="./php/denuncias_visto.php">';
                        denuNew += '<input type="hidden" name="idThing" value="'+data[i]['idDenuncia']+'">';
                        denuNew += '<span class="personitem" onclick="location.href = \'perfil.php?u='+data[i]['idDenunciante']+'\'"><span style="color: #4697F2;">Denunciante: </span><img src="'+data[i]['fotoDenunciante']+'" width="50" height="50" style="display: inline; border-radius: 50%;">';
                        denuNew += '<span class="nomes"><span>'+data[i]['nomeDenunciante']+'</span><span> ('+data[i]['userDenunciante']+')</span></span></span>';
                        denuNew += '<br><br>';
                        denuNew += '<span class="personitem" onclick="location.href = \'perfil.php?u='+data[i]['idDenunciado']+'\'"><span style="color: #F24646;">Denunciado: &nbsp</span><img src="'+data[i]['imagemDenunciado']+'" width="50" height="50" style="display: inline; border-radius: 50%;">';
                        denuNew += '<span class="nomes"><span>'+data[i]['nomeDenunciado']+'</span><span> ('+data[i]['userDenunciado']+')</span></span></span>';
                        denuNew += '<br>';
                        denuNew += '<h3 style="display: inline;">Tópico: </h3><h5 style="display: inline;">'+data[i]['topico']+'</h5>';
                        denuNew += '<h3>Mensagem:</h3>';
                        denuNew += '<h5 class="wraptext">'+data[i]['mensagem']+'</h5>';
                        denuNew += '<div class="d-flex justify-content-end">';
                        denuNew += '<input type="submit" class="btn btn-primary" value="Marcar como Lido">';
                        denuNew += '</div>';
                        denuNew += '</form>';
                        denuNew += '</div>';
                    }
                    denunciasNew.innerHTML = denuNew;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/denuncias/old",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        denuOld += '<div class="faleconosco bluebg">';
                        denuOld += '<form method="post" action="./php/denuncias_naovisto.php">';
                        denuOld += '<input type="hidden" name="idThing" value="'+data[i]['idDenuncia']+'">';
                        denuOld += '<span class="personitem" onclick="location.href = \'perfil.php?u='+data[i]['idDenunciante']+'\'"><span style="color: #4697F2;">Denunciante: </span><img src="'+data[i]['fotoDenunciante']+'" width="50" height="50" style="display: inline; border-radius: 50%;">';
                        denuOld += '<span class="nomes"><span>'+data[i]['nomeDenunciante']+'</span><span> ('+data[i]['userDenunciante']+')</span></span></span>';
                        denuOld += '<br><br>';
                        denuOld += '<span class="personitem" onclick="location.href = \'perfil.php?u='+data[i]['idDenunciado']+'\'"><span style="color: #F24646;">Denunciado: &nbsp</span><img src="'+data[i]['imagemDenunciado']+'" width="50" height="50" style="display: inline; border-radius: 50%;">';
                        denuOld += '<span class="nomes"><span>'+data[i]['nomeDenunciado']+'</span><span> ('+data[i]['userDenunciado']+')</span></span></span>';
                        denuOld += '<br>';
                        denuOld += '<h3 style="display: inline;">Tópico: </h3><h5 style="display: inline;">'+data[i]['topico']+'</h5>';
                        denuOld += '<h3>Mensagem:</h3>';
                        denuOld += '<h5 class="wraptext">'+data[i]['mensagem']+'</h5>';
                        denuOld += '<div class="d-flex justify-content-end">';
                        denuOld += '<input type="submit" class="btn btn-warning" value="Marcar como não Lido">';
                        denuOld += '</div>';
                        denuOld += '</form>';
                        denuOld += '</div>';
                    }
                    denunciasOld.innerHTML = denuOld;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/devs/new",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        devNew += '<div class="faleconosco bluebg">';
                        devNew += '<form method="post" action="./php/desenvolvedor_visto.php">';
                        devNew += '<input type="hidden" name="idThing" value="'+data[i]['idUsuario']+'">';
                        devNew += '<h3 style="display: inline;">Id de usuário: </h3><h5 style="display: inline;">'+data[i]['idUsuario']+'</h5>';
                        devNew += '<br>';
                        devNew += '<h3 style="display: inline;">Nome de Usuário: </h3><h5 style="display: inline;">'+data[i]['nomeUsuario']+'</h5>';
                        devNew += '<br>';
                        devNew += '<h3 style="display: inline;">Razão Social: </h3><h5 style="display: inline;">'+data[i]['razaoSocial']+'</h5>';
                        devNew += '<br>';
                        devNew += '<h3 style="display: inline;">Email: </h3><h5 style="display: inline;">'+data[i]['emailUsuario']+'</h5>';
                        devNew += '<br>';
                        devNew += '<h3 style="display: inline;">CNPJ: </h3><h5 style="display: inline;">'+data[i]['cnpj']+'</h5>';
                        devNew += '<div class="d-flex justify-content-end">';
                        devNew += '<input type="submit" class="btn btn-primary" value="Ativar">';
                        devNew += '</div>';
                        devNew += '</form>';
                        devNew += '</div>'
                    }
                    desenvolvedorNew.innerHTML = devNew;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/devs/old",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        devOld += '<div class="faleconosco bluebg">';
                        devOld += '<form method="post" action="./php/desenvolvedor_naovisto.php">';
                        devOld += '<input type="hidden" name="idThing" value="'+data[i]['idUsuario']+'">';
                        devOld += '<h3 style="display: inline;">Id de usuário: </h3><h5 style="display: inline;">'+data[i]['idUsuario']+'</h5>';
                        devOld += '<br>';
                        devOld += '<h3 style="display: inline;">Nome de Usuário: </h3><h5 style="display: inline;">'+data[i]['nomeUsuario']+'</h5>';
                        devOld += '<br>';
                        devOld += '<h3 style="display: inline;">Razão Social: </h3><h5 style="display: inline;">'+data[i]['razaoSocial']+'</h5>';
                        devOld += '<br>';
                        devOld += '<h3 style="display: inline;">Email: </h3><h5 style="display: inline;">'+data[i]['emailUsuario']+'</h5>';
                        devOld += '<br>';
                        devOld += '<h3 style="display: inline;">CNPJ: </h3><h5 style="display: inline;">'+data[i]['cnpj']+'</h5>';
                        devOld += '<div class="d-flex justify-content-end">';
                        devOld += '<input type="submit" class="btn btn-warning" value="Desativar">';
                        devOld += '</div>';
                        devOld += '</form>';
                        devOld += '</div>'
                    }
                    desenvolvedorOld.innerHTML = devOld;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/jogos/new",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        jogNew += '<div class="faleconosco bluebg">';
                        jogNew += '<form method="post" action="./php/jogos_visto.php">';
                        jogNew += '<input type="hidden" name="idThing" value="'+data[i]['idPedido']+'">';
                        jogNew += '<h5 style="text-align: center;">-----Jogo-----</h5>';
                        jogNew += '<h3 style="display: inline;">Nome Jogo: </h3><h5 style="display: inline;">'+data[i]['tituloJogo']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Descrição Jogo: </h3><br><h5 style="display: inline;">'+data[i]['descJogo']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Tags Jogo: </h3><h5 style="display: inline;">'+data[i]['tagsJogo']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Download: </h3><h5 style="display: inline;">'+data[i]['zipJogo']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Executável: </h3><h5 style="display: inline;">'+data[i]['pathExec']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Imagem 1: </h3><h5 style="display: inline;">'+data[i]['imagem1']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Imagem 2: </h3><h5 style="display: inline;">'+data[i]['imagem2']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Imagem 3: </h3><h5 style="display: inline;">'+data[i]['imagem3']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Imagem 4: </h3><h5 style="display: inline;">'+data[i]['imagem4']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h5 style="text-align: center;">-----Produtora-----</h5>';
                        jogNew += '<h3 style="display: inline;">ID: </h3><h5 style="display: inline;">'+data[i]['produtora']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Razão Social: </h3><h5 style="display: inline;">'+data[i]['razaoSocial']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">Email: </h3><h5 style="display: inline;">'+data[i]['emailUsuario']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<h3 style="display: inline;">CNPJ: </h3><h5 style="display: inline;">'+data[i]['cnpj']+'</h5>';
                        jogNew += '<br>';
                        jogNew += '<div class="d-flex justify-content-end">';
                        jogNew += '<input type="submit" class="btn btn-primary" value="Marcar como Lido">';
                        jogNew += '</div>';
                        jogNew += '</form>';
                        jogNew += '</div>'
                    }
                    jogosNew.innerHTML = jogNew;
                }
            });

            $.ajax({ 
                type: "GET",
                dataType: "json",
                url: "https://sleepy-river-60466.herokuapp.com/gestao/jogos/old",
                success: function(data){
                    for(var i = 0; i < data.length; i++) {
                        jogOld += '<div class="faleconosco bluebg">';
                        jogOld += '<form method="post" action="./php/jogos_naovisto.php">';
                        jogOld += '<input type="hidden" name="idThing" value="'+data[i]['idPedido']+'">';
                        jogOld += '<h5 style="text-align: center;">-----Jogo-----</h5>';
                        jogOld += '<h3 style="display: inline;">Nome Jogo: </h3><h5 style="display: inline;">'+data[i]['tituloJogo']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Descrição Jogo: </h3><br><h5 style="display: inline;">'+data[i]['descJogo']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Tags Jogo: </h3><h5 style="display: inline;">'+data[i]['tagsJogo']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Download: </h3><h5 style="display: inline;">'+data[i]['zipJogo']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Executável: </h3><h5 style="display: inline;">'+data[i]['pathExec']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Imagem 1: </h3><h5 style="display: inline;">'+data[i]['imagem1']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Imagem 2: </h3><h5 style="display: inline;">'+data[i]['imagem2']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Imagem 3: </h3><h5 style="display: inline;">'+data[i]['imagem3']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Imagem 4: </h3><h5 style="display: inline;">'+data[i]['imagem4']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h5 style="text-align: center;">-----Produtora-----</h5>';
                        jogOld += '<h3 style="display: inline;">ID: </h3><h5 style="display: inline;">'+data[i]['produtora']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Razão Social: </h3><h5 style="display: inline;">'+data[i]['razaoSocial']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">Email: </h3><h5 style="display: inline;">'+data[i]['emailUsuario']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<h3 style="display: inline;">CNPJ: </h3><h5 style="display: inline;">'+data[i]['cnpj']+'</h5>';
                        jogOld += '<br>';
                        jogOld += '<div class="d-flex justify-content-end">';
                        jogOld += '<input type="submit" class="btn btn-warning" value="Marcar como não Lido">';
                        jogOld += '</div>';
                        jogOld += '</form>';
                        jogOld += '</div>'
                    }
                    jogosOld.innerHTML = jogOld;
                }
            });
        });
    </script>
    <br><br><br>
    <footer class="page-footer font-small fixed-bottom">
      <div class="footer-copyright text-center py-3" style="color: #DEDEDE; background-image: url('./assets/navpattern3.png')">© 2019 Copyright:
        <a href="https://darkhydra.games"> DarkHydra</a> ◆ <a href="faleconosco.php">Fale Conosco</a> ◆ <a href="sobre.php">Sobre</a>
      </div>
    </footer>
</body>
</html>