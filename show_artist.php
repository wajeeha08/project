<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    header("Location:adminlogin.php");
}

require_once('config.php');

// Corrected SQL query
$sql = "SELECT * FROM `artists`";

// Initialize search keyword
$search_keyword = isset($_GET['search_keyword']) ? mysqli_real_escape_string($conn, $_GET['search_keyword']) : '';

// Append search condition to SQL query
if (!empty($search_keyword)) {
    $sql .= " WHERE artist_id LIKE '%$search_keyword%' OR artist_name LIKE '%$search_keyword%'";
}

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check for SQL query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}
?>

<?php include("dash-header.php"); ?>

    
            <form method="GET" action="" class="mt-5">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by ID or Name" name="search_keyword" value="<?php echo isset($_GET['search_keyword']) ? htmlspecialchars($_GET['search_keyword']) : ''; ?>">
                    <button class="button" type="submit">Search</button>

                </div>
            </form>
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <table class="table" style="color: white;">
                        <!-- Table header -->
                    </table>
                <?php else : ?>
                    <!-- No records found message -->
                <?php endif; ?>
            </div>
      


<div class="container-fluid mt-5" style="color: white;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <table class="table " style="color: white;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Bio</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="color: white;">
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php echo $row['artist_id']; ?></td>
                                    <td><?php echo $row['artist_name']; ?></td>
                                    <td><?php echo $row['bio']; ?></td>
                                    <td><img src="<?php echo $row['img']; ?>" alt="Artist Image" style="width: 100px;height:100px; object-fit: contain;"></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <form action="update-artist.php" method="GET">
                                            <input type="hidden" name="id" value="<?php echo $row['artist_id']; ?>">
                                            <button type="submit" class="btn btn-success" style=" background-color: #198754">update</button>
                                        </form>

                                        <form action="delete-artist.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['artist_id']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return del();" style="margin-left: 2px; background-color: #dc3545; border-color: #dc3545;">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                    <div class="alert  text-center" role="alert" style="color: white;">
                        No records found. <a href="artist.php" class="alert-link" style="color: white;">Insert a record first</a>.
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
        return confirm("Do You Really Want To Delete The Selected Record");
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
 /* .button {
    background-color: #fc0254;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;

}

.button:hover {
    background-color: #dc3545;
} */


  
    .form-control {
        border: 1px solid black;
        border-radius: 50px;
       background-color: black;
        box-shadow: 0 0 40px #fc0254;
        color:white;
    }
    .btn-success{
        border-radius: 5px;
        
    }
    .btn-danger {
        border-radius: 5px;
        margin: 5px;
        margin-left: 6px;
    }
    .form-control:focus{
        background-color: black;
        color: white;
       
    }
</style>
