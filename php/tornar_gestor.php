<?php
    ob_start();
    
    session_start();

    include 'config.php';

    if($_SESSION['TIPO'] == "admin") {
        $result = $conn->query("UPDATE usuario SET tipoUsuario = 'gestor' WHERE idUsuario = ".$_GET['u']);
        header('location:../perfil.php?u='.$_GET['u']);
    } else {
        header('location:../index.php');
    }

    ob_end_flush();
?>