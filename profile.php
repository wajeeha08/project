


<?php
session_start();
require_once('config.php');

// Ensure the user is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    header('location:adminlogin.php');
    exit();
}

if (isset($_POST['update'])) {
    $oldUsername = $_POST['oldUsername'];
    $oldPassword = $_POST['oldPassword'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the old username and password match the database
    $checkQuery = "SELECT * FROM users WHERE username = '$oldUsername' AND password = '$oldPassword'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $rowCount = mysqli_num_rows($checkResult);

    if ($rowCount == 1) {
        // Check if new password matches the confirm password
        if ($newPassword === $confirmPassword) {
            // Update the user's username and password in the database
            $updateQuery = "UPDATE users SET username = '$newUsername', password = '$newPassword' WHERE username = '$oldUsername'";
            $result = mysqli_query($conn, $updateQuery);

            if ($result) {
                echo "Update successful!";
                // Update session variables if needed
                $_SESSION['AdminLoginId'] = $newUsername;
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "New password and confirm password do not match!";
        }
    } else {
        echo "Old username or password is incorrect!";
    }
}
?>

<?php include("dash-header.php"); ?>

<div class="container mt-5 mb-5" style="box-shadow: 0 0 10px #fc0254;">
    <div class="card  text-white" style=" background-color: #000"">
        <div class="card-header text-center"    >
            <h3 class="mt-5">Edit  Admin Details</h3>
        </div>
        <div class="card-body">
            <form method="POST"  >
                <div class="form-group">
                    <label for="oldUsername" class="form-label">Old Username:</label>
                    <input type="text" class="form-control" id="oldUsername" name="oldUsername" required>
                </div>
                <div class="form-group">
                    <label for="oldPassword" class="form-label">Old Password:</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                </div>
                <div class="form-group">
                    <label for="newUsername" class="form-label">New Username:</label>
                    <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                </div>
                <div class="form-group">
                    <label for="newPassword" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-light" name="update">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("dash-footer.php"); ?>
