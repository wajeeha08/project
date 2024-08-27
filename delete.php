

<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>

<?php

$id=  $_GET['id'];
require_once ('config.php');
$sql = "DELETE FROM `music` WHERE music_id='$id' ";
$result=mysqli_query($conn, $sql);
header('Location:show_data.php'); 






?>