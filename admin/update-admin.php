<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Update Admin</h1>
       <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM admin WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            if($res == TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
       ?>
        <!-- Your main content goes here -->
        <div class="add-admin-form">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="full-name">Full Name:</label>
                    <input type="text" id="full-name" name="full_name" value="<?php echo $full_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username ?>"  required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="submit">Update Admin</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php
    if(isset($_POST['submit']))
    {
        //get all the value from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //sql query to update admin
        $sql = "UPDATE admin SET
        full_name = $full_name,
        username = $username
        WHERE id='$id'
        ";

        //execute the query
        $res = mysqli_query($conn,$sql);
        if($res==TRUE)
        {
            $_SESSION['update'] = "Admin Updated Sucessfully";
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
              $_SESSION['update'] = "Failed To Update Admin. Try Again";
              header("location:".SITEURL.'admin/manage-admin.php');
        }
    }
    ?>

<?php include('partials/footer.php'); ?>