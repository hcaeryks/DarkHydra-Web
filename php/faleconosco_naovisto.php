<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $id = $_POST['idThing'];

    $result = $conn->query("UPDATE faleconosco SET visualizado = 0 WHERE idMensagem = ".$id);
    header('location:../gestao.php');

    ob_end_flush();
?>