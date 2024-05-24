<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                  
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                       

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
   
                </td>
            </tr>

            <tr>
                <td>
                <input type="hidden" name="id" value="">
                    <input type="hidden" name="current_image" value="">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>