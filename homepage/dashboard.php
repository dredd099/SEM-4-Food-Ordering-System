<?php
    session_start();
    include("../dbconn.php");

    if (!isset($_SESSION['UID'])) 
    {
        header('location: SignIn.php');
        die(); // Stop further execution
    }

    if (isset($_SESSION['UID'])) 
    {
        if (isset($_POST['submit'])) 
        {
            // Check if all required POST variables are set
            if (isset($_POST['name'], $_POST['email'], $_POST['phone_number'], $_POST['address'])) 
            {
                // Get the new values from the form
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $address = $_POST['address'];
            
                // Fetch the user's current email and phone number
                $sql = "SELECT email, phone_number FROM user_info WHERE ID = '".$_SESSION['UID']."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
            
                $current_email = $row['email'];
                $current_phone_number = $row['phone_number'];
            
                // Check if the updated email or phone number is the same as the current one
                if (($email == $current_email || checkUniqueEmail($conn, $email)) &&
                    ($phone_number == $current_phone_number || checkUniquePhoneNumber($conn, $phone_number))) 
                    {
                    
                    // Update the user information in the database
                    $update_sql = "UPDATE user_info SET name='$name', email='$email', phone_number='$phone_number', address='$address' WHERE ID='".$_SESSION['UID']."'";
                    $conn->query($update_sql);
                    echo '<script>
                            alert("Profile updated successfully");
                        </script>';
                } 
                else 
                {
                    if ($email != $current_email && !checkUniqueEmail($conn, $email)) 
                    {
                        echo '<script>
                                alert("Email already in use!!");
                            </script>';
                    }
                    if ($phone_number != $current_phone_number && !checkUniquePhoneNumber($conn, $phone_number)) 
                    {
                        echo '<script>
                                alert("Phone Number already in use!!");
                            </script>';
                    }
                }
            } else {
                // Handle case where required POST variables are not set
                echo '<script>
                        console.log("One or more required fields are missing.");
                    </script>';
            }
            
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
            header('location: dashboard.php');
        }
    }
    if(isset($_GET['remove1']))
        {
            $remove_id=$_GET['remove1'];
            $sql1 = "DELETE FROM `placed_order` WHERE user_id='$remove_id'";
            $sql2 = "DELETE FROM `transactions` WHERE customer_id='$remove_id'";
            $sql3 = "DELETE FROM `review` WHERE user_id='$remove_id'";
            $sql4 = "DELETE FROM `user_info` WHERE ID='$remove_id'";

            if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4))
            {
                echo "<script>
                            alert('Deleted successfully.');
                        </script>";
                header('location: ../SignOut.php');
                session_destroy();
                exit();
            }
            else {
                echo "<script>alert('Failed to delete account. Please try again.');</script>";
            }
        }

    function checkUniqueEmail($conn, $email)
    {
        $sql = "SELECT COUNT(*) AS count FROM user_info WHERE email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'] == 0;
    }

    function checkUniquePhoneNumber($conn, $phone_number)
    {
        $sql = "SELECT COUNT(*) AS count FROM user_info WHERE phone_number = '$phone_number'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'] == 0;
    }

?>
<?php
    $query = "select * from user_info";
    $run = mysqli_query($conn,$query); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>User Dashboard</title>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style/dashboard.css">
