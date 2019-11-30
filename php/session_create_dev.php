<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $login = $_POST['txtNome'];
    $email = $_POST['txtEmail'];
    $razao = $_POST['txtRazao'];
    $cnpj = $_POST['txtCNPJ'];
    $senha = $_POST['txtSenha'];
    $idusr = rand(10000, 99999);
    $defaultdes = "https://i.imgur.com/UDDDqpp.jpg";

    $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $devdesc = "Use essa área do seu perfil para fazer uma breve descrição sobre sua empresa ou simplesmente sobre o seu perfil de desenvolvedor.";

    if(!$email == "" || $login == "" || $senha == "") {
        $sql = "INSERT INTO usuario(idUsuario, nomeUsuario, emailUsuario, senhaUsuario, tipoUsuario, razaoSocial, CNPJ) VALUES($idusr, '$login', '$email', '$senha', 'desenvolvedor', '$razao', '$cnpj')";
        $result = $conn->query($sql);
        $sql = "INSERT INTO perfil(idPerfil, nomePerfil, descricaoPerfil, destaquePerfil) VALUES($idusr, '$razao', '$lorem', '$defaultdes')";
        $result = $conn->query($sql);
        header('location:../index.php');
    } else {
        $_SESSION['STATUS'] = 'ERROR';
        header('location:../index.php');
    }

    ob_end_flush();
?>