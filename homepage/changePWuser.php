<?php
    include("../dbconn.php");
    if(isset($_SESSION['UID'])) 
    {
        $ID = $_SESSION['UID'];
        $res=mysqli_query($conn,"SELECT password FROM user_info WHERE ID='$ID'");
        $row=mysqli_fetch_assoc($res);
        $password = $row['password'];
        if(isset($_POST['submit'])) 
        {
            if(isset($_POST['cur_pass'], $_POST['new_pass'], $_POST['con_pass'])) 
            {
                $cur_pass = $_POST['cur_pass'];
                $new_pass = $_POST['new_pass'];
                $con_pass = $_POST['con_pass'];

                if($cur_pass == $password) 
                {
                    if($new_pass == $con_pass) 
                    {
                        $update_user = $conn->prepare("UPDATE `user_info` SET password=? WHERE ID=?");
                        $update_user->bind_param("si", $new_pass, $ID);
                        $update_user->execute();
                        echo '<script>
                                alert("Password changed successfully");
                            </script>';
                    } 
                    else 
                    {
                        echo'<script>
                            alert("Passwords do not match");
                        </script>';
                    }
                } 
                else
                {
                    echo'<script>
                            alert("Current password incorrect");
                        </script>';
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
        <style>
            .cpass
            {
                display: grid;
            }
            .passform input
            {
                width: 50%;
            }
            form #upd
            {
                margin-top: 10px ;
                padding-left: 30px;
                width: 170px;
                height: 40px;
                text-align: center;
                background-color: #ab98eb;
                cursor: pointer;
                transition: 0.3s ease-in;
            }
            form #upd:hover
            {
                background-color: white;
                color: #ab98eb;
            }
        </style> 
    </head>
    <body>
        <div class="cpass">
                <h2>CHANGE PASSWORD</h2><br>

            <form action="" method="post" class="passform">
            <p>Current Password<br><br>
                <input type="password" name="cur_pass" value="" id="show">
            </p>
            <p>New Password<br><br>
                <input type="password" name="new_pass" value="" id="show">
            </p>
            <p>Confirm Password<br><br>
                <input type="password" name="con_pass" value="" id="show">
            </p>
            <input type="submit" name="submit" value="Save Changes" id="upd">
            </form>
        </div>
    </body>
</html>