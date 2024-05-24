<?php
    session_start();
    if(!isset($_SESSION['UID'])) {
        header('location: SignIn.php');
        die(); // Stop further execution
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
        <link rel="stylesheet" href="style/AboutUs.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <?php
        include("header.php");
    ?>
        <!-- <div class="all"> -->
            <div class="top">
                <!-- <img src="about.jpg"> -->
                <h2>About Us</h2>
            </div>
            <div class="story">
                <div class="left">
                <h2>Our Story</h2>
                <p>Welcome to Diablo's Kitchen, where culinary excellence meets warm hospitality. Our journey began with a passion for creating exceptional dining experiences, rooted in the rich traditions of gastronomy.</p>
                <p>Driven by a commitment to quality and innovation, we set out to craft a menu that showcases the finest 
                    ingredients and reflects our dedication to culinary artistry. Diablo's Kitchen, a culinary gem nestled in the heart of Kathmandu, has been enchanting taste buds since its inception in 2000,
                     thanks to the visionary chef Santosh Devkota. With a passion for redefining cuisinea, Chef Devkota embarked on a culinary journey that would leave an indelible mark on the city's gastronomic scene.
                    <br>
                    </p>
                </div>
                <div class="right">

                </div>
            </div>
            <div class="meet">
                <div class="left">
                <!-- <img src="chef-image.jpeg" alt="Chef Image" class="chef-image" width="200" height="150">  -->
                </div>
                <div class="right">
                    <h2>Meet Our Chef and Kitchen Team</h2>
                    <p>Chef Santosh Devkota leads our kitchen with expertise and creativity. With 25 years of culinary experience, Chef Devkota brings a wealth of knowledge 
                    and a unique flair to each dish. Supported by a talented kitchen team, our chefs work collaboratively to deliver
                     flavors that delight the senses.<br>
                     Having honed his skills through international culinary experiences, Chef Devkota returned to Kathmandu with a mission — to blend the rich heritage of Nepali
                     flavors with innovative global techniques. Diablo's Kitchen, under his guidance, became a haven for those seeking a unique and daring dining experience.

                    From its modest beginnings, Diablo's Kitchen has grown into a culinary institution, celebrated for its exceptional food quality and inventive menu. 
                    Chef Devkota's signature creations, such as the 'Spicy Himalayan Diablo' and 'Mystical Momo Fusion,' reflect his commitment to pushing the boundaries of 
                    flavor.</p>
                </div>
            </div>
            <div class="cert">
                <div class="left">
                <h2>Certifications and Awards</h2>
                    <p>We take pride in our commitment to excellence, and our efforts have been recognized with several certifications and awards. 
                        These accolades serve as a testament to our dedication to providing an exceptional dining experience.
                        <ol>
                            <li>2009: Culinary Excellence Award</li>
                            <li>2011: Hygiene and Safety Certification</li>
                            <li>2013: Sustainable Dining Certification</li>
                            <li>2015: International Recognition</li>
                            <li>2017: TripAdvisor Certificate of Excellence</li>
                            <li>2019: Inclusion in Top 10 Restaurants in Kathmandu</li>
                            <li>2021: Organic Certification</li>
                            <li>2022: Best Fusion Cuisine Award</li>
                        </ol>
                    </p>
                </div>
                <div class="right">

                </div>
             </div>
            <div class="links">
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
            </div>
        </div>
        <?php
            include("footer.php");
        ?>
    </body>
</html>