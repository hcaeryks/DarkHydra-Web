<?php
    session_start();
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
    <link rel="stylesheet" href="./css/lightbox.min.css">
    <link rel="stylesheet" href="./css/jogo.css">
</head>
<body>
    <br>
    <?php
        echo '<input type="hidden" id="hiddenID" value="'.$_GET['id'].'">';
    ?>
    <div class="container bluebg">
        <div id="gameBanner"></div>
        <br>
        <div class="container">
          <div id="gameContent">
            <div class="row">
              <div class="col-3" id="gameFoto">
              </div>
              <div class="col-9">
                <span class="white-text"><h1 id="gameTitulo" class="display-4"></h1></span>
                <br>
                <span class="white-text" id="gameDesc"></span>
                <br>
                <span class="white-text" id="gameTags"></span>
                <br>
                <span class="white-text" id="gameDevs"></span>
              </div>
            </div>
            <br><br>
            <div class="d-flex justify-content-center" id="img1">
              <?php
                if(isset($_SESSION['LOGGED'])) {
                  include './php/config.php';
                  $result = $conn->query("SELECT idRelacao FROM jogo_usuario WHERE idJogo = ".$_GET['id']." AND idUsuario = ".$_SESSION['ID']);
                  if ($result->num_rows > 0) {
                    echo '<input type="button" class="btn btn-danger" value="Remover Licensa" onclick="location.href = \'./php/game_rem_java.php?gameID='.$_GET['id'].'\'">';
                  } else {
                    echo '<input type="button" class="btn btn-primary" value="Adquirir o jogo" onclick="location.href = \'./php/game_add_java.php?gameID='.$_GET['id'].'\'">';
                  }
                } else {
                  echo '<input type="button" class="btn btn-secondary" value="Entre com sua conta para adquirir o jogo!">';
                }
              ?>
            </div>
            <div class="row">
              <div class="col-3">
              </div>
              <div class="col-6">
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
                </div>
              <div class="col-3">
              </div>
            </div>
          </div>
        </div>
    </div>
    <br>
    <?php
      if(isset($_SESSION['LOGGED'])) {
        echo '<div class="container bluebg">';
        echo '<span style="text-align: left; width: 100%; color: #F0F0F0;"><h1 class="display-4"><i class="fa fa-pencil" aria-hidden="true"></i> Comentar</h1></span>';
        echo '<form method="post" action="./php/comentar_java.php?">';
        echo '<textarea id="comentarioSend" name="comentarioSend"></textarea>';
        echo '<div class="wraptipo">';
        echo '<br><h4 style="color: #DEDEDE;">Sua avaliação foi:</h4>';
        echo '
        <input type="radio" name="tipoReview" value="positiva"> <span style="color: #71D45B;">Positiva</span><br>
        <input type="radio" name="tipoReview" value="negativa"> <span style="color: #D45B5B;">Negativa</span><br>';
        echo '</div><br>';
        echo '<input type="hidden" name="idJogo" value="'.$_GET['id'].'">';
        echo '<input class="btn btn-primary" type="submit" value="Enviar" style="float: right;"><br>';
        echo '</form>';
        echo '</div>';
      }
    ?>
    <br>
    <div class="container bluebg">
      <span style="text-align: left; width: 100%; color: #F0F0F0;"><h1 class="display-4"><i class="fa fa-comments" aria-hidden="true"></i>
Comentários</h1></span>
      <div id="comments">

      </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script src="./js/lightbox.min.js"></script>
    <script>
        const id     = document.getElementById('hiddenID');
        const banner = document.getElementById('gameBanner');
        const foto   = document.getElementById('gameFoto');
        const title  = document.getElementById('gameTitulo');
        const desc   = document.getElementById('gameDesc');
        const tags   = document.getElementById('gameTags');
        const devs   = document.getElementById('gameDevs');
        const img1   = document.getElementById('img1');
        let comments = document.getElementById('comments');
        let comment;

      $(() => {
        $.ajax({ 
             type: "GET",
             dataType: "json",
             url: "https://sleepy-river-60466.herokuapp.com/jogos/p?id="+id.value,
             success: function(data){
                banner.style.backgroundImage = "url("+data['imagem4']+")";
                foto.style.backgroundImage   = "url("+data['imagem1']+")";
                title.innerHTML              = data['tituloJogo'];
                desc.innerHTML               = data['descJogo'];
                tags.innerHTML               = "Tags: "+data['tagsJogo'];
                devs.innerHTML               = "Desenvolvedora: <a href='./perfiljava.php?u="+data['produtora']+"'>"+data['nomePerfil']+"</a>";
                //img1.innerHTML               = "<img src='"+data[0]['imagem2']+"' width='200' height='200'>"+"&nbsp&nbsp&nbsp <img src='"+data[0]['imagem3']+"' width='200' height='200'>";
             }
         });
      })
      
      $(() => {
        $.ajax({ 
             type: "GET",
             dataType: "json",
             url: "https://sleepy-river-60466.herokuapp.com/jogos/comentario?id="+id.value,
             success: function(data){
              for(var i = 0; i < data.length; i++) {
                comment = "";
                comment += "<div class='comentarioFull'>";
                comment += "<div class='wrapfoto'>";
                comment += "<img class='fotoPerfil' src='"+data[i]['imagemPerfil']+"' width='100' height='100' onclick='window.location.href = \"perfiljava.php?u="+data[i]['idPerfil']+"\"'>";
                comment += "</div>";
                comment += "<div class='wrapdata' style='padding-left: 20px;'>";
                comment += "<h3 class='nomePerfil' onclick='window.location.href = \"perfiljava.php?u="+data[i]['idPerfil']+"\"'>"+data[i]['nomePerfil']+"</h3>";
                comment += "<h5 class='comentario "+data[i]['tipoComentario']+"'>"+data[i]['comentario']+"</h5>";
                comment += "</div>";
                comment += "</div>";
                comments.innerHTML += comment;
              }
             }
         });
      })
    </script>
    <br><br><br>
</body>
</html>