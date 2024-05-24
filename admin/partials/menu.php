<html>
<head> 
    <title>Diablo's Kitchen - Home Page</title>
    <!-- <link rel="stylesheet" href="../css/admin.css"> -->
    <style>
        .menu a {
            position: relative;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .menu a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #e8491d;
            transition: all 0.3s ease;
        }

        .menu a:hover {
            color: #e8491d;
        }

        .menu a:hover::after {
            width: 100%;
        }
        .menu{
            border-bottom: 1px solid grey;
            background-color: white;
        }

        .menu ul{
            list-style-type: none;
        }
        .menu ul li{
            display: inline;
            padding: 1%;
        }
        .menu ul li a{
            text-decoration: none;
            font-weight: bold;
            color:  #e8491d;
        }
        .menu ul li a:hover{
            color:  #e43809;
        }
        *{
            margin: 0 0;
            padding: 0 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .wrapper{
            padding: 1%;
            width: 99%;
            margin: 0 auto;
        }

        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
   <!-- Menu Section Starts -->
   <div class="menu text-center">
       <div class="wrapper">
           <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-user.php">User</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">P-Order</a></li>
                <li><a href="manage-corder.php">C-Order</a></li>
                <li><a href="manage-message.php">Messages</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
   <!-- Menu Section Ends -->
</body>
</html>
