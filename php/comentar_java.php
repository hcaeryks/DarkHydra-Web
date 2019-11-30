<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $result = $conn->query("INSERT INTO comentario(idJogo, idPerfil, comentario, tipoComentario) VALUES(".$_POST['idJogo'].", ".$_SESSION['ID'].", '".$_POST['comentarioSend']."', '".$_POST['tipoReview']."')");
    if($result) {
        $_SESSION['STATUS'] = 'SUCCESS';
        header('location:../jogojava.php?id='.$_POST['idJogo']);
    } else {
        $_SESSION['STATUS'] = 'ERROR';
        header('location:../jogojava.php?id='.$_POST['idJogo']);
    }

    ob_end_flush();
?>