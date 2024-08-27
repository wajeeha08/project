<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    header("Location: adminlogin.php");
    exit();
}

// Include the database configuration file
require_once('config.php');

// Validate and sanitize the input
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Create the SQL query
    $sql = "DELETE FROM `artists` WHERE artist_id='$id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Location: show_artist.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo 'Invalid ID provided.';
}

// Close the database connection
mysqli_close($conn);
?>

