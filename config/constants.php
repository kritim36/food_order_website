<?php
//start session
session_start();

define('SITEURL','http://localhost/food/');
//Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else{
//     echo " connection established";
// }
?>







<?php
//  //Execute query and save data in database
//   $conn = mysqli_connect('localhost','root','') or die(mysqli_error()); //database connection
//  $db_select = mysqli_select_db($conn, 'food') or die(mysqli_error()); //selecting databases
?>