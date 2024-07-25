<?php
session_start();
include("../dbconn.php");

if (!isset($_SESSION['UID'])) {
    header('location: SignIn.php');
    die();
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

        var form = $(this).closest('form');
        var itemName = form.find('.order_name').val();
        var itemPrice = form.find('.amount').val();
        var itemQuantity = form.find('.quantity').val();
        var itemImage = form.find('.image').val();

        $.ajax({
            type: 'POST',
            url: 'cart_actions.php',
            data: {
                action: 'add',
                order_name: itemName,
                amount: itemPrice,
                quantity: itemQuantity,
                image: itemImage
            },
            success: function(response) {
                $('#cart-body').html(response);
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

    $(document).on('submit', '.update-form', function(e) {
        e.preventDefault();

        var form = $(this);
        var transactionId = form.find('input[name="transaction_id"]').val();
        var quantity = form.find('input[name="cart"]').val();

        $.ajax({
            type: 'POST',
            url: 'cart_actions.php',
            data: {
                action: 'update',
                transaction_id: transactionId,
                quantity: quantity
            },
            success: function(response) {
                $('#cart-body').html(response);
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        var transactionId = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: 'cart_actions.php',
            data: {
                action: 'remove',
                transaction_id: transactionId
            },
            success: function(response) {
                $('#cart-body').html(response);
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-all-btn', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'cart_actions.php',
            data: {
                action: 'delete_all'
            },
            success: function(response) {
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
    <div class="products">
    <?php include("header.php"); ?>
    <div class="dine">
        <h1>Creativity is always on our menu.</h1>
    </div>
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
                            <img src="../mim/<?php echo $fetch_product['Image'];?>" alt="<?php echo $fetch_product['Name'];?>" class="image">
                            <div class="name"><?php echo $fetch_product['Name'];?></div>
                            <div class="price"><?php echo "Rs. ".$fetch_product['Price']."/-";?></div>
                            <div class="description"><?php echo $fetch_product['Description'];?></div>
                            <input type="number" min="1" name="quantity" class="quantity" value="1">
                            <input type="hidden" class="image" name="image" value="<?php echo $fetch_product['Image'];?>">
                            <input type="hidden" class="order_name"  name="order_name" value="<?php echo $fetch_product['Name'];?>">
                            <input type="hidden" class="amount" name="amount" value="<?php echo $fetch_product['Price'];?>">
                            <input type="submit" value="Add to Cart" name="add-to-cart" class="btn" onclick="showToast(successMsg)">
                        </form>
                        <?php
                    }
                }
                ?>
        </div>
        <div id="toastbox"></div>
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

                        if(mysqli_num_rows($cart_query) > 0) {
                            while($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                                $sub_total = $fetch_cart['amount'] * $fetch_cart['quantity'];
                                $sub_total1 = number_format($sub_total); // Format subtotal
                                ?>
                                <tr>
                                    <td><?php echo $fetch_cart['order_name']?></td>
                                    <td><?php echo "Rs. ".$fetch_cart['amount']."/-"?></td>
                                    <td>
                                        <form class="update-form" method="post">
                                            <input type="hidden" name="transaction_id" value="<?php echo $fetch_cart['transaction_id']?>">
                                            <input type="number" min="1" name="cart" class="up_cart" value="<?php echo $fetch_cart['quantity'];?>">
                                            <input type="submit" name="update_cart" value="Update" class="option-btn">
                                        </form>
                                    </td>
                                    <td>Rs. <?php echo $sub_total1; ?>/-</td>
                                    <td><a href="#" class="delete-btn" data-id="<?php echo $fetch_cart['transaction_id']; ?>">Remove</a></td>
                                </tr>
                    <?php
                                $grand_total += $sub_total;
                            }
                        } else {
                            echo '<tr><td style="padding: 20px; text-transform: capitalize;" colspan="6">No Item Added</td></tr>';
                        }
                    ?>
                    <tr class="table-bottom">
                        <td colspan="3"> Grand Total: </td>
                        <td><?php echo "Rs. ".number_format($grand_total)."/-"; ?></td>
                        <td><a href="Menu.php?delete_all" onclick="return confirm('Delete all items?')" class="delete-all-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Clear cart</a></td>
                    </tr>
                    <tr><td><a href="checkout.php" class="pc-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a></td></tr>
                </tbody>
            </table>
        </h2>
    </div>

    <?php include("footer.php"); ?>

    <script>
        let toastbox = document.getElementById('toastbox');
        let successMsg = '&#10004;Added to cart successfully';
        
        function showToast(msg) {
            let toast = document.createElement('div');
            toast.classList.add('toast');
            toast.innerHTML = msg;
            toastbox.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
</body>
</html>
