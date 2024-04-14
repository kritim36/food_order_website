<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Manage Admin</h1>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete']; //Displaying session message
                unset($_SESSION['delete']); //Removing session message
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update']; //Displaying session message
                unset($_SESSION['update']); //Removing session message
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found']; //Displaying session message
                unset($_SESSION['user-not-found']); //Removing session message
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match']; //Displaying session message
                unset($_SESSION['pwd-not-match']); //Removing session message
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd']; //Displaying session message
                unset($_SESSION['change-pwd']); //Removing session message
            }
        ?>
        <div class="admin-btn">
            <a href="add-admin.php">Add Admin</a>
        </div>
        <!-- Your main content goes here -->
        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table data will be populated here -->
                    <?php 
                        //query to get all the admin
                        $sql = "SELECT * FROM admin";
                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);
                            $sn=1;
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                    ?>
                                    
                                    <!-- display the value in our table -->
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <button><a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>">Change Password</a></button>
                                            <button><a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>">Edit</a></button>
                                            <button><a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>">Delete</a></button>
                                        </td>
                                    </tr>
                    <?php
                                }
                            }
                        }
                    ?>
                    
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
       

    </div>
    

<?php 
// include('partials/footer.php'); 
?>