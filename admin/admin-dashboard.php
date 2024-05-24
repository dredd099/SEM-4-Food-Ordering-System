<?php
include("../dbconn.php");
session_start();
if (!isset($_COOKIE['AID'])) {
    header('location: login.php');
    die(); // Stop further execution
}
if (isset($_SESSION['AID'])) {
    if (isset($_POST['submit'])) {
        // Check if all required POST variables are set
        if (isset($_POST['name'], $_POST['email'], $_POST['phone_number'])) {
            // Get the new values from the form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];

            // Fetch the user's current email and phone number, username
            $stmt = $conn->prepare("SELECT email, phone_number, name FROM admin_info WHERE admin_id = ?");
            $stmt->bind_param("s", $_SESSION['AID']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
          
            $current_email = $row['email'];
            $current_phone_number = $row['phone_number'];
            $current_name = $row['name'];



            // Check if the updated email or phone number is the same as the current one
            if (($email == $current_email || checkUniqueEmail($conn, $email)) &&
             ($phone_number == $current_phone_number || checkUniquePhoneNumber($conn, $phone_number))) {
                // Update the user information in the database
                $update_user = $conn->prepare("UPDATE `admin_info` SET name=?, email=?, phone_number=? WHERE admin_id=?");
                $update_user->bind_param("ssss", $name, $email, $phone_number, $_SESSION['AID']);
                $update_user->execute();
                echo '<script>
                        alert("Profile updated successfully");
                      </script>';
            } else {
                if ($email != $current_email && !checkUniqueEmail($conn, $email)) {
                    echo '<script>
                            alert("Email already in use!!");
                          </script>';
                }
                if ($phone_number != $current_phone_number && !checkUniquePhoneNumber($conn, $phone_number)) {
                    echo '<script>
                            alert("Phone Number already in use!!");
                          </script>';
                }
            }
        } else {
            // Handle case where required POST variables are not set
            $message[] = "One or more required fields are missing.";
        }
    }
}

function checkUniqueEmail($conn, $email)
{
    $count = 0; // Initialize count
    $stmt = $conn->prepare("SELECT COUNT(*) FROM admin_info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count == 0;
}

function checkUniquePhoneNumber($conn, $phone_number)
{
    $count = 0; // Initialize count
    $stmt = $conn->prepare("SELECT COUNT(*) FROM admin_info WHERE phone_number = ?");
    $stmt->bind_param("s", $phone_number);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count == 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Dashboard</title>
    <style>
        body
        {
            background-color: #f1f2f6;
        }
        .main-container {
            grid-area: main;
            overflow-y: auto;
            padding: 20px 20px;
            color: black;
            font-family: Trebuchet MS;
        }
        .heading
        {
            display: flex;
            justify-content: space-between;
        }
        .main-title {
            display: flex;
            justify-content: space-between;
        }

        .editpro
        {
            display: flex;
        }
        .upform
        {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        form input
        {
            width: 80%;
            height: 50px;
            outline: none;
            padding: 0 45px;
            font-size: 18px;
            background-color: transparent;
            caret-color: #5372F0;
            border-radius: 5px;
            border: 0.5px solid #bfbfbf;
            border-bottom-width: 2px;
            transition: all 0.2s ease;
            color: black;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        input[type="number"]::-webkit-inner-spin-button {
            display: none;
        }
        form #upd
        {
            margin-top: 10px ;
            padding-left: 30px;
            width: 110px;
            height: 40px;
            text-align: center;
            background-color: #ab98eb;
            cursor: pointer;
            transition: 0.3s ease-in;
        }
        form #upd:hover
        {
            background-color: white;
            color: #ab98eb;
        }
        .subdel
        {
            display: inline-block;
            padding-left: 20px;
        }
        .subdel p
        {
            font-size: 20px;
        }
        .subdel p1
        {
            font-size: 20px;
            padding-bottom: 10px;
        }
        .subdel .del {
            display: grid;
            place-content: center;
            color: white;
            margin: 12px 0;
            background-color: red;
            width: 100px;
            height: 40px;
            border-radius: 8px;
        }

        .subdel .del {
            margin: 0;
            font-size: 16px;
            transition: 0.2s ease-in;
            text-decoration: none;
        }
        .subdel .del:hover
        {
            background-color: rgb(152, 4, 4);
        }
        .main-container a
        {
            font-size: 18px;
            text-decoration: none;
            color: black;
            transition: 0.2s ease-in;
        }
        .main-container a:hover
        {
            color: #e8491d;
        }
    </style>
</head>
<body>
<main class="main-container">
    <a href="manage-admin.php"><-Back to Admin</a>
    <div class="heading">
        <h1><?php 
            if(isset($_SESSION['AID'])) {
                $ID = $_SESSION['AID'];
                $res=mysqli_query($conn,"SELECT name FROM admin_info WHERE admin_id='$ID'");
                $row=mysqli_fetch_assoc($res);
                $name = $row['name'];
                echo "Welcome, ".$name;
            } else {
                echo '<p>User not logged in.</p>';
            }
        ?></h1>
        <p>Admin ID: <?php echo $_SESSION['AID'];?></p>
        </div>
    <div class="editpro">
            <h2>EDIT PROFILE</h2>
        </div>
        <form action="" method="post" class="upform" onsubmit="return update()">
            <p>Name<br><br>
                <input type="text" name="name" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['AID'])) {
                    $ID = $_SESSION['AID'];
                    $res=mysqli_query($conn,"SELECT name FROM admin_info WHERE admin_id='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $name = $row['name'];
                    echo $name;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>">
            </p>
            <p>Email<br><br>
                <input type="email" name="email" id="email" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['AID'])) {
                    $ID = $_SESSION['AID'];
                    $res=mysqli_query($conn,"SELECT email FROM admin_info WHERE admin_id='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $email = $row['email'];
                    echo $email;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>" required>
            </p>

            <p>Phone<br><br>
                <input type="number" name="phone_number" id="phone" maxlength="10" value="<?php
                // Check if user is logged in
                if(isset($_SESSION['AID'])) {
                    $ID = $_SESSION['AID'];
                    $res=mysqli_query($conn,"SELECT phone_number FROM admin_info WHERE admin_id='$ID'");
                    $row=mysqli_fetch_assoc($res);
                    $phone_number = $row['phone_number'];
                    echo $phone_number;
                } else {
                    echo '<p>User not logged in.</p>';
                }
                ?>" required max="9999999999" min="0" maxlength="10"></p>

            <br><input type="submit" name="submit" value="Update" id="upd">
        </form>
</main>
        <?php
            include("changePWadmin.php");
        ?>
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