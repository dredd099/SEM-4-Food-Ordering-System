<?php 
include('partials/menu.php'); 
include("../dbconn.php");
?>
<link rel="stylesheet" href="admin.css">
<style>
        body
        {
            overflow-x: hidden;
            background-color: #f1f2f6;
        }
        .tbl-full .option-btn
        {
            margin: 10px;
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
            margin: 10px;
            font-size: 14px;
            width: 120px;
            height: 100px;
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
            color: red;
            margin: 10px;
            background-color: white;
        }
</style>
<div class="main-content">
    <div class="wrapper">
        <h1> Completed Orders </h1>

        <br /><br /><br />

        <table class="tbl-full" cellpadding="50">
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Customer Name</th>
                <th>Order Name</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Sub-Total</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Completed Date</th>
            </tr>
            <?php
            $select_order = mysqli_query($conn, "SELECT * FROM `completed_orders` ORDER BY completed_date DESC") or die('Query failed.');
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
                            <td class="p-id"><?php echo $fetch_order['order_id']?></td>
                            <td class="p-id"><?php echo $fetch_order['user_id']?></td>
                            <td class="p-id"><?php echo $fetch_order['user_name']?></td>
                            <td class="p-id"><?php echo $fetch_order['order_name']?></td>
                            <td class="p-id"><?php echo $fetch_order['order_price']?></td>
                            <td class="p-id"><?php echo $fetch_order['order_quantity']?></td>
                            <td class="p-id"><?php echo $sub_total1?></td>
                            <td class="p-id"><?php echo $fetch_order['email']?></td>
                            <td class="p-id"><?php echo $fetch_order['phone_number']?></td>
                            <td class="p-id"><?php echo $fetch_order['completed_date']?></td>
                        </form>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
