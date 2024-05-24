<?php
    session_start();
    if(isset($_SESSION['AID']) || isset($_COOKIE['AID'])) {
        header('location: index.php');
        die();
    }

    $conn=mysqli_connect('localhost','root','','diablosignproto1');
    if(isset($_POST['submit']))
    {
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $res=mysqli_query($conn,"select * from admin_info where email='$email' and password='$password'");
        if(mysqli_num_rows($res)> 0)
        {
            $row=mysqli_fetch_assoc($res);
            $_SESSION['AID']= $row['admin_id'];
            setcookie('AID',$row['admin_id'],time()+ 60*60*24*30);
            header('location: index.php');
            die();
        }
        else
        {
            echo  '<script>
                        window.location.href = "login.php";
                        alert("Login failed. Invalid username or password!!");
                    </script>';
        }
    }
?>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log In</title>
        <style>
            * 
            {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            }
            body {
                /* align-items: center;
                justify-content: center; */
                background-image: url('../images/abg.jpg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                backdrop-filter: blur(1px);
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
                margin-top: 100px;
            }
            .log /*login whole*/
            {
                /* max-width: 100%;
                height: 100%;
                background-image: url('bg.png');
                background-size: cover;
                display: flex;
                justify-content: left;
                padding-left: 50px;     
                align-items: center;
                align-content: center; */

                /* background-color: white; */
                width: 380px;
                padding: 25px 30px 35px 30px;
                border-radius: 5px;
                text-align: center;
                /* box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1); */
            }
            .log header 
            {
                font-size: 25px;
                font-weight: 600;
            }
            .log form 
            {
                margin: 40px 0;
            }
            form .email,.password
            {
                width: 100%;
                margin-bottom: 20px;
            }
            form .email .input,
            .password .input {
                background-color: white;
                height: 50px;
                width: 100%;
                position: relative;
                border-radius: 8px;
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
            .pass-txt a /*f-password*/
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
            }
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
            .sign-txt
            {
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <div class="logo">
            <img src="../images/dd.png" alt="Diablo's Kitchen">
        </div>
        <div class="wrapper">
            <div class="log">
                <header>Login as Admin</header>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="email">
                        <div class="input">
                            <input type="text" placeholder="Email Address/Username" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="password">
                        <div class="input">
                            <input type="password" placeholder="Password" name="password" required>
                        </div>
                    </div>
                    <input type="submit" name="submit" id="butt" value="Login">
                    <div class="sign-txt"><a href="../SignIn.php">Login as User </a></div>
                </form>
            </div>
        </div>
        <script>
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