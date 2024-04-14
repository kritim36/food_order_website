<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Add Admin</h1>
        <?php 
            if(isset($_SESSION['add'])) //Check whether the session is set or not
            {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }
        ?>
        <!-- Your main content goes here -->
        <div class="add-admin-form">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="full-name">Full Name:</label>
                    <input type="text" id="full-name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
    

<?php 
// include('partials/footer.php'); 
?>

<?php 
  //Process the value from the form and save it in the database

  //Check whether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
    //echo "Button Clicked";

    //Get the Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password encryption with MD5

    //SQL Query to save the data into database
    $sql = "INSERT INTO admin(full_name, username, password) VALUES('$full_name', '$username', '$password')";
    
    //execute query and save data into databse
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
    //check whether the (query is executed) data is inserted or not and display appropriate message
    if($res==TRUE){
       // echo "Data inserted";

       //create a session variable to display message
       $_SESSION['add'] = "Admin Added Sucessfully";
       //Redirect Page to Manage Admin
       header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        //echo "Failed to insert data";

         //create a session variable to display message
       $_SESSION['add'] = "Failed To Add Admin";
       //Redirect Page to Manage Admin
       header("location:".SITEURL.'admin/add-admin.php');

    }

  }
?>
