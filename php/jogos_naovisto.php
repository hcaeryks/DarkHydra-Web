<?php
    ob_start();
    
    session_start();

    include 'config.php';

    $id = $_POST['idThing'];

    $result = $conn->query("UPDATE pedidos SET ativado = 0 WHERE idPedido = ".$id);
    header('location:../administracao.php');

    ob_end_flush();
?>