<?php
include("../dbconn.php");
session_start();

if (!isset($_SESSION['UID'])) {
    header('location: ../SignIn.php');
    die();
}

$customer_id = $_SESSION['UID'];

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $order_name = $_POST['order_name'];
        $amount = $_POST['amount'];
        $image = isset($_POST['image']) ? $_POST['image'] : '';
        $quantity = $_POST['quantity'];

        // Insert or update the cart in the database
        $result = mysqli_query($conn, "SELECT * FROM transactions WHERE customer_id='$customer_id' AND order_name='$order_name'");
        if (mysqli_num_rows($result) > 0) {
            mysqli_query($conn, "UPDATE transactions SET quantity = quantity + $quantity WHERE customer_id='$customer_id' AND order_name='$order_name'") or die('Query failed');
        } else {
            mysqli_query($conn, "INSERT INTO transactions (customer_id, order_name, amount, quantity, image) VALUES ('$customer_id', '$order_name', '$amount', '$quantity', '$image')") or die('Query failed');
        }
    } elseif($action == 'update') {
        if (isset($_POST['transaction_id']) && isset($_POST['quantity'])) {
            $update_quantity = $_POST['quantity'];
            $update_id = $_POST['transaction_id'];
            mysqli_query($conn, "UPDATE transactions SET quantity='$update_quantity' WHERE transaction_id='$update_id'") or die('Query failed.');
        }
    } elseif ($action == 'remove') {
        if (isset($_POST['transaction_id'])) {
            $remove_id = $_POST['transaction_id'];
            mysqli_query($conn, "DELETE FROM transactions WHERE transaction_id='$remove_id'") or die('Query failed.');
        }
    } elseif ($action == 'delete_all') {
        mysqli_query($conn, "DELETE FROM transactions WHERE customer_id='$customer_id'") or die('Query failed.');
    }   

    // Retrieve updated cart items
    $cart_query = mysqli_query($conn, "SELECT * FROM transactions WHERE customer_id='$customer_id'") or die('Query failed');
    $grand_total = 0;
    $cartHTML = '';

    if (mysqli_num_rows($cart_query) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
            $sub_total = $fetch_cart['amount'] * $fetch_cart['quantity'];
            $sub_total1 = number_format($sub_total);
            $cartHTML .= '
                <tr>
                    <td>' . $fetch_cart['order_name'] . '</td>
                    <td>Rs. ' . $fetch_cart['amount'] . '/-</td>
                    <td>
                        <form class="update-form" method="post">
                            <input type="hidden" name="transaction_id" value="' . $fetch_cart['transaction_id'] . '">
                            <input type="number" min="1" name="cart" class="up_cart" value="' . $fetch_cart['quantity'] . '">
                            <input type="submit" name="update_cart" value="Update" class="option-btn">
                        </form>
                    </td>
                    <td>Rs. ' . $sub_total1 . '/-</td>
                    <td><a href="javascript:void(0);" class="delete-btn" data-id="' . $fetch_cart['transaction_id'] . '">Remove</a></td>
                </tr>';
            $grand_total += $sub_total;
        }
    } else {
        $cartHTML .= '<tr><td style="padding: 20px; text-transform: capitalize;" colspan="6">No Item Added</td></tr>';
    }

    $cartHTML .= '
        <tr class="table-bottom">
            <td colspan="3"> Grand Total: </td>
            <td>Rs. ' . number_format($grand_total) . '/-</td>
            <td><a href="javascript:void(0);" class="delete-all-btn delete-btn ' . ($grand_total > 1 ? '' : 'disabled') . '">Clear cart</a></td>
        </tr>
        <tr><td><a href="checkout.php" class="pc-btn ' . ($grand_total > 1 ? '' : 'disabled') . '">Proceed to Checkout</a></td></tr>';

    echo $cartHTML;
}
?>
