

<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>
<?php
require_once('config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $artist_name = $_POST['name'];
    $bio = $_POST['bio'];
    $artist_img = $_FILES['artist_img']['name'];

    // File upload paths
    $artist_img_path = "uploads/artist/" . basename($artist_img);

    // Move uploaded files to desired directory
    if (move_uploaded_file($_FILES['artist_img']['tmp_name'], $artist_img_path)) {
        // SQL query for insertion
        $sql = "INSERT INTO `artists` (artist_name, bio, img, created_at) VALUES ('$artist_name', '$bio', '$artist_img_path', CURRENT_TIMESTAMP)";
        
        if (mysqli_query($conn, $sql)) {
            header('Location: show_artist.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
        echo "Error: " . $_FILES['artist_img']['error'];
    }

    // Close connection
    $conn->close();
}
?>


