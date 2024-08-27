
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
$sql = "SELECT * FROM artists WHERE artist_id = '$id' ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0 ){
    while($row = mysqli_fetch_assoc($result)){
?>

<div class="container mt-5 mb-5">
    <div class="card bg-dark text-white">
        <div class="card-header text-center">
            <h3 class="mb-0">Edit Artist</h3>
        </div>
        <div class="card-body">
            <form action="edit-artist.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value='<?php echo $row['artist_id']?>' name='id'>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <label for="img" class="form-label">Artist Image</label>
                            <img id="imgPreview" src="<?php echo $row['img'] ?>" alt="Artist Image" class="img-fluid rounded mb-2" style="max-height: 300px;">
                            <input type="file" id="img" class="form-control" name="img" onchange="displayBanner(this)">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="form-label">Artist Name</label>
                            <input type="text" id="name" value='<?php echo $row['artist_name']?>' class='form-control' name='name'>
                        </div>
                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea id="bio" class='form-control' name='bio' rows="5"><?php echo $row['bio']?></textarea>
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

<script>
function displayBanner(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imgPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

