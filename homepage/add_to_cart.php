<?php
include("../dbconn.php");
session_start();

if (!isset($_SESSION['UID'])) {
    header('location: ../SignIn.php');
    die();
}
    if(isset($_POST['add_to_cart']))
    {
    $order_name = $_POST['order_name'];
    $amount = $_POST['amount'];
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $quantity = $_POST['quantity'];
    $customer_id = $_SESSION['UID'];

    // Insert or update the cart in the database
    $result = mysqli_query($conn, "SELECT * FROM transactions WHERE customer_id='$customer_id' AND order_name='$order_name'");
    if (mysqli_num_rows($result) > 0) {
        mysqli_query($conn, "UPDATE transactions SET quantity = quantity + $quantity WHERE customer_id='$customer_id' AND order_name='$order_name'") or die('Query failed');
    } else {
        mysqli_query($conn, "INSERT INTO `transactions` (customer_id, order_name, amount, quantity, image) VALUES ('$customer_id', '$order_name', '$amount', '$quantity', '$image')") or die('Query failed');
    }

    // Retrieve updated cart items
    $cart_query = mysqli_query($conn, "SELECT * FROM `transactions` WHERE customer_id='$customer_id'") or die('Query failed');
    $grand_total = 0;
    $cartHTML = '';

    if (mysqli_num_rows($cart_query) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
            $sub_total = $fetch_cart['amount'] * $fetch_cart['quantity'];
            $sub_total1 = number_format($sub_total); // Format subtotal
            $cartHTML .= '
                <tr>
                    <td>' . $fetch_cart['order_name'] . '</td>
                    <td>Rs. ' . $fetch_cart['amount'] . '/-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="transaction_id" value="' . $fetch_cart['transaction_id'] . '">
                            <input type="number" min="1" name="cart" class="up_cart" value="' . $fetch_cart['quantity'] . '">
                            <input type="submit" name="update_cart" value="Update" class="option-btn">
                        </form>
                    </td>
                    <td>Rs. ' . $sub_total1 . '/-</td>
                    <td><a href="Menu.php?remove=' . $fetch_cart['transaction_id'] . '" class="delete-btn" onclick="return confirm(\'Remove item from cart?\');">Remove</a></td>
                </tr>';
            $grand_total += $sub_total;
        }
    } else {
        $cartHTML .= '<tr><td style="padding: 20px; text-transform: capitalize;" colspan="6">No Item Added</td></tr>';
    }

    $cartHTML .= '
        <tr class="table-bottom">
            <td colspan="3"> Grand Total: </td>
            <td>Rs. ' . $grand_total . '/-</td>
            <td><a href="Menu.php?delete_all" onclick="return confirm(\'Delete all items?\')" class="delete-btn ' . ($grand_total > 1 ? '' : 'disabled') . '">Clear cart</a></td>
        </tr>
        <tr><td><a href="checkout.php" class="pc-btn ' . ($grand_total > 1 ? '' : 'disabled') . '">Proceed to Checkout</a></td></tr>';

    echo $cartHTML;
    }
?>