<?php include('partials/menu.php') ?>

<div class="add-admin-form">
        <h2>Add Category</h2>
        <?php 
            if(isset($_SESSION['upload'])) //Check whether the session is set or not
            {
                echo $_SESSION['upload']; //Displaying session message
                unset($_SESSION['upload']); //Removing session message
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" placeholder="Title of the food" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" id="image" name="image" >
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category">
                    <?php
                        //Create PHP code to display categories from database
                        //1. Create Sql query to get all the active categories from database
                        $sql = "SELECT * FROM category WHERE active = 'yes'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                            }
                        }else{
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }
                    ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="featured">Featured:</label>
                <input type="radio" id="featured" name="featured" value="yes" checked> Yes
                <input type="radio" id="featured" name="featured" value="no"> No
            </div>
            <div class="form-group">
                <label for="active">Active:</label>
                <input type="radio" id="active" name="active" value="yes" checked> Yes
                <input type="radio" id="active" name="active" value="no"> No
            </div>
           
            <div class="form-group">
                <button type="submit" name="submit">Add Food</button>
            </div>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //Get the value from the form
                $title =$_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //For radio button, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }else{
                    $featured = "No";
                }

                if(isset($_FILES['image']['name']))
                {
                    //To upload the image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Upload the image only if the image is selected
                    if($image_name != "")
                    {
                        //Auto rename our image
                        //Get the extension of our image(jpg,png,gif etc)

                        $ext = end(explode('.' , $image_name));

                        //Rename the image
                        $image_name = "Food_Name_".rand(000,999).'.'.$ext;

                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;

                        //Finally Upload the image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether the image is uploaded or not
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "Failed to upload the image";
                            header("location:".SITEURL.'admin/add-food.php');

                            //Stop the process
                            die();
                        }
                    }
                }else
                {
                    $image_name = "";
                }


                //Sql query to insert data into database
                $sql2 = "INSERT INTO item SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                if($res2==TRUE){
                    
                    $_SESSION['add'] = "Food Added Sucessfully";
                    header("location:".SITEURL.'admin/manage-food.php');
                 }else{
                    $_SESSION['add'] = "Failed To Add Food";
                    header("location:".SITEURL.'admin/add-food.php');
             
                 }
            }
        ?>
    </div>

<?php 
// include('partials/footer.php');
?>