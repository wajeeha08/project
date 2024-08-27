<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
    exit;
}

require_once('config.php');
// Initialize search keyword
$search_keyword = isset($_GET['search_keyword']) ? mysqli_real_escape_string($conn, $_GET['search_keyword']) : '';

// Prepare SQL query with search condition
$sql = "SELECT * FROM video WHERE 1=1";
if (!empty($search_keyword)) {
    $sql .= " AND (video_id LIKE '%$search_keyword%' OR title LIKE '%$search_keyword%' OR artist_id LIKE '%$search_keyword%' OR category_id LIKE '%$search_keyword%')";
}

$result = mysqli_query($conn, $sql);

// Check for SQL query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}


include("dash-header.php");
?>
<form method="GET" action="" class="mt-3 mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search by ID, Title, Artist, or Category" name="search_keyword" value="<?php echo isset($_GET['search_keyword']) ? htmlspecialchars($_GET['search_keyword']) : ''; ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>




<div class="container mt-5 mb-5" style="box-shadow: 0 0 10px #fc0254; ">
    <div class="row justify-content-center">
        <div class="">
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="table" style="color: white;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Thumbnail</th>
                                <th>Video</th>
                                <th>Added By</th>
                                <th>Added At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="color: white;">
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['video_id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['artist_id']; ?></td>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><img src="<?php echo $row['thumbnail_path']; ?>" alt="Thumbnail" style="width: 100px; height: 100px; object-fit: cover;"></td>
                                    <td>
                                        <video src="<?php echo $row['video_path']; ?>" controls style="width: 200px;"></video>
                                    </td>
                                    <td><?php echo $row['added_by']; ?></td>
                                    <td><?php echo $row['added_at']; ?></td>
                                    <td>
                                        <a href="update-vedio.php?id=<?php echo $row['video_id']; ?>" class="btn btn-success btn-sm" style="color: white;">Update</a>
                                        <a href="delete-vedio.php?id=<?php echo $row['video_id']; ?>" onclick="return del()" class="btn btn-danger btn-sm" style="color: white;">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert text-center" role="alert" style="color: white;">
                        No records found. <a href="vedio.php" class="alert-link" style="color: white;">Insert a record first</a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
include("dash-footer.php");

// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>

<script>
    function del() {
        return confirm("Do you really want to delete the selected record?");
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
        margin-left: 6px;
    }
    .form-control:focus{
        background-color: black;
        color: white;
       
    }
</style>