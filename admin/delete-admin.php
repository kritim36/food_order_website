<?php
    include('../config/constants.php');

    //get the id of admin to be deleted
    $id = $_GET['id'];

    //sql query to delete admin
    $sql = "DELETE FROM admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn,$sql);
    if($res==TRUE)
    {
        //echo "Admin deleted sucessfully";

        //Create Session variable to display message
        $_SESSION['delete'] = "Admin deleted Sucessfully";
        //Redirect to manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
       // echo "Failed to delete Admin"
          $_SESSION['delete'] = "Failed To Delete Admin. Try Again";
          header("location:".SITEURL.'admin/manage-admin.php');
    }
?>