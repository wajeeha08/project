
<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>

<?php


// Get the category ID from the URL
$id = $_POST['id'];

// Include database configuration
require_once('config.php');

// Construct the delete query
$sql = "DELETE FROM categories WHERE category_id='$id'";

// Attempt to execute the delete query
if (mysqli_query($conn, $sql)) {
    // Redirect to the category list page after successful deletion
    header('Location: show_category.php');
    exit();
} else {
    // Handle errors
    echo "Error deleting category: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
