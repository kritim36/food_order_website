<?php
include('../config/constants.php');
    //destroy the session
    session_destroy();

    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>