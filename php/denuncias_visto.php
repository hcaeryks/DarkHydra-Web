<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $id = $_POST['idThing'];

    $result = $conn->query("UPDATE denuncias SET visualizado = 1 WHERE idDenuncia = ".$id);
    header('location:../gestao.php');

    ob_end_flush();
?>