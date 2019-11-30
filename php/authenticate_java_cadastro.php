<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $email = $_GET['email'];
    $login = $_GET['login'];
    $senha = $_GET['senha'];
    $idusr = rand(10000, 99999);

    $lorem = "Utilize esse espaço no seu perfil para falar sobre si mesmo ou sobre qualquer coisa!";

    if(!$email == "" || $login == "" || $senha == "") {
        $sql = "INSERT INTO usuario(idUsuario, nomeUsuario, emailUsuario, senhaUsuario) VALUES($idusr, '$login', '$email', '$senha')";
        $result = $conn->query($sql);
        $sql = "INSERT INTO perfil(idPerfil, nomePerfil, descricaoPerfil) VALUES($idusr, '$login', '$lorem')";
        $result = $conn->query($sql);
        header('location:../index.php');
    } else {
        $_SESSION['STATUS'] = 'ERROR';
        header('location:../index.php');
    }

    ob_end_flush();
?>