<?php
include('partials/menu.php');
?>
<?php     
    include("../dbconn.php");
    session_start();
    if (!isset($_COOKIE['AID'])) {
        header('location: login.php');
        die(); // Stop further execution
    }

    if(isset($_POST["submit"]))
    {
        $name = $_POST["name"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $description = mysqli_real_escape_string($conn,$_POST["description"]);
        $admin_id=$_SESSION['AID'];
        
        if($_FILES["image"]["error"] === 4)
        {
            echo "<script>
            alert('Image does not exist');
            </script>";
        }
        else
        {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
            
            $validImageExtension = ['jpg','jpeg','png'];
            $imageExtension = explode('.',$fileName);
            $imageExtension = strtolower(end($imageExtension));
            
            if(!in_array($imageExtension, $validImageExtension))
            {
                echo "<script>
                alert('Invalid Image');
                </script>";
            }
            else if($fileSize > 10000000)
            {
                echo "<script>
                alert('Image size is too large.');
                </script>";
            }
            else
            {
                move_uploaded_file($tmpName, 'mim/'. $fileName);
                $query = "INSERT INTO products (name, category, price, description, image, admin_id) VALUES('$name','$category','$price','$description','$fileName','$admin_id')";
                $res=mysqli_query($conn, $query);
                if($res)
                {
                    echo "<script>
                    alert('Successfully Added');
                    window.location.href = 'manage-food.php'; // Redirect to another page
                    </script>";
                    exit; // Exit to prevent further execution of the script
                }
                else
                {
                    echo "<script>
                    alert('Error');
                    </script>";
                }
            }
        }
    }
    if(isset($_POST['update']))
    {
        $update_id=$_POST['product_id'];
        $update_name=$_POST['p-name'];
        $update_price=$_POST['p-price'];
        $update_desc=mysqli_real_escape_string($conn,$_POST["p-desc"]);
        if(mysqli_query($conn, "UPDATE products SET Name='$update_name', Price='$update_price', Description='$update_desc' WHERE product_id='$update_id'"))
        {
            echo "<script>
                        alert('Updated successfully.');
                    </script>";
            header('location: manage-food.php');
        }
        else
        {
            die('Query failed');
        }
    }

    if(isset($_GET['remove']))
    {
        $remove_id=$_GET['remove'];
        if( mysqli_query($conn, "DELETE FROM `products` WHERE product_id='$remove_id'"))
        {
            echo "<script>
                        alert('Deleted successfully.');
                    </script>";
            header('location: manage-food.php');
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        body
        {
            overflow-x: hidden;
        }
        .main {
            background-color: #f1f2f6;
        }
        h1 {
            font-size: 22px;
            margin-bottom: 30px;
        }
        form {
            border-bottom: 1px solid wheat;
        }
        .name,
        .price,
        .desc,
        .image {
            font-size: 20px;
            margin-left: 10px;
        }
        .image1,
        .btn {
            margin-left: 10px;
        }
        .btn {
            width: 80px;
            height: 35px;
            font-size: 17px;
            background-color: #e8491d;
            color: white;
            border-radius: 8px;
            border: 1px solid #e8491d;
            cursor: pointer;
            transition: 0.2s ease-in;
        }
        .btn:hover {
            background-color: white;
            color: #e8491d;
        }
        .productsinmenu table {
            margin-left: 10px;
            width: 90%;
        }
        .productsinmenu .p-id
        {
            width: 45px;
        }
        .productsinmenu .p-image
        {
            width: 250px;
        }
        .productsinmenu .p-name
        {
            width: 250px;
        }
        .productsinmenu .p-name textarea
        {
            border: transparent;
        }
        .productsinmenu .p-price
        {
            width: 100px;
        }
        .productsinmenu .p-price input
        {
            border: transparent;
            width: 50px;
        }
        .productsinmenu .p-desc
        {
            width: auto;
        }
        .productsinmenu .p-desc textarea
        {
            text-align: left;
            width: 300px;
            height: 100px;
            border: transparent;
        }
        .productsinmenu .delete-btn
        {
            font-size: 14px;
            padding:10px;
            width: 110px;
            height: 40px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: red;
            cursor: pointer;
            transition: 0.3s ease-in;
            border-radius: 8px;
            border: 1px solid red;
        }
        .productsinmenu .delete-btn:hover
        {
            color: red;
            margin: 12px 0;
            background-color: white;
            width: 100px;
            height: 35px;
        }
        .productsinmenu .option-btn
        {
            font-size: 14px;
            width: 70px;
            height: 35px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: rgb(42, 42, 205);
            cursor: pointer;
            transition: 0.3s ease-in;
            border-radius: 8px;
        }
        .productsinmenu .option-btn:hover
        {
            color: blue;
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Enter the details to add a new item to the menu.</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label class="name">Name</label></td>
                    <td><input type="text" name="name" class="name" required></td>
                </tr>
                <tr>
                    <td><label class="price">Price</label></td>
                    <td><input type="number" name="price" class="price" required></td>
                </tr>
                <tr>
                    <td><label class="desc">Description</label></td>
                    <td><input type="text" name="description" class="desc"></td>
                </tr>
                <tr>
                    <td><label class="image">Image</label></td>
                    <td><input type="file" name="image" accept=".jpg, .jpeg, .png" class="image1" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Add" class="btn"></td>
                </tr>
            </table>
        </form>

        <div class="productsinmenu">
            <h2>In Menu</h2>
            <table border="1" cellpadding="20">
                <tr>
                    <th class="p-id">ID</th>
                    <th class="p-image">Image</th>
                    <th class="p-name">Name</th>
                    <th class="p-price">Price</th>
                    <th class="p-desc">Description</th>
                    <th class="p-action">Action</th>
                </tr>
                <?php
                    $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed.');
                    if(mysqli_num_rows($select_product) > 0)
                    {
                        while($fetch_product = mysqli_fetch_assoc($select_product))
                        {
                ?>
                            <tr>
                            <form action=""method="post">
                                <td class="p-id"><?php echo $fetch_product['product_id']?></td>
                                <td class="p-image"><img src="../mim/<?php echo $fetch_product['Image']; ?>" alt="" height="100"></td>
                                <td class="p-name"><textarea name="p-name"><?php echo $fetch_product['Name']?></textarea></td>
                                <td class="p-price">Rs. <input type="number" value="<?php echo $fetch_product['Price']?>" name="p-price">/-</td>
                                <td class="p-desc"><textarea name="p-desc"><?php echo $fetch_product['Description']?></textarea></td>
                                <td><input type="submit" name="update" value="Update" class="option-btn">
                                <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']?>">
                                    <a href="manage-food.php?remove=<?php echo $fetch_product['product_id']?>" class="delete-btn" 
                                    onclick="return confirm('Remove item from menu?');">Remove</a>
                                    </form></td>
                            </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
