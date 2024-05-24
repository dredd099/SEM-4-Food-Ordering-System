<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for your order</title>
    <style>
        body
        {
            background-image: url('images/delivery.webp');
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: auto;
            overflow-x: hidden;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            color: white;
        }
        .container
        {
            background-color: transparent;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            text-align: center; /* Align center for all content */
        }
        .container p
        {
            font-size: 18px;
        }
        .container a
        {
            color: black;
            font-size: 18px;
            text-decoration: none; /* Remove underline */
        }
        .container h1
        {
            font-size: 46px;
        }
        .logo
        {
            display: flex;
            justify-content: center;
            align-content: center;
        }
        .logo img 
        {
            height: 125px;
            width: 300px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="logo">
    <img src="images/dd.png" alt="Diablo's Kitchen">
</div>
<div class="container">
    <h1>Thank you for your order!</h1>
    <p>Your order has been placed and is being processed. Please do leave a <a href="homepage/Convo.php">review</a>. <br>Our delivery partner will arrive at the delivery location
    in the next 30-45 minutes.</p>
    <a class="hp" href="homepage/Menu.php"> Continue ordering </a><br><br>
    <a class="hp" href="homepage/Restaurant.php"> Back to Homepage </a>
</div>
</body>
</html>
