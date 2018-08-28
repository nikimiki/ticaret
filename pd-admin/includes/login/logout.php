<?php
    ob_start();
    include_once('../connect.php');
    $_SESSION = array();
    header('Location:../../index.php');
    ob_end_flush();
?>