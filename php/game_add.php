<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $userID = $_SESSION['ID'];
    $gameID = $_GET['gameID'];

    if(!is_numeric($gameID)) {
        header('location:../jogo.php?id='.$gameID);
    } else {
        $result = $conn->query("SELECT idRelacao FROM jogo_usuario WHERE idJogo = $gameID AND idUsuario = $userID");
        if($result->num_rows > 0) {
            $_SESSION['STATUS'] = 'ERROR';
            header('location:../jogo.php?id='.$gameID);
        } else {
            if($conn->query("INSERT INTO jogo_usuario(idJogo, idUsuario) VALUES($gameID, $userID)") === TRUE) {
                $_SESSION['STATUS'] = 'SUCCESS';
                header('location:../jogo.php?id='.$gameID);
            } else {
                $_SESSION['STATUS'] = 'ERROR';
                header('location:../jogo.php?id='.$gameID);
            }
        }
    }

    ob_end_flush();
?>