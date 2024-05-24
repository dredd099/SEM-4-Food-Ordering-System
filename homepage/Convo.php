<?php
    session_start();
    if(!isset($_SESSION['UID'])) {
        header('location: SignIn.php');
        die();
    }
    include '../dbconn.php';

    if(isset($_POST['submit']))
    {
        $ID=$_SESSION['UID'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $number=$_POST['number'];
        $messagetype=$_POST['messagetype'];
        $message=$_POST['message'];

        $query = "INSERT INTO review(user_id,name, email, number, messagetype, message) VALUES('$ID','$name','$email','$number','$messagetype','$message')";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['status']= "Successful";
            header("Location: Contact.php");
        }
        else
        {
            $_SESSION['status']= "Unsuccessful";
            header("Location: Convo.php");
        }
    }
?>
<html>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>Start a conversation</title>
        <link rel="stylesheet" href="style/Convo.css" type="text/css">
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <?php
            if(isset($_SESSION['status']))
            {
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
        ?>
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <table class="details" cellpadding="10">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="display()">
                    <tr><td><label for="name" required>Name</label></td>
                    <td><input type="text" id="name" name="name" value="<?php
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
                            ?>" required></td></tr>
        
                    <tr><td><label for="email" required>Email</label></td>
                    <td><input type="email" id="email" name="email" value="<?php
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
                            ?>" required></td></tr>

                    <tr><td><label for="number" required>Phone Number</label></td>
                    <td><input type="number" id="num" maxlength="10" name="number" value="<?php
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
                            ?>" required></td></tr>
        
                    <tr><td><label>Message Type</label></td>
                    <td><input type="radio" name="messagetype" value="Inquiry">Inquiry
                        <input type="radio" name="messagetype" value="Review">Review</td></tr>
                    <tr><td></td><td><input type="radio" name="messagetype" value="Complaint" required>Complaint</td></tr>

                    <tr><td><label for="message" required>Message</label></td>
                    <td><textarea id="message" name="message" rows="4" required></textarea></td></tr>
        
                    <tr><td></td><td><button type="submit" name="submit" class="btn">Send Message</button></td>
                </form>
            </table>
         </div>
        <script>
            document.getElementById('num').addEventListener('input', function (e) 
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
            function display()
            {
                alert("Your message has been sent successfully.");
            }
        </script>
    </body>
        <?php
            include("footer.php");
        ?>
</html>
