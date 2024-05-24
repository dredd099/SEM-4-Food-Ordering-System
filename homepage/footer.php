<html>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <style>
            footer f1
            {
                background-color: #fff;
                color: white;
                padding: 10px 0;
                text-align: center;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            }
            .footer a{
                text-decoration: none;
                text-align: center;
                display: block;
                margin-bottom: 10px;
                color: white;
            }
            .footer
            {
                margin-top: 150px;
                width: 70%;
                padding: 100px 15%;
                background-color: rgba(0,0,0, 0.4); /* Semi-transparent black background */
                backdrop-filter: blur(0.8px);
                display: flex;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            }
            .footer div{
                text-align: center;

            }
            .footer h2
            {
                font-weight: bolder;
                margin-bottom: 30px;
                letter-spacing: 1px;
                color: white;
            }
            .footer a:hover
            {
                color: orange;
            }
            .legal-links{
                flex-grow: 2;
            }
        </style>
    </head>
    <body>
        <div class="footer">
            <div class="footer-navigation">
                <h2>Quick Links</h2>
                    <a href="Restaurant.php">Home</a>
                    <a href="Menu.php">Menu</a>
                    <a href="AboutUs.php">About Us</a>
                    <a href="Contact.php">Contact</a>
            </div>
    
            <div class="legal-links">
                <h2>Legal Information</h2>
                <a href="../terms/terms.php">Terms of Service</a>
                <a href="../terms/privacy.php">Privacy Policy</a>
                <a href="../terms/refund.php">Cancellation and Refund Policy</a>
                <a href="../terms/shipping.php">Shipping Policy</a>
            </div>
    
            <div class="contact">
                <h2>Contact</h2>
                <a href>9800000000</a>
                <a href>01-6616190</a>
                <a href>97712382985</a>
            </div>
        </div>
    
        <footer>
            <f1>
                <p>&copy; 2024 Diablo's Kitchen. All rights reserved.</p>
            </f1>
    
        </footer>
    </body>
</html>