<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $login = $_GET['login'];
    $senha = $_GET['senha'];

    if(!$login == "" || $senha == "") {
        $sql = "SELECT idUsuario, tipoUsuario FROM usuario WHERE nomeUsuario = '$login' AND senhaUsuario = '$senha'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $_SESSION['LOGGED'] = 'TRUE';
            $_SESSION['ID'] = $row['idUsuario'];
            $_SESSION['TIPO'] = $row['tipoUsuario'];
            header('location:../indexjava.php');
        } else {
            $_SESSION['STATUS'] = 'ERROR';
            header('location:../indexjava.php');
        }
    } else {
        $_SESSION['STATUS'] = 'ERROR';
        header('location:../index.php');
    }

    ob_end_flush();
?>