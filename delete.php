<?php
    include("dbconn.php");

    if(isset($_SESSION['UID']))
    {
        $ID=$_SESSION['UID'];
        mysqli_query($conn, "DELETE FROM `user_info` WHERE ID='$ID'") or die('');
        header('Location: SignUp.php');
    }
?>
