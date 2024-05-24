
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diablo's Kitchen</title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            padding-top: 100px;
        }

        header {
            position: fixed;
            top: 0;
            z-index: 1000;
            display: flex;
            color: black;
            align-items: center;
            justify-content: space-between;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.6);
            background-color: rgba(0,0,0, 0.65);
            backdrop-filter: blur(8px);
            width: 100%;
            transition: top 0.3s;
            /* background-image: url('doodle.jpg'); */
            /* background-color: transparent; */
        }
        header img {
            margin-left: 10px;
            height: 80px; /* Adjust the height as needed */
            width: auto; /* To maintain aspect ratio */
            margin-right: 0px;
            padding-left: 20px;
        }

        header h1 {
            margin-top: 10px;
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
        }

        nav {
            display: flex;
            text-align: center;
            align-content: center;
            justify-content: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding-right: 20px;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 10px;
            display: inline;
        }

        nav a {
            position: relative;
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        nav .animated a::after
        {
            content: '';
            position: absolute;
            background-color: #e8491d;
            width: 0;
            height: 3px;
            left: 0;
            bottom:-8px;
            transition: all 0.3s ease;
        }

        nav .animated a:hover {
            color: #e8491d;
            /* transition: 0.1s ease-in; */
        }

        nav a:hover::after
        {
            width: 100%;
        }
        .menu {
            display: flex;
            align-items: center;
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu li {
            margin-right: 20px;
        }

        .menu a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: #e8491d;
        }

        /* User Profile Styles */
        .user-profile img {
            width: 40px;
            height: 30px;
            margin-right: 10px;
            object-fit: contain;
            cursor: pointer;
        }

        .sub-menu-wrap {
            position: absolute;
            top: 100%;
            right: 1%;
            width: 250px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s;
        }

        .sub-menu-wrap.open-menu {
            max-height: 300px;
        }

        .sub-menu {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            padding: 20px;
            margin: 10px;
        }

        .sub-menu hr {
            border: 0;
            height: 1px;
            width: 100%;
            background-color: #ccc;
            margin: 15px 0;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            color: white;
            margin: 12px 0;
        }

        .sub-menu-link p {
            margin: 0;
            font-size: 18px;
            transition: 0.2s ease-in;
        }
        .sub-menu-link:hover p {
            font-weight: bolder;
            font-size: 23px;
        }

        .sub-menu-link span {
            font-size: 18px;
            margin-left: auto;
            transition: transform 0.5s;
        }

        .sub-menu-link:hover span {
            transform: translateX(5px);
        }
        .user-info h2
        {
            font-size: 20px;
            color: white;
        }
    </style>
</head>

<body>
    <header id="navbar">
        <img src="../images/ddw.png" alt="Diablo's Kitchen" onclick="Restaurant.php">
        <nav>
    <ul>
        <li class="animated"><a href="Restaurant.php" >Home</a></li>
        <li class="animated"><a href="Menu.php">Menu</a></li>
        <li class="animated"><a href="Contact.php">Contact</a></li>
        <li class="animated"><a href="AboutUs.php">About Us</a></li>
        <li class="user-profile">
            <img src="../images/profile.png" class="user" onmouseover="toggleMenu()">
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                <a href="#" class="sub-menu-link">
                        <p><?php 
                                if(isset($_SESSION['UID'])) {
                                $conn=mysqli_connect('localhost','root','','diablosignproto1');
                                $ID = $_SESSION['UID'];
                                $res=mysqli_query($conn,"SELECT name FROM user_info WHERE ID='$ID'");
                                $row=mysqli_fetch_assoc($res);
                                $name = $row['name'];
                                echo $name;
                            } else {
                                echo '<p>User not logged in.</p>';
                            }
                        
                    ?></p>
                    </a>
                    <hr>
                    <a href="dashboard.php" class="sub-menu-link">
                        <p>User Dashboard</p>
                        <span>></span>
                    </a>
                    <a href="Convo.php" class="sub-menu-link">
                        <p>Help & Support</p>
                        <span>></span>
                    </a>
                    <a href="../SignOut.php" class="sub-menu-link">
                        <p>Logout</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>

    </header>
    <!-- <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos || currentScrollPos === 0) {
                document.body.style.paddingTop = "100px"; // Adjusted padding-top
            } else {
                document.body.style.paddingTop = "20px"; // Adjusted padding-top
            }
            prevScrollpos = currentScrollPos;
        }
     </script> -->
     <script>
        let subMenu=document.getElementById("subMenu");

        function toggleMenu()
        {
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>
</html>
