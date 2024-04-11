<?php include('partials/menu.php'); ?>

<div class="main-content">
        <h1>Update Category</h1>
        
        <div class="add-admin-form">
            <?php 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                    $sql="SELECT * FROM category WHERE id=$id";
                    $res=mysqli_query($conn,$sql);
                    if($res == TRUE)
                    {
                        $count=mysqli_num_rows($res);
                        if($count == 1)
                        {
                            $row=mysqli_fetch_assoc($res);
                            $title = $row['title'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                        }else
                        {
                            $_SESSION['no-category-found'] = "No Category Found";
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }
                    }
                }else
                {
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title :</label>
                    <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Current Image:</label>
                    <?php 
                            if($current_image != "")
                            {
                                ?>
                                <img src = "<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width = "150px">
                                <?php

                            }
                            else
                            {
                                echo "Image Not Added";
                            }
                            ?> 
                </div>
                <div class="form-group">
                    <label for="image">New Image:</label>
                    <input type="file" id="image" name="image" >
                </div>
                <div class="form-group">
                    <label for="featured">Featured:</label>
                    <input <?php if($featured=="yes"){ echo "checked"; } ?> type="radio" id="featured" name="featured" value="yes" > Yes
                    <input <?php if($featured=="no"){ echo "checked"; } ?> type="radio" id="featured" name="featured" value="no"> No
                </div>
                <div class="form-group">
                    <label for="active">Active:</label>
                    <input <?php if($active=="yes"){ echo "checked"; } ?> type="radio" id="active" name="active" value="yes" > Yes
                    <input <?php if($active=="no"){ echo "checked"; } ?> type="radio" id="active" name="active" value="no"> No
                </div>
                <div class="form-group">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="submit">Update Category</button>
                </div>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //Updateing new image if selected
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        //Check whether the image is available or not
                        if($image_name != "")
                        {
                            //A. Upload the new image

                            //Auto rename our image
                            //Get the extension of our image(jpg,png,gif etc)

                                $ext = end(explode('.' , $image_name));

                                //Rename the image
                                $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/category/".$image_name;

                                //Finally Upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //Check whether the image is uploaded or not
                                if($upload==FALSE)
                                {
                                    $_SESSION['upload'] = "Failed to upload the image";
                                    header("location:".SITEURL.'admin/manage-category.php');

                                    //Stop the process
                                    die();
                                }
                            //B. Remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
                                //Check whether the image is removed or not
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "Failed To Remove Current Image";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }
                        }
                        else{
                            $image_name = $current_image;
                        }
                    }else{
                        $image_name = $current_image;
                    }

                    //Update the database
                    $sql2 = "UPDATE category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == true)
                    {
                        $_SESSION['update'] = "Category Updated Successfully";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }else
                    {
                        $_SESSION['update'] = "Failed To Update Category";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            ?>

        </div>
</div>

<?php include('partials/footer.php'); ?>