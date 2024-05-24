<?php include('partials/menu.php'); ?>
<?php
include("../dbconn.php");
session_start();
if (!isset($_COOKIE['AID'])) {
    header('location: login.php');
    die(); // Stop further execution
}
?>
<?php
    include("../dbconn.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = filter_input(INPUT_POST,"admin_email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST,"admin_password", FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST,"admin_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $phone_number = filter_input(INPUT_POST,"admin_number", FILTER_SANITIZE_SPECIAL_CHARS);
    
        $sql = "SELECT * FROM user_info WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);
        
        $sql = "SELECT * FROM user_info WHERE phone_number='$phone_number'";
        $result = mysqli_query($conn, $sql);
        $count_phone_number = mysqli_num_rows($result);
    
        if($count_email == 0 && $count_phone_number == 0)
        {
            // $hash = password_hash($password, PASSWORD_DEFAULT;
            $sql = "INSERT INTO admin_info (email, password, name, phone_number) VALUES ('$email','$password','$name','$phone_number')";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                echo '<script>
                    alert("New admin added successfully");
                    </script>';
                header("Location: manage-admin.php");
            }
        }
        else
        {
            if($count_email>0)
            {
                echo '<script>
                    window.location.href="add-admin.php"
                    alert("Email already exists!");
                </script>';
            }
            if($count_phone_number>0)
            {
                echo '<script>
                    window.location.href="add-admin.php"
                    alert("Phone Number already exists!");
                </script>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="admin.css"> -->
    <style>
        *{
            margin: 0 0;
            padding: 0 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        body
        {
            background-color: #f1f2f6;
        }
        .wrapper{
            padding: 1%;
            width: 99%;
            margin: 0 auto;
        }

        .text-center{
            text-align: center;
        }
        .tbl-30{
            width: 30%;
        }
        table tr th{
            border-bottom: 1px solid black;
            padding: 1%;
            text-align: left;
        }
        table tr td{
            padding: 1%;
        }

        .clearfix{
            float: none;
            clear: both;
        }
        .btn-secondary{
            background-color: #48e078;
            padding: 1%;
            color: white;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-secondary:hover{
            background-color: #10de66;
        }
    </style>
</head>
<body>
    
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            
            <br>
            
            <form action="" method="POST">
                
                <table class="tbl-30">
                    
                    <tr>
                        <td>Full Name: </td>
                        <td> <input type="text" name="admin_name" placeholder="Enter your full name" required> </td>
                    </tr>
                    
                    <tr>
                        <td>Email: </td>
                        <td>
                            <input type="text" name="admin_email" id="admin_email" placeholder="Enter your email" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="admin_password" placeholder="Enter your password" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Phone Number: </td>
                        <td>
                            <input type="number" name="admin_number" id="admin_number" placeholder="Enter your number" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                    
                </table>
                
            </form>
            
        </div>
    </div>
    <script>
        document.getElementById('admin_number').addEventListener('input', function (e) 
        {
            const value = e.target.value;
            if (!/^9[78]\d{8}$/.test(value)) 
            {
                e.target.setCustomValidity('Phone number not in proper format.');
            }
            else 
            {
                e.target.setCustomValidity('');
            }
        });
        
        document.getElementById('admin_email').addEventListener('input', function (e) 
        {
            const value = e.target.value;
            if (!/^([a-zA-Z0-9._-]+)@([a-zA-Z0-9.-]+)\.([a-z]{2,20})(\.[a-z]{2,20})?$/.test(value)) 
            {
                e.target.setCustomValidity('Your email is not in proper format.');
            } 
            else 
            {
                e.target.setCustomValidity('');
            }
        });
        </script>
</body>
</html>