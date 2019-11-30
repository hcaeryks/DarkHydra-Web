<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $userID = $_SESSION['ID'];
    $gameID = $_GET['gameID'];

    if(!is_numeric($gameID)) {
        header('location:../jogojava.php?id='.$gameID);
    } else {
        $result = $conn->query("SELECT idRelacao FROM jogo_usuario WHERE idJogo = $gameID AND idUsuario = $userID");
        if($result->num_rows > 0) {
            if($conn->query("DELETE FROM jogo_usuario WHERE idJogo = $gameID AND idUsuario = $userID") === TRUE) {
                $_SESSION['STATUS'] = 'SUCCESS';
                header('location:../jogojava.php?id='.$gameID);
            } else {
                $_SESSION['STATUS'] = 'ERROR';
                header('location:../jogojava.php?id='.$gameID);
            }
        } else {
            $_SESSION['STATUS'] = 'ERROR';
            header('location:../jogojava.php?id='.$gameID);
        }
    }

    ob_end_flush();
?>