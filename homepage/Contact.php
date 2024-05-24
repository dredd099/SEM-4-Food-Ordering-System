<?php
    session_start();
    if(!isset($_SESSION['UID'])) {
        header('location: ../SignIn.php');
        die(); // Stop further execution
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact</title>
        <link rel="stylesheet" href="style/Contact.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <?php
        include("header.php");
    ?>
         <div class="banner">
                <img src="../images/bgimg.png" alt="Kitchen">
                <div class="text">
                    <h4>Contact Us</h4>
                    <p>Let's start a conversation</p>
                    <p><a href="Convo.php">Click Here</a></p>
                </div>
            </div>
        <section class="contact-section">
            
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p><strong>Address:</strong> Baneshwor, Kathmandu, Bagmati, 44660</p>
                <p><strong>Phone:</strong> +977 985-345-2345</p>
                <p><strong>Email:</strong> <a href="Restaurant.php">diabloskitchen01@gmail.com</a></p>
            </div>


            

            <h2>Follow Us on Social Media</h2>
            <div class="social-links">
                <a href="https://www.facebook.com/yourrestaurant" target="_blank" class="social-link">
                    <i class="fa-brands fa-facebook"></i>
                    Facbeook
                </a>
                <a href="https://twitter.com/yourrestaurant" target="_blank" class="social-link">
                    <i class="fa-brands fa-twitter"></i>
                    Twitter
                </a>
                <a href="https://www.instagram.com/yourrestaurant" target="_blank" class="social-link">
                    <i class="fa-brands fa-instagram"></i>
                    Instagram
                </a>
            </div>
        </section>
    </body>
    <?php
            include("footer.php");
        ?>
</html>