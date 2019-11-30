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
    <link rel="stylesheet" href="./css/master.css">
</head>

<body>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="./assets/slides/1.jpg" alt="First slide" height="350" style="object-fit: cover;">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./assets/slides/2.png" alt="Second slide" height="350" style="object-fit: cover;">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./assets/slides/3.jpg" alt="Third slide" height="350" style="object-fit: cover;">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <?php
      if(isset($_SESSION['STATUS'])) {
        if($_SESSION['STATUS'] == "ERRORACTIVATE") {
          echo '<br><div class="alert alert-warning container">Sua conta ainda precisa ser ativada por um de nossos gestores.</div>';
          $_SESSION['STATUS'] = "CLEAR";
        } else {
          $_SESSION['STATUS'] = "CLEAR";
        }
      }
    ?>
    <br>
    <div class="container bluebg">
      <h1 class="display-4" style="text-align: center; color: #E3E3E3;"><i class="fa fa-star" aria-hidden="true"></i> Destaques</h1>
      <br>
      <div class="row">
        <div class="col" id="destaque1title">
        </div>
        <div class="col" id="destaque2title">
        </div>
        <div class="col" id="destaque3title">
        </div>
      </div>
      <div class="row">
        <div class="col destaques badmargin" id="destaque1">
        </div>
        <div class="col destaques badmargin" id="destaque2">
        </div>
        <div class="col destaques badmargin" id="destaque3">
        </div>
      </div>
    </div>
    <br>
    <br>
    <div class="container bluebg">
      <h1 class="display-4" style="text-align: center; color: #E3E3E3;"><i class="fa fa-flash" aria-hidden="true"></i> Recentes</h1>
      <br>
      <div class="row">
        <div class="col recentes badmargin" id="recente1">
        </div>
        <div class="col recentes badmargin" id="recente2">
        </div>
        <div class="col recentes badmargin" id="recente3">
        </div>
        <div class="col recentes badmargin" id="recente4">
        </div>
      </div>
    </div>
    <br>
    <br>
    <div class="container" style="color: #DEDEDE;">
      <h1 class="display-4" style="text-align: center; color: #E3E3E3;"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Catálogo</h1>
      <br>
      <div class="row">
        <div class="col-3 bluebg">
          <h2>Pesquisa</h2>
          <input type="text" id="txtPesquisa" class="form-control">
        </div>
        <div class="col-1">
        </div>
        <div class="col-8 bluebg" id="gamesList">
        </div>
      </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
      $('.carousel').carousel();

      let gamecont = document.getElementById('gamesList');
      let gamebody = "";

      $("#txtPesquisa").keyup(function(){
        var query = $(this).val();
        $('.singleGame').show();
        $('.singleGame:not(:contains("'+query+'"))').hide();
      });

      $(() => {
        $.ajax({ 
             type: "GET",
             dataType: "json",
             url: "https://sleepy-river-60466.herokuapp.com/jogos/t",
             success: function(data){
                for(var i = 0; i < data.length; i++) {
                  gamebody += "<div class='singleGame row' onclick='location.href = \"jogojava.php?id="+data[i]['idJogo']+"\"'>";
                  gamebody += "<img src='"+data[i]['imagem1']+"' width='125' height='125' style='border-radius: 10px;'>";
                  gamebody += "<span class='gameTitle'>"+data[i]['tituloJogo']+"</span>"
                  gamebody += "<span class='gameTags'>Tags: "+data[i]['tagsJogo']+"</span>"
                  gamebody += "</div><br>"
                }
                
                if(data.length >= 5) {
                  recente1.style.backgroundImage   = "url("+data[data.length - 1]['imagem3']+")";
                  recente1.style.backgroundSize    = "cover";
                  recente2.style.backgroundImage = "url("+data[data.length - 2]['imagem3']+")";
                  recente3.style.backgroundImage = "url("+data[data.length - 3]['imagem3']+")";
                  recente4.style.backgroundImage = "url("+data[data.length - 4]['imagem3']+")";
                  recente1.style.backgroundSize    = "cover";
                  recente2.style.backgroundSize  = "cover";
                  recente3.style.backgroundSize  = "cover";
                  recente4.style.backgroundSize  = "cover";
                  recente1.onclick                 = () => { location.href = 'jogojava.php?id='+data[data.length - 1]['idJogo'] }
                  recente2.onclick               = () => { location.href = 'jogojava.php?id='+data[data.length - 2]['idJogo'] }
                  recente3.onclick               = () => { location.href = 'jogojava.php?id='+data[data.length - 3]['idJogo'] }
                  recente4.onclick               = () => { location.href = 'jogojava.php?id='+data[data.length - 4]['idJogo'] }
                }

                gamecont.innerHTML = gamebody;
             }
         });

         $.ajax({ 
             type: "GET",
             dataType: "json",
             url: "https://sleepy-river-60466.herokuapp.com/jogos/d",
             success: function(data){
                destaque1.style.backgroundImage = "url("+data[0]['imagem3']+")";
                destaque2.style.backgroundImage = "url("+data[1]['imagem3']+")";
                destaque3.style.backgroundImage = "url("+data[2]['imagem3']+")";
                destaque1.style.backgroundSize  = "cover";
                destaque2.style.backgroundSize  = "cover";
                destaque3.style.backgroundSize  = "cover";
                destaque1.onclick               = () => { location.href = 'jogojava.php?id='+data[0]['idJogo'] }
                destaque2.onclick               = () => { location.href = 'jogojava.php?id='+data[1]['idJogo'] }
                destaque3.onclick               = () => { location.href = 'jogojava.php?id='+data[2]['idJogo'] }
                destaque1title.innerHTML = '<h5>' + data[0]['tituloJogo'] + " - " + data[0]['downloads'] + " Download(s)</h5>";
                destaque2title.innerHTML = '<h5>' + data[1]['tituloJogo'] + " - " + data[1]['downloads'] + " Download(s)</h5>";
                destaque3title.innerHTML = '<h5>' + data[2]['tituloJogo'] + " - " + data[2]['downloads'] + " Download(s)</h5>";
                destaque1title.style.textAlign = "center";
                destaque2title.style.textAlign = "center";
                destaque3title.style.textAlign = "center";
                destaque1title.style.color = "#DEDEDE";
                destaque2title.style.color = "#DEDEDE";
                destaque3title.style.color = "#DEDEDE";
             }
         });
      })
    </script>
    <br>
</body>
</html>