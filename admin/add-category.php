<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="add-admin-form">
        <h2>Add Category</h2>
        <?php 
            if(isset($_SESSION['add'])) //Check whether the session is set or not
            {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }

            if(isset($_SESSION['upload'])) //Check whether the session is set or not
            {
                echo $_SESSION['upload']; //Displaying session message
                unset($_SESSION['upload']); //Removing session message
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
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
                <label for="image">Select Image:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Add Category</button>
            </div>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //Get the value from the form
                $title =$_POST['title'];

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

                //Check whether the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);
                // die();

                if(isset($_FILES['image']['name']))
                {
                    //To upload the image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

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
                        header("location:".SITEURL.'admin/add-category.php');

                        //Stop the process
                        die();
                    }
                }else
                {
                    $image_name = "";
                }


                //Sql query to insert data into database
                $sql = "INSERT INTO category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the query
                $res = mysqli_query($conn,$sql);

                if($res==TRUE){
                    
                    $_SESSION['add'] = "Category Added Sucessfully";
                    header("location:".SITEURL.'admin/manage-category.php');
                 }else{
                    $_SESSION['add'] = "Failed To Add Category";
                    header("location:".SITEURL.'admin/add-category.php');
             
                 }
            }
        ?>
    </div>
</body>
</html>


<?php include('partials/footer.php'); ?>