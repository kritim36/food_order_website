<?php include('partials/menu.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM item WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        if($res2 == TRUE)
        {
            $count2=mysqli_num_rows($res2);
            if($count2 == 1)
            {
                $row = mysqli_fetch_assoc($res2);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            }else
                {
                    $_SESSION['no-category-found'] = "No Food Found";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
        }else
            {
                header('location:'.SITEURL.'admin/manage-food.php');
            }
    }
?>

<div class="main-content">
        <h1>Update Food</h1>
        
        <div class="add-admin-form">
            
           
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title :</label>
                    <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" cols="30" rows="5" ><?php echo $description; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo $price; ?>" required>
                </div>

                <div class="form-group">
                    <label for="image">Current Image:</label>
                    <?php 
                            if($current_image != "")
                            {
                                ?>
                                <img src = "<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width = "150px">
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
                    <label for="category">Category:</label>
                    <select name="category">
                        <?php
                            $sql = "SELECT * FROM category WHERE active = 'yes' ";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $rows['title'];
                                    $category_id = $rows['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";

                                    ?>
                                    <option <?php if($current_category==$category_id){ echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else{
                                echo "<option value='0'>Category not available</option>";
                            }
                        
                        ?>
                    </select>

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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <button type="submit" name="submit">Update Food</button>
                </div>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //Updateing new image if selected
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        //Check whether the image is available or not
                        if($image_name != "")
                        {

                                $ext = end(explode('.' , $image_name));

                                //Rename the image
                                $image_name = "Food_Name_".rand(000,999).'.'.$ext;

                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/food/".$image_name;

                                //Finally Upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //Check whether the image is uploaded or not
                                if($upload==FALSE)
                                {
                                    $_SESSION['upload'] = "Failed to upload the image";
                                    header("location:".SITEURL.'admin/manage-food.php');
                                    die();
                                }
                            //B. Remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path = "../images/food/".$current_image;
                                $remove = unlink($remove_path);
                                //Check whether the image is removed or not
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "Failed To Remove Current Image";
                                    header('location:'.SITEURL.'admin/manage-food.php');
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
                    $sql3 = "UPDATE item SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";
                    $res3 = mysqli_query($conn, $sql3);
                    if($res3 == true)
                    {
                        $_SESSION['update'] = "Food Updated Successfully";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }else
                    {
                        $_SESSION['update'] = "Failed To Update food";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>
        </div>
</div>

<?php 
// include('partials/footer.php'); 
?>