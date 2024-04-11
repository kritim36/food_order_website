<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Manage Category</h1>
        <!-- Your main content goes here -->
        <?php 
            if(isset($_SESSION['add'])) //Check whether the session is set or not
            {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }

            if(isset($_SESSION['remove'])) //Check whether the session is set or not
            {
                echo $_SESSION['remove']; //Displaying session message
                unset($_SESSION['remove']); //Removing session message
            }

            if(isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete']; 
                unset($_SESSION['delete']); 
            }

            if(isset($_SESSION['no-category-found'])) 
            {
                echo $_SESSION['no-category-found']; 
                unset($_SESSION['no-category-found']); 
            }

            if(isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; 
                unset($_SESSION['update']); 
            }

            if(isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; 
                unset($_SESSION['upload']); 
            }

            if(isset($_SESSION['failed-remove'])) 
            {
                echo $_SESSION['failed-remove']; 
                unset($_SESSION['failed-remove']); 
            }
        ?>
        
        <div class="admin-btn">
            <a href="<?php echo SITEURL; ?>admin/add-category.php">Add Category</a>
        </div>
        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM category";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        $sn=1;
                        if($count > 0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $image_name=$rows['image_name'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];
                            ?>
                                 <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                            //Check whether the image name is available or not
                                            if($image_name!="")
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width ="100px">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "Image not added";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <button><a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>">Update Category</a></button>
                                        <button><a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>">Delete</a></button>
                                </tr>
                            <?php

                            }  
                        }else{
                            //we will display the message inside the table
                            ?>
                            <tr>
                                <td colspan = "6">No Category Added </td>
                            <tr>
                            <?php

                        }
                    ?>
                   
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
       

    </div>
    

<?php include('partials/footer.php'); ?>