</head>
<body>
<div class="grid-container">

    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <img src="../images/ddw.png" alt="logo">
        </div>
        <!-- <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div> -->
        <div class="header-right">
            <p><span class="material-icons-outlined">account_circle</span></p>
            <a><?php
                // Check if user is logged in
                if(isset($_SESSION['UID'])) {
                    $ID = $_SESSION['UID'];
                    $res=mysqli_query($conn,"SELECT name FROM user_info WHERE ID='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $name = $row['name'];
                    echo "Hello, ".$name;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?></a>

        </div>
    </header>
    <main class="main-container">
        <div class="back">
            <a href="Restaurant.php"><-Back to Homepage</a>
        </div>
        <div class="main-title">
            <h2>WELCOME TO USER DASHBOARD</h2>
        </div>

        <div class="main-cards">

            <div class="card">
                <div class="card-inner">
                    <h3>IN CART</h3>
                    <span class="material-icons-outlined">inventory_2</span>
                </div>
                <h1><?php
                    if(isset($_SESSION['UID'])) {
                        $ID = $_SESSION['UID'];
                        $sql = "SELECT sum(quantity) FROM transactions where customer_id=$ID";
                        $result = mysqli_query($conn, $sql);  
                        while($row = mysqli_fetch_array($result))
                        {
                            if($row['sum(quantity)']==null)
                            {
                                echo "0";
                            }
                            else
                            {
                                echo $row['sum(quantity)'];
                            }
                        }
                    } 
                    else {
                        echo '<p>User not logged in.</p>';
                    }
                ?></h1>
            </div>

            <div class="card">
                <div class="card-inner">
                    <h3>PENDING ORDERS</h3>
                    <span class="material-icons-outlined">category</span>
                </div>
                <h1><?php
                    if(isset($_SESSION['UID'])) {
                        $ID = $_SESSION['UID'];
                        $sql = "SELECT sum(order_quantity) FROM placed_order where user_id=$ID";
                        $result = mysqli_query($conn, $sql);  
                        while($row = mysqli_fetch_array($result))
                            {
                                if($row['sum(order_quantity)']==null)
                                {
                                    echo "0";
                                }
                                else
                                {
                                    echo $row['sum(order_quantity)'];
                                }
                            }
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                ?></h1>
            </div>

            <div class="card">
                <div class="card-inner">
                    <h3>COMPLETED ORDERS</h3>
                    <span class="material-icons-outlined">groups</span>
                </div>
                <h1><?php
                    if(isset($_SESSION['UID'])) {
                        $ID = $_SESSION['UID'];
                        $sql = "SELECT sum(order_quantity) FROM completed_orders where user_id=$ID ";
                        $result = mysqli_query($conn, $sql);  
                        while($row = mysqli_fetch_array($result))
                            {
                                if($row['sum(order_quantity)']==null)
                                {
                                    echo "0";
                                }
                                else
                                {
                                    echo $row['sum(order_quantity)'];
                                }
                            }
                    } else {
                        echo '<p>User not logged in.</p>';
                    }
                ?></h1>
            </div>

            <div class="card">
                <div class="card-inner">
                    <h3>ALERTS</h3>
                    <span class="material-icons-outlined">notification_important</span>
                </div>
                <h1>0</h1>
            </div>
        </div>

        <div class="editpro">
            <h2>EDIT PROFILE</h2>
        </div>
        <form action="" method="post" class="upform" onsubmit="return update()">
            <p>Name<br><br>
                <input type="text" name="name" id="name" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['UID'])) {
                    $ID = $_SESSION['UID'];
                    $res=mysqli_query($conn,"SELECT name FROM user_info WHERE ID='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $name = $row['name'];
                    echo $name;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>" required></p>
            <p>Email<br><br>
                <input type="email" name="email" id="email" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['UID'])) {
                    // Fetch and display user email
                    $ID = $_SESSION['UID'];
                    $res=mysqli_query($conn,"SELECT email FROM user_info WHERE ID='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $email = $row['email'];
                    echo $email;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>" required>
            </p>

            <p>Phone<br><br>
                <input type="number" name="phone_number" id="num" maxlength="10" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['UID'])) {
                    // Fetch and display user email
                    $conn=mysqli_connect('localhost','root','','diablosignproto1');
                    $ID = $_SESSION['UID'];
                    $res=mysqli_query($conn,"SELECT phone_number FROM user_info WHERE ID='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $phone_number = $row['phone_number'];
                    echo $phone_number;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>" required max="9999999999" min="0" maxlength="10"></p>
            <p>Address<br><br>
                <input type="text" name="address" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['UID'])) {
                    // Fetch and display user email
                    $conn=mysqli_connect('localhost','root','','diablosignproto1');
                    $ID = $_SESSION['UID'];
                    $res=mysqli_query($conn,"SELECT address FROM user_info WHERE ID='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $address = $row['address'];
                    echo $address;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>" required></p>

            <br><input type="submit" name="submit" value="Update" id="upd">
        </form>
        
        

        <?php
            include("changePWuser.php");    
        ?>

        <div class="tab">
            <h2>YOUR PLACED ORDERS</h2>
            <table border="1" cellpadding="20" class="tabe">
                <thead>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                    <tbody>
                    <?php
                        $select_product = mysqli_query($conn, "SELECT * FROM `placed_order` where user_id='$ID'") or die('Query failed.');
                        if(mysqli_num_rows($select_product) > 0)
                        {
                            while($fetch_product = mysqli_fetch_assoc($select_product))
                            {
                    ?>
                                <tr><td><div class="name"><?php echo $fetch_product['order_name']?></div></td>
                                <td><div class="price"><?php echo "Rs. ".$fetch_product['order_price']."/-"?></div></td>
                                <td><div class="quantity"><?php echo $fetch_product['order_quantity']?></div></td>
                                <td>Rs. <?php echo $sub_total = number_format($fetch_product['order_price']*$fetch_product['order_quantity']);?>/-</td>
                                <td><div class="status">
                                    <?php 
                                            echo 'Pending';
                                    ?></div></td>
                                    <td><input type="hidden" name="order_id" value="<?php echo $fetch_product['order_id']?>">
                                <div class="cancel">
                                <a href="dashboard.php?remove=<?php echo $fetch_product['order_id']?>" class="delete-btn" 
                                    onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</a></td></tr></div>
                    <?php
                            }
                        }
                        else
                        {
                            echo '<tr><td style="padding: 20px; text-transform: capitalize; text-align: center;" colspan="6">No Pending Items</td></tr>';
                        }
                    ?>
                    </tbody>
                </thead>
            </table>
            
            <h2>YOUR COMPLETED ORDERS</h2>
            <table border="1" cellpadding="20">
                <thead>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <tbody>
                    <?php
                        $select_product = mysqli_query($conn, "SELECT * FROM `completed_orders` where user_id='$ID'") or die('Query failed.');
                        if(mysqli_num_rows($select_product) > 0)
                        {
                            while($fetch_product = mysqli_fetch_assoc($select_product))
                            {
                    ?>
                                <tr><td><div class="name"><?php echo $fetch_product['order_name']?></div></td>
                                <td><div class="price"><?php echo "Rs. ".$fetch_product['order_price']."/-"?></div></td>
                                <td><div class="quantity"><?php echo $fetch_product['order_quantity']?></div></td>
                                <td>Rs. <?php echo $sub_total = number_format($fetch_product['order_price']*$fetch_product['order_quantity']);?>/-</td>
                                <td><div class="c-status">Delivered</div></td></tr>
                    <?php
                            }
                        }
                        else
                        {
                            echo '<tr><td style="padding: 20px; text-transform: capitalize; text-align: center;" colspan="6">No Orders Yet</td></tr>';
                        }
                    ?>
                    </tbody>
                </thead>
            </table>
            <div class="delete">
                <h2 style="color: red;">Delete Account</h2>
                <hr>
                <p>Once your delete your account, there is no going back. Please be certain before you proceed.</p>
                <form><a href="dashboard.php?remove1=<?php echo $_SESSION['UID']?>" class="delete-btn" 
                                onclick="return confirm('Are you sure you want to delete your account?');">Delete your account</a>
                            </form>
            </div>
        </div>
    </main>
    <!-- End Main -->

</div>

<script>
    document.getElementById('num').addEventListener('input', function (e) 
    {
        const value = e.target.value;
        if (!/^9[78]\d{8}$/.test(value)) 
        {
            e.target.setCustomValidity('Your number is not in proper format.');
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
    document.getElementById('name').addEventListener('input', function (e) 
    {
        const value = e.target.value;
        if (!/^[a-z ,.'-]+$/i.test(value)) 
        {
            e.target.setCustomValidity('Your name is not in proper format.');
        } 
        else 
        {
            e.target.setCustomValidity('');
        }
    });
</script>
</body>
</html>
