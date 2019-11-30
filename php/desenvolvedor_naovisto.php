<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $id = $_POST['idThing'];

    $result = $conn->query("UPDATE usuario SET ativado = 0 WHERE idUsuario = ".$id);
    header('location:../gestao.php');

    ob_end_flush();
?>