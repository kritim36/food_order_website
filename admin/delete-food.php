<?php
include('../config/constants.php');

    if(isset($_GET['id']) AND (isset($_GET['image_name'])))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name !="")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);
            if($remove == FALSE)
            {
                $_SESSION['upload'] = "Failed to remove the image file";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }
        $sql = "DELETE FROM item WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res==TRUE)
        {
            $_SESSION['delete'] = "Food Deleted Sucessfully";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "Failed To Delete Food";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
    }
    else
    {
        $_SESSION['unauthorized'] = "Unauthorized Access";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>