
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
    $music_id = $_POST['id'];
    $title = $_POST['title'];
    $artist_id = $_POST['artist_id'];
    $category_id = $_POST['category_id'];
    $added_by = $_POST['added_by'];
    $description = $_POST['description'];

    // Handle file uploads for image
    $img_path = $_POST['banner_img']; // Initialize img_path variable
    if(isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] == UPLOAD_ERR_OK) {
        $img_name = $_FILES['banner_img']['name'];
        $img_tmp_name = $_FILES['banner_img']['tmp_name'];
        $img_path = "uploads/banner/" . basename($img_name); // Set img_path to the destination path
        move_uploaded_file($img_tmp_name, $img_path); // Move the uploaded file to the destination folder
    }

    // Handle file uploads for audio
    $audio_path = $_POST['audio_file']; // Initialize audio_path variable
    if(isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] == UPLOAD_ERR_OK) {
        $audio_name = $_FILES['audio_file']['name'];
        $audio_tmp_name = $_FILES['audio_file']['tmp_name'];
        $audio_path = "uploads/audio/" . basename($audio_name); // Set audio_path to the destination path
        move_uploaded_file($audio_tmp_name, $audio_path); // Move the uploaded file to the destination folder
    }

    // Update the database
    $sql = "UPDATE music SET 
            title = '$title', 
            artist_id = '$artist_id', 
            category_id = '$category_id', 
            added_by = '$added_by', 
            description = '$description', 
            img_path = '$img_path', 
            audio_path = '$audio_path'
            WHERE music_id = '$music_id'";

    // Execute the update statement
    if (mysqli_query($conn, $sql)) {
        header('location:show_data.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
