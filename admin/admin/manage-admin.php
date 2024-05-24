<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="admin.css">
       <!-- Main Content Section Stars -->
       <div class = "main-content">
            <div class="wrapper">
                <h1> Manage Admin </h1>
                <br /> <br />

                <!-- Button to Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />

                <table class = "tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>

                    <tr>
                        <td>01 </td>
                        <td>Sugam Manandhar</td>
                        <td>sugammanandhar8@gmail.com</td>
                        <td>
                            <a href="" class="btn-primary">Change Password</a>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>02 </td>
                        <td>Chris Bhaila</td>
                        <td>chrisbhaila@gmail.com</td>
                        <td>
                            <a href="" class="btn-primary">Change Password</a>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                </table>
                
            </div>
        </div>
       <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>