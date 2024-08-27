
<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>
<?php 
require_once('config.php');

$sql = "SELECT `id`, `first_name`, `last_name`, `username`, `email`, `password` FROM `webusers`";
$result = mysqli_query($conn, $sql);

// Check for SQL query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

?>

<?php include("dash-header.php"); ?>

<div class="container-fluid mt-5" style="width: 100%;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="table " style="color: white;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <!-- Assuming there's no image field for users -->
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <!-- You can add action links here if needed -->
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h4 class='text-success fw-bold text-center my-5'>NO RECORDS FOUND (<a href='add-user.php' class='text-success'>INSERT RECORD FIRST</a>)</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include("dash-footer.php"); ?>

<?php
// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>
