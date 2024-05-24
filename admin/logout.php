<?php
    session_start();
    setcookie('AID',$_SESSION['AID'],60);
    unset($_SESSION['AID']);
    header('location: login.php');
    die();
?>