<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $result = $conn->query("SELECT idRelacao FROM seguidor WHERE idSeguidor = ".$_SESSION['ID']." AND idSeguido = ".$_GET['u']);

    if (!$result->num_rows > 0) {
        header('location:../perfiljava.php?u='.$_GET[u]);
    } else {
        $result2 = $conn->query("DELETE FROM seguidor WHERE idSeguidor = ".$_SESSION['ID']." AND idSeguido = ".$_GET['u']);
        header('location:../perfiljava.php?u='.$_GET[u]);
    }

    ob_end_flush();
?>