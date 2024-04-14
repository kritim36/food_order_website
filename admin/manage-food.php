<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Manage Food</h1>
        <?php 
            if(isset($_SESSION['add'])) //Check whether the session is set or not
            {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }

            if(isset($_SESSION['unauthorized'])) 
            {
                echo $_SESSION['unauthorized']; 
                unset($_SESSION['unauthorized']); 
            }

            if(isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; 
                unset($_SESSION['upload']); 
            }

            if(isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; 
                unset($_SESSION['update']); 
            }
        ?>
        <!-- Your main content goes here -->
        <div class="admin-btn">
            <a href="<?php echo SITEURL; ?>admin/add-food.php">Add Food</a>
        </div>
        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table data will be populated here -->
                    <?php
                        $sql = "SELECT * FROM item";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        $sn=1;
                        if($count > 0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $description=$rows['description'];
                                $price=$rows['price'];
                                $image_name=$rows['image_name'];
                                $category_id=$rows['category_id'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];
                            ?>
                                 <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $description; ?> </td>
                                    <td><?php echo $price; ?></td>

                                    <td>
                                        <?php 
                                            //Check whether the image name is available or not
                                            if($image_name!="")
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width ="100px">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "Image not added";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $category_id; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <button><a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>">Update</a></button>
                                        <button><a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>">Delete</a></button>
                                </tr>
                            <?php

                            }  
                        }else{
                            //we will display the message inside the table
                            ?>
                            <tr>
                                <td colspan = "9">No Food Added </td>
                            <tr>
                            <?php

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