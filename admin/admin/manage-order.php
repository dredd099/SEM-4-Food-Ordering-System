<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="admin.css">
<div class="main-content">
    <div class="wrapper">
        <h1> Manage Order </h1>

        <br /><br /><br />

                <table class = "tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <tr>
                        <td>01 </td>
                        <td>Sugam Manandhar</td>
                        <td>sugammdhr</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>02 </td>
                        <td>Chris Bhaila</td>
                        <td>chrisbhaila</td>
                        <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                </table>
                
    </div>
</div>

<?php include('partials/footer.php') ?>