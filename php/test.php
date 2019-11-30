<?php
    ob_start();
    
    session_start();
    echo $_SESSION['ID'];
    echo $_SESSION['TIPO'];

    ob_end_flush();
?>