<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
    exit;
}

// Retrieve form data
$title = $_POST['title'];
$artist_id = $_POST['artist_id'];
$category_id = $_POST['category_id'];
$description = $_POST['description'];
$thumbnail_img = $_FILES['thumbnail_img']['name'];
$video_file = $_FILES['video_file']['name'];
$added_by = $_POST['added_by']; // Retrieve added_by value

// File upload paths
$thumbnail_img_path = "uploads/thumbnails/" . $thumbnail_img;
$video_file_path = "uploads/videos/" . $video_file;

// Move uploaded files to desired directory
move_uploaded_file($_FILES['thumbnail_img']['tmp_name'], $thumbnail_img_path);
move_uploaded_file($_FILES['video_file']['tmp_name'], $video_file_path);

require_once('config.php');

// SQL query for insertion with added_by field included
$sql = "INSERT INTO video (title, artist_id, category_id, description, thumbnail_path, video_path, added_by, added_at)
        VALUES ('$title', '$artist_id', '$category_id', '$description', '$thumbnail_img_path', '$video_file_path', '$added_by', NOW())";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Redirect to a success page or display a success message
    header('Location:show_vedio.php');
    exit;
} else {
    // Handle error
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
