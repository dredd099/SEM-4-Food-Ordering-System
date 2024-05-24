<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b> <?php  ?> </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b> ₹ <?php ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php ?> value="Ordered">Ordered</option>
                            <option <?php ?> value="On Delivery">On Delivery</option>
                            <option <?php ?> value="Delivered">Delivered</option>
                            <option <?php ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php ?>">
                        <input type="hidden" name="price" value="<?php ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>
