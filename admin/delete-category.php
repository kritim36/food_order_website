<?php
include('../config/constants.php');

    if(isset($_GET['id']) AND (isset($_GET['image_name'])))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name !="")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove == FALSE)
            {
                $_SESSION['remove'] = "Failed to remove the image file";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }
        $sql = "DELETE FROM category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res==TRUE)
        {
            $_SESSION['delete'] = "Category Deleted Sucessfully";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "Failed To Delete Category";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>