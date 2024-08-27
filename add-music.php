<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>


<?php

// Retrieve form data
$title = $_POST['title'];
$artist_id = $_POST['artist_id'];
$category_id = $_POST['category_id'];
$description = $_POST['description'];
$banner_img = $_FILES['banner_img']['name'];
$audio_file = $_FILES['audio_file']['name'];
$added_by = $_POST['added_by']; // Retrieve added_by value

// File upload paths
$banner_img_path = "uploads/banner/" . $banner_img;
$audio_file_path = "uploads/audio/" . $audio_file;

// Move uploaded files to desired directory
move_uploaded_file($_FILES['banner_img']['tmp_name'], $banner_img_path);
move_uploaded_file($_FILES['audio_file']['tmp_name'], $audio_file_path);

require_once('config.php');



// SQL query for insertion with added_by field included
$sql = "INSERT INTO music (title, artist_id, category_id, description, img_path, audio_path, added_by)
        VALUES ('$title', '$artist_id', '$category_id', '$description', '$banner_img_path', '$audio_file_path', '$added_by')";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Redirect to a success page or display a success message
    header('Location:show_data.php');
    // exit;
} else {
    // Handle error
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
