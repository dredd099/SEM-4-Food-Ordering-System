<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td> <input type="text" name="full_name" placeholder="Enter your full name"> </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                    <input type="text" name="admin_email" placeholder="Enter your email">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>