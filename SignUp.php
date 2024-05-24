<?php
    include("dbconn.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);
        $phone_number = filter_input(INPUT_POST,"phone_number", FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_input(INPUT_POST,"address", FILTER_SANITIZE_SPECIAL_CHARS);
    
        $sql = "SELECT * FROM user_info WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);
        
        $sql = "SELECT * FROM user_info WHERE phone_number='$phone_number'";
        $result = mysqli_query($conn, $sql);
        $count_phone_number = mysqli_num_rows($result);
    
        if($count_email == 0 && $count_phone_number == 0)
        {
            // $hash = password_hash($password, PASSWORD_DEFAULT;
            $sql = "INSERT INTO user_info (email, password, name, phone_number, address) VALUES ('$email','$password','$name','$phone_number','$address')";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                header("Location: homepage/Restaurant.php");
                exit();
            }
        }
        else
        {
            if($count_email>0)
            {
                echo '<script>
                    window.location.href="SignUp.php"
                    alert("Email already exists!");
                </script>';
            }
            if($count_phone_number>0)
            {
                echo '<script>
                    window.location.href="SignUp.php"
                    alert("Phone Number already exists!");
                </script>';
            }
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <style>
            * 
            {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                overflow: hidden;
            }
            body {
                /* align-items: center;
                justify-content: center; */
                background-image: url('images/bg2.png');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                backdrop-filter: blur(2px);
            }
            .wrapper
            {
                display: inline;
                height: auto;
                display: flex;
                justify-content: center;
                padding-top: 10px;
            }
            .logo
            {
                display: flex;
                justify-content: center;
                align-content: center;
            }
            .logo img 
            {
                height: 125px; /* Adjust the height as needed */
                width: 300px; /* To maintain aspect ratio */
                margin-top: 50px;
            }
            .log    /*login whole*/
            {
                /* background-color: white; */
                width: 380px;
                padding: 5px 30px 35px 30px;
                border-radius: 5px;
                text-align: center;
                /* box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1); */
            }
            .log header 
            {
                font-size: 25px;
                font-weight: 600;
                color: black;
            }
            .log form 
            {
                margin: 35px 0;
            }
            form .email,.password,.number,.add,.use
            {
                width: 100%;
                margin-bottom: 15px;
            }
            form .email .input,
            .password .input,
            .number .input,
            .add .input,
            .use .input{
                background-color: white;
                height: 50px;
                width: 100%;
                position: relative;
                border-radius: 8px;
            }
            .number input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button
            {
            -webkit-appearance: none;
            margin: 0;
            }
            form input {
                width: 100%;
                height: 50px;
                outline: none;
                padding: 0 45px;
                font-size: 18px;
                background: none;
                caret-color: #5372F0;
                border-radius: 5px;
                border: 1px solid #bfbfbf;
                border-bottom-width: 2px;
                transition: all 0.2s ease;
            }
            /* .pass-txt a
            {
                padding-bottom: 6px;
                color: black;
                text-decoration: none;
            }
            .pass-txt
            {
                padding-bottom: 8px;
            }
            .pass-txt a:hover
            {
                color: #e8491d;
            } */
            #butt
            {
                background-color: #e8491d;
                color: white;
                border-color: #e8491d;
                cursor: pointer;
            }
            #butt:hover
            {
                color: #e8491d;
                background-color: white;
            }
            .sign-txt a:hover
            {
                color: #e8491d;
            }
        </style>
    </head>
    <body>
        <div class="logo">
            <img src="images/ddw.png" alt="Diablo's Kitchen">
        </div>
        <div class="wrapper">
            <div class="log">
                <header>Create your account</header>
                <form action="" method="post">
                    <!-- Form fields remain the same -->
                    <div class="email">
                        <div class="input">
                            <input type="text" placeholder="Email Address" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="password">
                        <div class="input">
                            <input type="password" placeholder="Password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="use">
                        <div class="input">
                            <input type="text" placeholder="Name" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="number">
                        <div class="input">
                            <input type="tel" placeholder="Phone Number" name="phone_number" id="num" minlength="10" maxlength="10" pattern="^9[78]\d{8}$" required>
                        </div>
                    </div>
                    <div class="add">
                        <div class="input">
                            <input type="text" placeholder="Address" name="address" id="address" required>
                        </div>
                    </div>
                    <input type="submit" id="butt" value="Sign Up">
                </form>

                <div class="sign-txt">Already a member? <a href="SignIn.php">Log In</a></div>
            </div>
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
        </script>


    </body>
</html>

