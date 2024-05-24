<?php
session_start();
include("../dbconn.php");
if (!isset($_COOKIE['UID'])) {
    header('location: SignIn.php');
    die(); // Stop further execution
}
if(isset($_POST['update_cart']))
    {
        $update_quantity=$_POST['cart'];
        $update_id=$_POST['transaction_id'];
        mysqli_query($conn, "UPDATE transactions SET quantity='$update_quantity' WHERE transaction_id='$update_id'") or die('Query failed.');
        $message[]='Cart updated successfully.';
    }
    
    if(isset($_GET['remove']))
    {
        $remove_id=$_GET['remove'];
        mysqli_query($conn, "DELETE FROM `transactions` WHERE transaction_id='$remove_id'") or die('');
        header('Location: Menu.php');
    }
    
    if(isset($_GET['delete_all']))
    {
        $customer_id=$_SESSION['UID'];
        mysqli_query($conn, "DELETE FROM `transactions` WHERE customer_id='$customer_id'") or die('');
        header('Location: Menu.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="style/Menu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.btn').click(function(e) {
            e.preventDefault();

            // Get item details
            var form = $(this).closest('form');
            var itemName = form.find('.order_name').val();
            var itemPrice = form.find('.amount').val();
            var itemQuantity = form.find('.quantity').val();
            var itemImage = form.find('.image').val();

            // Send item details to the server using AJAX
            $.ajax({
                type: 'POST',
                url: 'add_to_cart.php', // URL of the PHP script
                data: {
                    order_name: itemName,
                    amount: itemPrice,
                    quantity: itemQuantity,
                    image: itemImage,
                    add_to_cart: true // Flag to identify the request
                },
                success: function(response) {
                    // Update the cart table dynamically
                    $('#cart-body').html(response);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
    </script>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="dine">
        <h1>Creativity is always on our menu.</h1>
    </div>
    <div class="products">
        <div class="box-container">
            <?php
                include("../dbconn.php");
                $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed.');
                if(mysqli_num_rows($select_product) > 0)
                {
                    while($fetch_product = mysqli_fetch_assoc($select_product))
                    {
            ?>
                        <form method="post" class="box">
                            <img src="../mim/<?php echo $fetch_product['Image'];?>" alt="food_img" class="image">
                            <div class="name"><?php echo $fetch_product['Name']?></div>
                            <div class="price"><?php echo "Rs. ".$fetch_product['Price']."/-"?></div>
                            <div class="description"><?php echo $fetch_product['Description']?></div>
                            <input type="number" min="1" name="quantity" class="quantity" value="1">
                            <input type="hidden" class="image" name="image" value="<?php echo $fetch_product['Image'];?>">
                            <input type="hidden" class="order_name"  name="order_name" value="<?php echo $fetch_product['Name'];?>">
                            <input type="hidden" class="amount" name="amount" value="<?php echo $fetch_product['Price'];?>">
                            <input type="submit" value="Add to Cart" name="add-to-cart" class="btn">
                        </form>
            <?php
                    }
                }
            ?>
        </div>
        <div class="cart">
            <h2 class="heading">
                <p>Your Cart</p>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <?php
                            $grand_total = 0;
                            $customer_id = $_SESSION['UID'];
                            $cart_query = mysqli_query($conn, "SELECT * FROM `transactions` WHERE customer_id='$customer_id'") or die('Query failed.');

                            if(mysqli_num_rows($cart_query) > 0)
                            {
                                while($fetch_cart = mysqli_fetch_assoc($cart_query))
                                {
                                    $sub_total = $fetch_cart['amount'] * $fetch_cart['quantity'];
                                    $sub_total1 = number_format($sub_total); // Format subtotal
                        ?>
                                    <tr>
                                        <td><?php echo $fetch_cart['order_name']?></td>
                                        <td><?php echo "Rs. ".$fetch_cart['amount']."/-"?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="transaction_id" value="<?php echo $fetch_cart['transaction_id']?>">
                                                <input type="number" min="1" name="cart" class="up_cart" value="<?php echo $fetch_cart['quantity'];?>">
                                                <input type="submit" name="update_cart" value="Update" class="option-btn">
                                            </form>
                                        </td>
                                        <td>Rs. <?php echo $sub_total1; ?>/-</td>
                                        <td><a href="Menu.php?remove=<?php echo $fetch_cart['transaction_id']?>" class="delete-btn" 
                                        onclick="return confirm('Remove item from cart?');">Remove</a></td>
                                    </tr>
                        <?php
                                    $grand_total += $sub_total;
                                }
                            }
                            else
                            {
                                echo '<tr><td style="padding: 20px; text-transform: capitalize;" colspan="6">No Item Added</td></tr>';
                            }
                        ?>
                        <tr class="table-bottom">
                            <td colspan="3"> Grand Total: </td>
                            <td><?php echo "Rs. ".number_format($grand_total)."/-"; ?></td>
                            <td><a href="Menu.php?delete_all" onclick="return confirm('Delete all items?')" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Clear cart</a></td>
                        </tr>
                        <tr><td><a href="checkout.php" class="pc-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a></td></tr>
                    </tbody>
                </table>
            </h2>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
