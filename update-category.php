
<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>
<?php include("dash-header.php"); ?>

<?php
$id = $_GET['id'];
require_once('config.php');
$sql = "SELECT * FROM categories WHERE category_id = '$id' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <div class="container mt-5 mb-5">
            <div class="card bg-dark text-white">
                <div class="card-header text-center">
                    <h3 class="mt-5">Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="edit-category.php" method="post">
                        <input type="hidden" value='<?php echo $row['category_id'] ?>' name='id'>

                        <div class="row mb-4">

                            <div class="row mb-4 justify-content-center">
                                <div class="col-md-8 text-center">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Category Name</label>
                                        <input type="text" id="name" value='<?php echo $row['category_name'] ?>' class='form-control' name='category_name'>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="text-center">
                            <button type="submit" class='btn btn-light'>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    }
}
?>

<?php include("dash-footer.php"); ?>