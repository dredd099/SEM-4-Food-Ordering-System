<?php
    include("../dbconn.php");
    session_start();
    if (!isset($_COOKIE['AID'])) {
        header('location: login.php');
        die(); // Stop further execution
    }
    ?>
    <?php include('partials/menu.php'); 
        header("refresh: 10;");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="admin.css">
        <style>
            body{
                background-color: #f1f2f6;
                overflow-x: hidden;
            }
        </style>
    </head>
    <body>
        
        <!-- Main Content Section Stars -->
        <div class = "main-content">
            <div class="wrapper">
                <h2>Hello, <?php 
                    if(isset($_SESSION['AID'])) {
                        $ID = $_SESSION['AID'];
                        $res=mysqli_query($conn,"SELECT name FROM admin_info WHERE admin_id='$ID'");
                        $row=mysqli_fetch_assoc($res);
                        $name = $row['name'];
                        echo $name."<br><br>";
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                    ?></h2>
                <h1>WELCOME TO ADMIN DASHBOARD </h1>
                
                <div class="col-1 text-center">
                    <h1><?php
                            $sql = "SELECT * FROM user_info";
                            $result = mysqli_query($conn, $sql);  
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                            $count = mysqli_num_rows($result);
                            echo $count;
                            ?></h1>
                    Customers
                </div>
                
                <div class="col-2 text-center">
                    <h1><?php
                            $sql = "SELECT * FROM products";
                            $result = mysqli_query($conn, $sql);  
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                            $count = mysqli_num_rows($result);
                            echo $count;
                            ?></h1>
                    Items
                </div>
                
                <div class="col-3 text-center">
                    <h1><?php
                            $sql = "SELECT * FROM completed_orders";
                            $result = mysqli_query($conn, $sql);  
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                            $count = mysqli_num_rows($result);
                            echo $count;
                            ?></h1>
                    Total Orders Completed
                </div>
                
                <div class="col-4 text-center">
                    <h1><?php
                            $sql = "SELECT sum(order_price*order_quantity) FROM completed_orders";
                            $result = mysqli_query($conn, $sql);  
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "Rs.".number_format($row['sum(order_price*order_quantity)']);
                            }
                            ?></h1>
                    Revenue Generated
                </div>
                
                <div class="clearfix"></div>    
                <div class="url">URL: <a href="../SignIn.php" target="_blank">diabloskitchen.com</a></div>
                <!-- <div class="dood">
                    <img src="../images/chefdood.webp" alt="doodle">
                </div> -->
            </div>
        </div>
        <!-- Main Content Section Ends -->
    </body>
</html>