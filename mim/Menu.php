<?php
    session_start();
    if(!isset($_SESSION['UNAME'])) {
        header('location: SignIn.php');
        die(); // Stop further execution
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        include("header.php");
    ?>
    <!-- <div class="whole"> -->
        <div class="dine">
             <h1>Creativity is always on our menu.</h1>
        </div>

        <div class="container">
            <!-- <header> --><div class="head">
                <h1>Your Shopping Cart</h1>
                <div class="shopping">
                    <img src="shopping.svg">
                    <span class="quantity">0</span>
                </div>
            </div>
            <!-- </header> -->

            <div class="list">
            
            </div>
        </div>
        <div class="card">
            <h1>Cart</h1>
            <ul class="listCard">
            </ul>
            <div class="checkOut">
                <div class="total">Total:0</div>
                <div class="proceed">Proceed to Checkout</div>
                <div class="closeShopping">Close</div>
            </div>
        </div>
    <!-- </div> -->
    <?php
        include("footer.php");
    ?>
    <script src="app.js"></script>
</body>
</html>