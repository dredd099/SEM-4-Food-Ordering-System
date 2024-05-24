<?php
include("../dbconn.php");
session_start();
if (!isset($_COOKIE['AID'])) {
    header('location: login.php');
    die(); // Stop further execution
}

?>
<?php include('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="admin.css"> -->
    <style>
        body{
            background-color: #f1f2f6;
        }
        *{
            margin: 0 0;
            padding: 0 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .wrapper{
            padding: 1%;
            width: 99%;
            margin: 0 auto;
        }
        .tbl-full{
            width: 100%;
        }
        table tr th{
            border-bottom: 1px solid black;
            padding: 1%;
            text-align: left;
        }

        table tr td{
            padding: 1%;
        }
        .btn-primary{
            background-color: #1e90ff;
            padding: 1%;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s linear;
            border-radius: 4px;
        }

        .btn-primary:hover{
            background-color: #3742fa;
        }
    </style>
</head>
<body>
    
    <!-- Main Content Section Stars -->
    <div class = "main-content">
        <div class="wrapper">
            <h1> Manage Admin </h1>
            <br /> <br />
            
            <!-- Button to Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <a href="admin-dashboard.php" class="btn-primary">Personal Dashboard</a>
            
            <br /><br /><br />
            
            <table class = "tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Registered Date & Time</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
                
                <tr>
                    <?php
                    include("../dbconn.php");
                    $select_admin = mysqli_query($conn, "SELECT * FROM `admin_info`") or die('Query failed.');
                    if(mysqli_num_rows($select_admin) > 0)
                    {
                        while($fetch_admin = mysqli_fetch_assoc($select_admin))
                        {
                            ?>
                            <tr>
                                <td class="a-id"><?php echo $fetch_admin['admin_id']?></td>
                                <td class="a-date"><?php echo $fetch_admin['reg_date']?></td>
                                <td class="a-name"><?php echo $fetch_admin['name']?></td>
                                <td class="a-email"><?php echo $fetch_admin['email']?></td>
                                <td class="a-num"><?php echo $fetch_admin['phone_number']?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                
            </div>
        </div>
        <!-- Main Content Section Ends -->
        
    </body>
    </html>