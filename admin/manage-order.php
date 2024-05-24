<?php 
include('partials/menu.php'); 
include("../dbconn.php");

if(isset($_POST['update']))
{
    $update_id=$_POST['order_id'];
    $update_status=$_POST['status'];
    if(mysqli_query($conn, "UPDATE placed_order SET status='$update_status' WHERE order_id='$update_id'"))
    {
        $res = mysqli_query($conn, "SELECT * FROM placed_order WHERE status='completed'") or die('Query failed');
        if($res)
        {
            while ($row = mysqli_fetch_array($res)) 
            {
                $order_id = $row['order_id'];
                $user_id = $row['user_id'];
                $user_name = $row['name'];
                $order_name = $row['order_name'];
                $order_price = $row['order_price'];
                $order_quantity = $row['order_quantity'];
                $email = $row['email'];
                $phone_number = $row['phone_number'];
            
                $result = mysqli_query($conn, "INSERT INTO completed_orders (order_id, user_id, user_name, order_name, order_price, order_quantity, email, phone_number)
                    VALUES ('$order_id', '$user_id', '$user_name', '$order_name', '$order_price', '$order_quantity', '$email', '$phone_number')");
            
                if ($result) 
                {
                    mysqli_query($conn, "DELETE FROM placed_order WHERE order_id='$order_id'") or die('Query failed');
                    header('Location: manage-order.php');
                } 
                else 
                {
                    die('Insertion failed');
                }
            }
            echo "<script>
            alert('Updated successfully.');
            </script>";
            header('location: manage-order.php');
        }
    }
    else
    {
        die('Query failed');
    }
}

if(isset($_GET['remove']))
{
    $remove_id=$_GET['remove'];
    if(mysqli_query($conn, "DELETE FROM `placed_order` WHERE order_id='$remove_id'"))
    {
        echo "<script>
                    alert('Deleted successfully.');
                </script>";
        header('location: manage-order.php');
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
        body
        {
            overflow-x: hidden;
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
        .tbl-full .option-btn
        {
            /* margin: 10px; */
            font-size: 14px;
            width: 70px;
            height: 30px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: rgb(42, 42, 205);
            cursor: pointer;
            transition: 0.3s ease-in;
            border-radius: 8px;
        }
        .tbl-full .option-btn:hover
        {
            color: blue;
            background-color: white;
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
        .tbl-full{
            width: 100%;
        }
        
        .tbl-full a{
            color: black;
        }
        table tr th{
            border-bottom: 1px solid black;
            padding: 1%;
            text-align: left;
        }
        
        table tr td{
            padding: 1%;
        }
</style>
</head>
<body>
<div class="main-content">
    <div class="wrapper">
        <h1> Pending Orders </h1>
        
        <br /><br /><br />
        
        <table class="tbl-full" cellpadding="50">
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order R.D.</th>
                <th>Customer Name</th>
                <th>Order Name</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Sub-Total</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            $select_order = mysqli_query($conn, "SELECT * FROM `placed_order` ORDER BY placed_date") or die('Query failed.');
            if(mysqli_num_rows($select_order) > 0)
            {
                while($fetch_order = mysqli_fetch_assoc($select_order))
                {
                    $sub_total = 0;
                    if (is_numeric($fetch_order['order_price']) && is_numeric($fetch_order['order_quantity'])) {
                        $sub_total = $fetch_order['order_price'] * $fetch_order['order_quantity'];
                        $sub_total1 = number_format($sub_total); // Format subtotal
                    }
                    ?>
                    <tr>
                        <form action="" method="post">
                            <td><?php echo $fetch_order['order_id']?></td>
                            <td><?php echo $fetch_order['user_id']?></td>
                            <td><?php echo $fetch_order['placed_date']?></td>
                            <td><?php echo $fetch_order['name']?></td>
                            <td><?php echo $fetch_order['order_name']?></td>
                            <td><?php echo $fetch_order['order_price']?></td>
                            <td><?php echo $fetch_order['order_quantity']?></td>
                            <td><?php echo $sub_total1?></td>
                            <td><?php echo $fetch_order['email']?></td>
                            <td><?php echo $fetch_order['phone_number']?></td>
                            <td><?php echo $fetch_order['address']?></td>
                            <td>
                                <select name="status">
                                    <option value="pending" <?php if ($fetch_order['status'] == 'pending') echo 'selected="selected"'; ?>>Pending</option>
                                    <option value="completed" <?php if ($fetch_order['status'] == 'completed') echo 'selected="selected"'; ?>>Completed</option>
                                </select>
                            </td>
                            <td class="action">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_order['order_id']?>">
                                <input type="submit" name="update" value="Update" class="option-btn">
                                <a href="manage-order.php?remove=<?php echo $fetch_order['order_id']?>" class="delete-btn" 
                                onclick="return confirm('Remove this order?');">Remove</a>
                            </td>
                        </form>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>