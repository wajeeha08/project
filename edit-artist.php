


<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>
<?php
require_once('config.php');

$id = $_POST['id'];
$name = $_POST['name'];
$bio = $_POST['bio'];

// Handle file uploads
$imgFile = $_FILES['img']['name'];
$imgDir = "uploads/artist/";
$imgPath = $imgDir . basename($imgFile);

// Check if image file is uploaded
if ($imgFile && move_uploaded_file($_FILES['img']['tmp_name'], $imgPath)) {
    // If uploaded, update image path in the database
    $imgSql = "img = '$imgPath', ";
} else {
    // If not uploaded, do not include image update in the SQL query
    $imgSql = "";
}

// Update the database
$sql = "UPDATE `artists` SET 
        `artist_name`='$name',
        `bio`='$bio',
        $imgSql
        `created_at`=CURRENT_TIMESTAMP
        WHERE artist_id = $id";

if (mysqli_query($conn, $sql)) {
    // If update is successful, redirect to show_artist.php
    header('Location: show_artist.php');
    exit();
} else {
    // If update fails, display error message
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
