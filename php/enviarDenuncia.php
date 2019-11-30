<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $idDenunciado = $_POST['idDenunciado'];
    $topico = $_POST['topico'];
    $mensagem = $_POST['txtMensagem'];

    if($topico == "" || $mensagem == "") {
        $_SESSION['STATUS'] = "ERROR";
        header('location:../denunciar.php?u='.$idDenunciado);
    } else {
        $result = $conn->query("INSERT INTO denuncias(idDenunciante, idDenunciado, topico, mensagem) VALUES(".$_SESSION['ID'].", ".$idDenunciado.", '".$topico."', '".$mensagem."')");
        $_SESSION['STATUS'] = "SUCCESS";
        header('location:../denunciar.php?u='.$idDenunciado);
    }

    ob_end_flush();
?>