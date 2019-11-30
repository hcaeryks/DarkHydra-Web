<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $nome = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    $foto = $_POST['urlFoto'];
    $dest = $_POST['urlDest'];

    if($nome == "" || $desc == "" || $foto == "" || $dest == "") {
        $_SESSION['STATUS'] = 'ERRORFILL';
        header('location:../personalizar.php');
    } else {
        $result = $conn->query("UPDATE perfil SET nomePerfil = '".$nome."', descricaoPerfil = '".$desc."', imagemPerfil = '".$foto."', destaquePerfil='".$dest."' WHERE idPerfil = ".$_SESSION['ID']);
        header('location:../perfil.php?u='.$_SESSION['ID']);
    }

    ob_end_flush();
?>