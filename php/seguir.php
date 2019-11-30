<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $result = $conn->query("SELECT idRelacao FROM seguidor WHERE idSeguidor = ".$_SESSION['ID']." AND idSeguido = ".$_GET['u']);

    if ($result->num_rows > 0) {
        header('location:../perfil.php?u='.$_GET[u]);
    } else {
        $result2 = $conn->query("INSERT INTO seguidor(idSeguidor, idSeguido) VALUES(".$_SESSION['ID'].", ".$_GET['u'].")");
        header('location:../perfil.php?u='.$_GET[u]);
    }

    ob_end_flush();
?>