<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Update Password</h1>
        <?php
            $id = $_GET['id'];
       ?>
        <!-- Your main content goes here -->
        <div class="add-admin-form">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="current_password">Old Password:</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="submit">Change Password</button>
                </div>
            </form>
        </div>
    </div>
    
   <?php
   //Check whether the submit button is clicked
    if(isset($_POST['submit']))
    {
        //get the data from the form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check whether the user with current id and current password exist or not
        $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn,$sql);
        if($res == TRUE)
        {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            if($count == 1)
            {
               // echo "User Found"
               //check whether the new_password and confirm_password match or not
               if($new_password==$confirm_password)
               {
                    //echo "Password Match";
                    $sql2 = "UPDATE admin SET
                    password = '$new_password'
                    WHERE id = $id
                    ";

                    $res2 = mysqli_query($conn,$sql2);
                    if($res2==TRUE)
                        {
                            $_SESSION['change-pwd'] = "Password changed sucessfully !";
                            //Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');  
                        }
                        else{
                            $_SESSION['change-pwd'] = "Failed to change the password !";
                            //Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');  
                        }

                }else{
                    $_SESSION['pwd-not-match'] = "New Password and confirm password doesnot match !";
                    //Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
               }
            }else{
                $_SESSION['user-not-found'] = "USER NOT FOUND!";
                //Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }
   ?>

<?php 
// include('partials/footer.php'); 
?>