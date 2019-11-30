<?php
    ob_start();

    session_start();

    include 'config.php';

    $nome = $_POST['nomeJogo'];
    $desc = $_POST['descJogo'];
    $tags = $_POST['tagsJogo'];
    $zip = $_POST['zipJogo'];
    $img1 = $_POST['imagem1'];
    $img2 = $_POST['imagem2'];
    $img3 = $_POST['imagem3'];
    $img4 = $_POST['imagem4'];
    $path = $_POST['pathExec'];
    $prod = $_SESSION['ID'];

    $filteredDesc = preg_replace("/(?:\')/g", "\'", $desc); 

    if($_SESSION['TIPO'] == "desenvolvedor") {
        if($nome == "" || $desc == "" || $tags == "" || $zip == "" || 
        $img1 == "" || $img2 == "" || $img3 == "" || $img4 == "" || $path == "") {
            $_SESSION['STATUS'] = "ERROR";
            header('location:../enviarJogo.php');
        } else {
            $result = $conn->query("INSERT INTO pedidos(tituloJogo, descJogo, tagsJogo, zipJogo, imagem1, imagem2, imagem3, imagem4, pathExec, produtora) VALUES('$nome', '$filteredDesc', '$tags', '$zip', '$img1', '$img2', '$img3', '$img4', '$path', $prod)");
            if($result) {
                $_SESSION['STATUS'] = "SUCCESS";
                header('location:../enviarJogo.php');
            } else {
                $_SESSION['STATUS'] = "ERROR";
                header('location:../enviarJogo.php');
            }
        }
    } else {
        header('location:../index.php');
    }

    ob_end_flush();
?>