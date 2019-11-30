<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $login = $_POST['txtLogin'];
    $senha = $_POST['txtSenha'];

    if(!$login == "" || $senha == "") {
        $sql = "SELECT idUsuario, tipoUsuario, ativado FROM usuario WHERE nomeUsuario = '$login' AND senhaUsuario = '$senha'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if($row['ativado'] == 1) {
                $_SESSION['LOGGED'] = 'TRUE';
                $_SESSION['ID'] = $row['idUsuario'];
                $_SESSION['TIPO'] = $row['tipoUsuario'];
                header('location:../index.php');
            } else {
                $_SESSION['STATUS'] = 'ERRORACTIVATE';
                header('location:../index.php');
            }
        } else {
            $_SESSION['STATUS'] = 'ERROR';
            header('location:../index.php');
        }
    } else {
        $_SESSION['STATUS'] = 'ERROR';
        header('location:../index.php');
    }

    ob_end_flush();
?>