<?php
    if(isset($_POST['update']))
    {
        $update_name=$_POST['title'];
        $update_desc=$_POST['desc'];
        $update_price=$_POST['price'];
        $update_image=$_POST['image'];
        mysqli_query($conn, "UPDATE transactions SET Name='$update_name', Price='$update_price', Description='$update_desc'
        WHERE transaction_id='$update_id'") or die('Query failed.');
        $message[]='Cart updated successfully.';
    }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
       
        <?php
        include("../dbconn.php");
        $product_query = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed.');
                                    // echo $customer_id;
                                    
        if(mysqli_num_rows($product_query) > 0)
        {
            $fetch_product = mysqli_fetch_assoc($product_query)
        ?>
                <table class="tbl-30">
                
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $fetch_product['Name']; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" name="desc" cols="30" rows="5"><?php echo $fetch_product['Description']; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $fetch_product['Price']; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <img src="../mim/<?php echo $fetch_product['Image']; ?>" alt="" height="100">
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>


                    <tr>
                        <td>
                        <input type="hidden" name="id" value="">
                            <input type="hidden" name="current_image" value="">
                            <input type="submit" name="update" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                
                </table>
                <?php
                }
        ?>
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>