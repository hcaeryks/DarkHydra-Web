<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $topico = $_POST['topico'];
    $mensagem = $_POST['txtMensagem'];

    if($topico == "" || $mensagem == "") {
        $_SESSION['STATUS'] = "ERROR";
        header('location:../faleconosco.php');
    } else {
        $result = $conn->query("INSERT INTO faleconosco(idSender, topico, mensagem) VALUES(".$_SESSION['ID'].", '".$topico."', '".$mensagem."')");
        $_SESSION['STATUS'] = "SUCCESS";
        header('location:../faleconosco.php');
    }

    ob_end_flush();
?>