<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order System - Login</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .login-container {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #ff6b81;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }

        button:hover {
            background-color: #ff3d53;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to Food Order System</h2>
        <?php
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login']; //Displaying session message
                 unset($_SESSION['login']); //Removing session message
             }

             if(isset($_SESSION['no-login-message']))
             {
                 echo $_SESSION['no-login-message']; //Displaying session message
                 unset($_SESSION['no-login-message']); //Removing session message
             }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //get the data from the form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //sql query to check whether the user with the username and password exist or not
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn,$sql);
        if($res==TRUE){
            $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $_SESSION['login'] = "Login Sucessfully";
                    $_SESSION['user'] = $username ; //To check whether the user is logged in or not and logout will unset it

                    header('location:'.SITEURL.'admin/');
                }else{
                    $_SESSION['login'] = "Login Failed, username or password didnot match";
                    header('location:'.SITEURL.'admin/login.php');
                }
        }
    }
?>