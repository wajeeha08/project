
<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>


<?php
// Include database configuration
require_once('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];

    // Update the category in the database
    $sql = "UPDATE categories SET category_name = '$category_name' WHERE category_id = '$id'";

    // Attempt to execute the update statement
    if (mysqli_query($conn, $sql)) {
        // Redirect to a success page or display a success message
        header("Location:show_category.php");
        exit(); // Ensure script execution stops here
    } else {
        // Handle errors
        echo "Error updating category: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
