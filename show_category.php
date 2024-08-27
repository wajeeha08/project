<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    header("Location:adminlogin.php");
    exit();
}

require_once('config.php');

// Initialize search variables
$search_keyword = isset($_GET['search_keyword']) ? $_GET['search_keyword'] : '';

// Prepare the SQL query with search parameters
$sql = "SELECT * FROM categories WHERE 1=1";
if ($search_keyword) {
    $sql .= " AND (category_id LIKE '%" . mysqli_real_escape_string($conn, $search_keyword) . "%' 
              OR category_name LIKE '%" . mysqli_real_escape_string($conn, $search_keyword) . "%')";
}

$result = mysqli_query($conn, $sql);

// Check for SQL query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}
?>

<?php include("dash-header.php"); ?>

<form method="GET" action="" class="mt-5">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search by ID or Category" name="search_keyword" value="<?php echo isset($_GET['search_keyword']) ? htmlspecialchars($_GET['search_keyword']) : ''; ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>

<div class="container-fluid mt-5" style="color: white; width: 600px;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="table " style="color: white;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="color: white;">
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td>
                                        <form action="update-category.php" method="GET">
                                            <input type="hidden" name="id" value="<?php echo $row['category_id']; ?>">
                                            <button type="submit" class="btn btn-success" style="margin-right: 5px; background-color: #198754">Update</button>
                                        </form>
                                        <form action="delete-category.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['category_id']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return del();" style="margin-left: 4px; background-color: #dc3545; border-color: #dc3545;">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="alert text-center" role="alert" style="color: white;">
                        No records found. <a href="category.php" class="alert-link" style="color: white;">Insert a record first</a>.
                    </div>
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

<script>
    function del() {
        return confirm("Do You Really Want To Delete The Selected Record?");
    }
</script>
<style>
    /* Custom CSS for Search Bar */
    .input-group {
        max-width: 600px;
        margin: auto;
      border: 1px solid black;
        border-radius: 50px;    
        color: white;
    }
 /* Custom CSS for Search Button */
 .input-group-append .btn-primary {
        background-color: #fc0254; /* Change background color */
        color: white; /* Set text color */
        border-color: #fc0254; /* Set border color */
        border-radius: 0 4px 4px 0; /* Adjust border radius */
        height: 100%;
        width: 100%;
        position: relative;
        bottom: 14px;
        left: 5px;
    }
    .input-group-append .btn-primary:hover {
        background-color: #fc0254; /* Change color on hover */
    }
    .input-group-append .btn-primary:focus {
        outline: none; /* Remove focus outline */
    }
    .form-control {
        border: 1px solid black;
        border-radius: 50px;
       background-color: black;
        box-shadow: 0 0 40px #fc0254;
        color:white;
    }
    .btn-success{
        border-radius: 5px;
        margin: 5px;
    }
    .btn-danger {
        border-radius: 5px;
        margin: 5px;
        margin-left: 10px;
    }
    .form-control:focus{
        background-color: black;
        color: white;
       
    }
</style>
