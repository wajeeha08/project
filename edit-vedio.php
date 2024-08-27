<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    header("Location:adminlogin.php");
    exit();
}

// Include database configuration
require_once('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $video_id = $_POST['id'];
    $title = $_POST['title'];
    $artist_id = $_POST['artist_id'];
    $category_id = $_POST['category_id'];
    $added_by = $_POST['added_by'];
    $description = $_POST['description'];

    // Initialize paths for image and video
    $thumbnail_path = $_POST['banner_img']; 
    $video_path = $_POST['video_file']; 

    // Handle file uploads for image
    if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] == UPLOAD_ERR_OK) {
        $img_name = $_FILES['banner_img']['name'];
        $img_tmp_name = $_FILES['banner_img']['tmp_name'];
        $thumbnail_path = "uploads/thumbnails/" . basename($img_name); 
        move_uploaded_file($img_tmp_name, $thumbnail_path); 
    }

    // Handle file uploads for video
    if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] == UPLOAD_ERR_OK) {
        $audio_name = $_FILES['video_file']['name'];
        $audio_tmp_name = $_FILES['video_file']['tmp_name'];
        $video_path = "uploads/videos/" . basename($audio_name); 
        move_uploaded_file($audio_tmp_name, $video_path); 
    }

    // Update the database
    $sql = "UPDATE video SET 
            title = '$title', 
            artist_id = '$artist_id', 
            category_id = '$category_id', 
            description = '$description', 
            thumbnail_path = '$thumbnail_path', 
            video_path = '$video_path', 
            added_by = '$added_by' 
            WHERE video_id = '$video_id'";

    // Execute the update statement
    if (mysqli_query($conn, $sql)) {
        header('Location:show_vedio.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
