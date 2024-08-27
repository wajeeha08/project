<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>


<?php 
$name = $_POST['category_name']; // Corrected here
include("config.php"); // Include your database connection file
$sql="INSERT INTO `categories`(`category_name`) VALUES ('$name')";
$res=mysqli_query($conn, $sql);
header('Location: show_category.php');
?>
