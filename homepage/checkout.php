<?php
include("../dbconn.php");
session_start();
if(!isset($_SESSION['UID'])) {
    header('location: SignIn.php');
    die();
}
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone_number=$_POST['phone_number'];
    $address=$_POST['address'];

    $ID=$_SESSION['UID'];
    $res=mysqli_query($conn,"SELECT order_name, quantity, amount, customer_id FROM `transactions` WHERE customer_id='$ID'") or die('Query failed');

    while($row = mysqli_fetch_array($res))
    {
        $order_name = $row['order_name'];
        $order_quantity = $row['quantity'];
        $order_price = $row['amount'];
        $user_id = $row['customer_id'];

        $result=mysqli_query($conn,"INSERT INTO `placed_order` (order_name, order_quantity, order_price, user_id, name, email, phone_number, address)
         VALUES ('$order_name', '$order_quantity', '$order_price', '$user_id', '$name', '$email','$phone_number','$address')");

         if($result)
         {
            mysqli_query($conn, "DELETE FROM `transactions` WHERE customer_id='$ID'") or die('Query failed');
            header('Location: ../order-placed.php');
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
    <link rel="stylesheet" href="style/checkout.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    
<div class="container">
    <div class="checkoutLayout">
        <div class="returnCart">
            <a href="Menu.php"><-Back to Menu</a>
            <h1>Your Cart</h1>
            <div class="list">
            <div class="cart">
                    <h2 class="heading">
                    <form action="" method="post" class="form" onsubmit="validate()">
                        <table>
                            <thead>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </thead>
                            <tbody>
                                <?php
                                    $total=0;
                                    $total_quantity=0;
                                    $customer_id=$_SESSION['UID'];
                                    $cart_query = mysqli_query($conn, "SELECT * FROM `transactions` WHERE customer_id='$customer_id'") or die('Query failed.');
                                    // echo $customer_id;
                                    
                                    if(mysqli_num_rows($cart_query) > 0)
                                    {
                                        while($fetch_cart = mysqli_fetch_assoc($cart_query))
                                        {
                                            $sub_total = 0;
                                            if (is_numeric($fetch_cart['amount']) && is_numeric($fetch_cart['quantity'])) {
                                                $sub_total = $fetch_cart['amount'] * $fetch_cart['quantity'];
                                                $sub_total1 = number_format($sub_total); // Format subtotal
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $fetch_cart['order_name']?></td>
                                    <td><?php echo "Rs. ".$fetch_cart['amount']."/-"?></td>
                                    <td><?php echo $fetch_cart['quantity']?></td>
                                    <td>Rs. <?php echo $sub_total1 = number_format($fetch_cart['amount']*$fetch_cart['quantity']);?>/-</td>
                                </tr>
                                <?php
                                    $total += $sub_total;
                                        };
                                    }
                                    else
                                    {
                                        echo '<tr><td style="padding: 20px; text-transform: capitalize;" colspan="6">No Item Added</td></tr>';
                                    }
                                ?>
                                <tr class="table-bottom">
                                    <td colspan="3" style="font-size: 24px;"> Total: </td>
                                    <td style="font-size: 24px;"><?php echo "Rs. ".number_format($total)."/-"; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </h2>
                </div>
            </div>
        </div>


        <div class="right">
            <h1>Checkout</h1>

            <form action="" method="post" class="checkout-form">
                <div class="group">
                    <p>Full Name</p>
                    <input type="text" name="name" id="name" value="<?php
                    if(isset($_SESSION['UID'])) {                      
                        $ID = $_SESSION['UID'];
                        $res=mysqli_query($conn,"SELECT name FROM user_info WHERE ID='$ID'");
                        $row=mysqli_fetch_assoc($res);
                        $name = $row['name'];
                        echo $name;
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                    ?>" required>
                </div>

                <div class="group">
                    <p>Email</p>
                    <input type="email" name="email" id="email" value="<?php
                    if(isset($_SESSION['UID'])) {                      
                        $ID = $_SESSION['UID'];
                        $res=mysqli_query($conn,"SELECT email FROM user_info WHERE ID='$ID'");
                        $row=mysqli_fetch_assoc($res);
                        $email = $row['email'];
                        echo $email;
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                    ?>" required>
                    <br>
                    
                </div>
    
                <div class="group">
                    <p>Phone Number</p>
                    <input type="number" name="phone_number" id="phone" maxlength="10" value="<?php
                    if(isset($_SESSION['UID'])) {                      
                        $ID = $_SESSION['UID'];
                        $res=mysqli_query($conn,"SELECT phone_number FROM user_info WHERE ID='$ID'");
                        $row=mysqli_fetch_assoc($res);
                        $phone_number = $row['phone_number'];
                        echo $phone_number;
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                    ?>" required>
                </div>
    
                <div class="group">
                    <p>Address</p>
                    <input type="text" name="address" id="address" value="<?php
                    if(isset($_SESSION['UID'])) {                      
                        $ID = $_SESSION['UID'];
                        $res=mysqli_query($conn,"SELECT address FROM user_info WHERE ID='$ID'");
                        $row=mysqli_fetch_assoc($res);
                        $address = $row['address'];
                        echo $address;
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                    ?>" required>
                </div>
    
            <div class="return">
                <div class="row">
                    <div>Total Price</div>
                    <div class="totalPrice"><?php echo "Rs. ".number_format($total)."/-"; ?></div>
                </div>
                <div class="row">
                    <div>Delivery Charge</div>
                    <div class="totalPrice"><?php echo "Rs. 100/-"; ?></div>
                </div>
                <div class="row">
                    <?php
                        $grand_total=$total + 100;
                    ?>
                    <div>Grand Total</div>
                    <div class="totalPrice"><?php echo "Rs. ".number_format($grand_total)."/-"; ?></div>
                </div>
            </div><br>
            <input type="submit" name="submit" id="buttonCheckout" value="CHECKOUT">
            </form>    
        </div>

    </div>
</div>
<script>
    document.getElementById('phone').addEventListener('input', function (e) 
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

    document.getElementById('email').addEventListener('input', function (e) 
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

