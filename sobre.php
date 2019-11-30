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
    <link rel="stylesheet" href="./css/sobre.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-image: url('./assets/navpattern3.png');">
        <div class="container">
            <a class="navbar-brand" style="color: #FFFFFF;"><img src="./assets/logo_arian.png" width="40" height="40"> Dark Hydra</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
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
    <div class="container">
    <h2 class="display-4">Regras</h2>


    <p><h3>O que não fazer na plataforma:</h3></p>

        <p><h4>.Usuário</h4></p>
        <p>-Gerar discussões exageradas ou insultar outros membros.</p>
        <p>-Publicar links para sites maliciosos.</p>
        <p>-Desrespeito aos desenvolvedores e gestores/administradores.</p>
        <p>-Utilização de contas falsas, para melhorar avaliações de jogos.</p>
        <p>-Spam desnecessário em comentários ou denuncias.</p>
        <p>-Tentativa de uso de imagens lascivas, ofensivas e desconfortantes no perfil</p>
        <p>-Descrições constrangedoras, ofensivas ou descriminatórias no perfil.</p>

        <p><h4>.Desenvolvedor</h4></p>
        <p>-Enviar jogos que:</p>
        <p>-Possua conteúdo malicioso.</p>
        <p>-Possua conteúdo ofensivo, lascivo e que gere alguma discriminação.</p>
        <p>-Imagens sejam desconfortantes ou que sejam falsas.</p>
        <p>-Não possuir licença do jogo.</p>
        <p>-Músicas sem direito autoral.</p>
        <p>-Algum tipo de falsidade, deste títulos á conteúdo jogável.</p>
        <p>-Ofender, discriminar ou qualquer tentativa de aproveitamento malicioso dos usuários.</p>
        <p>-Desrespeito aos usuários gestores/administradores.</p>
        <p>-Tentativa de uso de imagens lascivas, ofensivas e desconfortantes no perfil</p>
        <p>-Descrições constrangedoras, ofensivas ou descriminatórias no perfil.</p>

        <p><h3>O que não publicar/comentar</h3></p>

        <p><h3>Proibido publicar e comentar:</h3></p>

        <p>-Conteúdo ou link inapropriado, que possua algo ofensivo, constrangedor e lascivo.</p>
        <p>-Uso de ferramentas, para aproveitamento inapropriado dos recursos da plataforma.</p>
        <p>-Ameaças de violência ou assédio.</p>
        <p>-Publicação de material protegido por direitos autorais.</p>
        <p>-Solicitações, pedidos de presentes, leilões, vendas, propagandas.</p>
        <p>-Racismo ou qualquer outro tipo de discriminação.</p>
        <p>-Linguagem ofensiva.</p>
        <p>-Religião, política ou outros assuntos que causem discussões que não levam a lugar algum.</p>

        <p>Tudo citado acima, gerará consequências, deste suspensão á banimento via IP.</p>
    <h2 class="display-4">
        Política de privacidade para
        <a href="http://darkhydra.000webhostapp.com/">Dark Hydra</a>
    </h2>

    <p>
        Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a
        tornar a sua visita no nosso site o mais produtiva e agradável possível.
    </p>

    <p>
        A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso
        site é importante para o Dark Hydra.
    </p>

    <p>
        Todas as informações pessoais relativas a membros, assinantes, clientes ou
        visitantes que usem o Dark Hydra serão tratadas em concordância com a Lei da
        Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).
    </p>

    <p>
        A informação pessoal recolhida pode incluir o seu nome, e-mail, número de
        telefone e/ou telemóvel, morada, data de nascimento e/ou outros.
    </p>

    <p>
        O uso do Dark Hydra pressupõe a aceitação deste Acordo de privacidade. A
        equipa do Dark Hydra reserva-se ao direito de alterar este acordo sem aviso
        prévio. Deste modo, recomendamos que consulte a nossa política de
        privacidade com regularidade de forma a estar sempre atualizado.
    </p>

    <h2>Os anúncios</h2>

    <p>
        Tal como outros websites, coletamos e utilizamos informação contida nos
        anúncios. A informação contida nos anúncios, inclui o seu endereço IP
        (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo,
        Clix, ou outro), o browser que utilizou ao visitar o nosso website (como o
        Internet Explorer ou o Firefox), o tempo da sua visita e que páginas visitou
        dentro do nosso website.
    </p>

    <h2>Os Cookies e Web Beacons</h2>

    <p>
        Utilizamos cookies para armazenar informação, tais como as suas preferências
        pessoas quando visita o nosso website. Isto poderá incluir um simples popup,
        ou uma ligação em vários serviços que providenciamos, tais como fóruns.
    </p>
    <p>
        Em adição também utilizamos publicidade de terceiros no nosso website para
        suportar os custos de manutenção. Alguns destes publicitários, poderão
        utilizar tecnologias como os cookies e/ou web beacons quando publicitam no
        nosso website, o que fará com que esses publicitários (como o Google através
        do Google AdSense) também recebam a sua informação pessoal, como o endereço
        IP, o seu ISP, o seu browser, etc. Esta função é geralmente utilizada para
        geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de
        Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de
        utilizador (como mostrar publicidade de restaurante a um utilizador que
        visita sites de culinária regularmente, por ex.).
    </p>

    <p>
        Você detém o poder de desligar os seus cookies, nas opções do seu browser,
        ou efetuando alterações nas ferramentas de programas Anti-Virus, como o
        Norton Internet Security. No entanto, isso poderá alterar a forma como
        interage com o nosso website, ou outros websites. Isso poderá afetar ou não
        permitir que faça logins em programas, sites ou fóruns da nossa e de outras
        redes.
    </p>
    <h2>Ligações a Sites de terceiros</h2>
    <p>
        O Dark Hydra possui ligações para outros sites, os quais, a nosso ver, podem
        conter informações / ferramentas úteis para os nossos visitantes. A nossa
        política de privacidade não é aplicada a sites de terceiros, pelo que, caso
        visite outro site a partir do nosso deverá ler a politica de privacidade do
        mesmo.
    </p>
    <p>
        Não nos responsabilizamos pela política de privacidade ou conteúdo presente
        nesses mesmos sites.
    </p>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script>
    </script>
    <br><br><br><br><br>
    <footer class="page-footer font-small fixed-bottom">
      <div class="footer-copyright text-center py-3" style="color: #DEDEDE; background-image: url('./assets/navpattern3.png')">© 2019 Copyright:
        <a href="https://darkhydra.games"> DarkHydra</a> ◆ <a href="faleconosco.php">Fale Conosco</a> ◆ <a href="sobre.php">Sobre</a>
      </div>
    </footer>
</body>
</html>