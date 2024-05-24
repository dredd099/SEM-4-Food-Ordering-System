<?php
include("../dbconn.php");
session_start();
if (!isset($_COOKIE['AID'])) {
    header('location: login.php');
    die(); // Stop further execution
}
if(isset($_GET['remove']))
    {
        $remove_id=$_GET['remove'];
        $sql1 = "DELETE FROM `placed_order` WHERE user_id='$remove_id'";
        $sql2 = "DELETE FROM `transactions` WHERE customer_id='$remove_id'";
        $sql3 = "DELETE FROM `review` WHERE user_id='$remove_id'";
        $sql4 = "DELETE FROM `user_info` WHERE ID='$remove_id'";

        if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4))
        {
            echo "<script>
                        alert('Deleted successfully.');
                    </script>";
            header('location: manage-user.php');
        }
    }
?>
<?php include('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        body
        {
            background-color: #f1f2f6;
        }
        .tbl-full .delete-btn
        {
            padding: 8px;
            font-size: 12px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: red;
            cursor: pointer;
            transition: 0.3s ease-in;
            border-radius: 8px;
            border: 1px solid red;
        }
        .tbl-full .delete-btn:hover
        {
            background-color: darkred;
            border: 1px solid darkred;
        }
    </style>
</head>
<body>
    
    <!-- Main Content Section Stars -->
    <div class = "main-content">
        <div class="wrapper">
            <table class = "tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Registered Date & Time</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                
                <tr>
                    <?php
                    include("../dbconn.php");
                    $select_user = mysqli_query($conn, "SELECT * FROM `user_info` ORDER BY reg_date DESC") or die('Query failed.');
                    if(mysqli_num_rows($select_user) > 0)
                    {
                        while($fetch_user = mysqli_fetch_assoc($select_user))
                        {
                            ?>
                            <tr>
                                <td><?php echo $fetch_user['ID']?></td>
                                <td><?php echo $fetch_user['reg_date']?></td>
                                <td><?php echo $fetch_user['Name']?></td>
                                <td><?php echo $fetch_user['Email']?></td>
                                <td><?php echo $fetch_user['phone_number']?></td>
                                <td><?php echo $fetch_user['Address']?></td>
                                <td><form><a href="manage-user.php?remove=<?php echo $fetch_user['ID']?>" class="delete-btn" 
                                onclick="return confirm('Are you sure you want to remove this user?');">Remove</a>
                            </form></td>
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