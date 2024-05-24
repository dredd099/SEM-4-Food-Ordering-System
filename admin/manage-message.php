<?php
include('partials/menu.php');
?>
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
        if( mysqli_query($conn, "DELETE FROM `review` WHERE msg_id='$remove_id'"))
        {
            echo "<script>
                        alert('Deleted successfully.');
                    </script>";
            header('location: manage-message.php');
        }
        else
        {
            die('Query failed');
        }
    }
?>

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
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f1f2f6;
            overflow-x: hidden;
        }
        .message
        {
            padding: 30px;
            margin-right: 10px;
        }
        .message .delete-btn
        {
            font-size: 14px;
            padding:10px;
            width: 110px;
            height: 40px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: red;
            cursor: pointer;
            transition: 0.3s ease-in;
            border-radius: 8px;
            border: 1px solid red;
        }
        .message .delete-btn:hover
        {
            margin: 12px 0;
            background-color: darkred;
            border: 1px solid darkred;
            width: 100px;
            height: 35px;
        }
        table
        {
            width: 100%;
        }
        .m-id
        {
            width: 50px;
        }
        .u-id
        {
            width: 70px;
        }
    </style>
</head>
<body>
    <div class="message">
            <h1>Messages from the users</h1>
            <br><br><br>
            <table cellpadding="20">
                <tr>
                    <th class="m-id">ID</th>
                    <th class="u-id">User ID</th>
                    <th class="m-name">Name</th>
                    <th class="mrd">Reg. Date</th>
                    <th class="m-email">Email</th>
                    <th class="m-num">Number</th>
                    <th class="m-type">Message Type</th>
                    <th class="mm">Message</th>
                    <th class="m-action">Action</th>
                </tr>
                <?php
                    $select_message = mysqli_query($conn, "SELECT * FROM `review` ORDER BY msg_reg_date DESC") or die('Query failed.');
                    if(mysqli_num_rows($select_message) > 0)
                    {
                        while($fetch_message = mysqli_fetch_assoc($select_message))
                        {
                ?>
                            <tr>
                                <td class="m-id"><?php echo $fetch_message['msg_id']?></td>
                                <td class="u-id"><?php echo $fetch_message['user_id']?></td>
                                <td class="m-name"><?php echo $fetch_message['Name']?></td>
                                <td class="mrd"><?php echo $fetch_message['msg_reg_date']?></td>
                                <td class="m-email"><?php echo $fetch_message['Email']?></td>
                                <td class="m-num"><?php echo $fetch_message['Number']?></td>
                                <td class="m-type"><?php echo $fetch_message['MessageType']?></td>
                                <td class="mm"><?php echo $fetch_message['Message']?></td>
                            
                                    <td><a href="manage-message.php?remove=<?php echo $fetch_message['msg_id']?>" class="delete-btn" 
                                    onclick="return confirm('Remove this message?');">Remove</a></td>
                            </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
</body>
</html>