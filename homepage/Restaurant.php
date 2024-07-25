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
        <title> Diablo's Kitchen </title>
        <link rel="stylesheet" href="style/styleforrestro.css" type="text/css">
    </head>
    <body>
    <?php
        include("header.php");
    ?>

        <div class="heading">
            <div class="left">
                <p>Every bite is a story worth<br> remembering and sharing.</p>
                <h1>Why not start that story with us?</h1><br>
                <p><a href="Menu.php">Start Ordering!</a></p>
            </div>

            <div class="right" id="food">
            </div>
        </div>
        <div class="bottom">
            <div class="menu">
                <div id="food1"></div>
                <div id="food2"></div>
            </div>
        </div>

    <div class="buttons">
        <div class="button1">
            <a href="Contact.php" class="contac">Contact Us</a>
        </div>
        <div class="button1">
            <a href="AboutUs.php" class="read">Read More</a>
        </div>
    </div>
    
    <div class="header">
        <h1>DISCOVER THE TASTE OF EXCELLENCE</h1>
    </div>

    <div class="cards">
        <div class="card">
            <div class="image-box">
                <img src="../images/p1.jpg" alt="readmore image">
            </div>
            <div class="content">
                <p1>Our Kitchen</p1>
                <h2>Diablo's Kitchen</h2>
                <p>Step into Diablo's Kitchen, where culinary alchemy transforms the ordinary into the extraordinary. 
                    This infernal epicurean haven unleashes a symphony of flavors 
                    that dance on the edge of darkness.</p>
            </div>
        </div>

        <div class="card">
            <div class="image-box">
                <img src="../images/p2.jpg" alt="readmore image">
            </div>
            <div class="content">
                <p1>Exceptional Food Quality</p1>
                <h2>Culinary Mastery</h2>
                <p>Using fresh, locally sourced ingredients and maintaining high standards in preparation and 
                    cooking techniques ensures that each dish is a culinary delight.</p>
            </div>
        </div>

        <div class="card">
            <div class="image-box">
                <img src="../images/p3.jpg" alt="readmore image">
            </div>
            <div class="content">
                <p1>Diverse Menu Options</p1>
                <h2>Menu Extravaganza</h2>
                <p>A thoughtful menu that caters to various preferences, including vegetarian, vegan, 
                    and gluten-free options, provides a wide range of choices for diners.</p>
            </div>
        </div>

        <div class="card">
            <div class="image-box">
                <img src="../images/p4.jpg" alt="readmore image">
            </div>
            <div class="content">
                <p1>Excellent Service</p1>
                <h2>Attentive Guest Care</h2>
                <p>Attentive and knowledgeable staff contribute significantly to the overall dining experience. 
                    Quick and courteous service, along with genuine hospitality, leaves a lasting positive impression.</p>
            </div>
        </div>

        <div class="card">
            <div class="image-box">
                <img src="../images/p5.jpg" alt="readmore image">
            </div>
            <div class="content">
                <p1>Clean and Inviting Ambience</p1>
                <h2>Aesthetic Appeal</h2>
                <p>A well-designed and clean restaurant with comfortable seating, pleasant lighting, and aesthetically pleasing decor 
                    creates an atmosphere that encourages guests to relax and enjoy their meals.</p>
            </div>
        </div>

        <div class="card">
            <div class="image-box">
                <img src="../images/p6.jpg" alt="readmore image">
            </div>
            <div class="content">
                <p1>Accurate Pricing</p1>
                <h2>Fair Value Proposition</h2>
                <p>Transparent and fair pricing, reflective of the quality of ingredients and service, builds trust with customers. 
                    Clear communication about pricing and any additional charges is crucial.</p>
            </div>
        </div>
    </div>
    <script src="js/change.js"></script>

    </body>
    <?php
        include("footer.php");
    ?>  
</html>

