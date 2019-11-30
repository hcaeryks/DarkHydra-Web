<?php
    ob_start();
    
    session_start();

    include 'config.php';

    if($_SESSION['TIPO'] == "admin") {
        $result = $conn->query("UPDATE usuario SET tipoUsuario = 'comum' WHERE idUsuario = ".$_GET['u']);
        header('location:../perfiljava.php?u='.$_GET['u']);
    } else {
        header('location:../indexjava.php');
    }

    ob_end_flush();
?>