<?php
session_start();

// Check if the user is logged in


if (!isset($_SESSION['AdminLoginId'])) {
    header("Location:adminlogin.php");
}

?>


<?php
include("dash-header.php");

$id = $_GET['id'];
require_once('config.php');
$sql = "SELECT * FROM video WHERE video_id = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <h1 class="text-center margin-top-1">Update vedio Music</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="card-body">
                <form action="edit-vedio.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['video_id']; ?>">

                        <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" value="<?php echo $row['title']; ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="artist_id" class="control-label">Artist</label>
                            <select name="artist_id" id="artist_id" class="form-control form-control-sm rounded-0" required>
                                <option value="">Select an artist</option>
                                <?php
                                // Populate artists from the database
                                $sql = "SELECT * FROM Artists";
                                $result = mysqli_query($conn, $sql);
                                while ($artist_row = mysqli_fetch_assoc($result)) {
                                    $selected = ($artist_row['artist_id'] == $row['artist_id']) ? "selected" : "";
                                    echo "<option value='" . $artist_row['artist_id'] . "' $selected>" . $artist_row['artist_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="control-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control form-control-sm rounded-0" required>
                                <option value="">Select a category</option>
                                <?php
                                // Populate categories from the database
                                $sql = "SELECT * FROM Categories";
                                $result = mysqli_query($conn, $sql);
                                while ($category_row = mysqli_fetch_assoc($result)) {
                                    $selected = ($category_row['category_id'] == $row['category_id']) ? "selected" : "";
                                    echo "<option value='" . $category_row['category_id'] . "' $selected>" . $category_row['category_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo $row['description']; ?></textarea>
                        </div>


                        <div class="form-group">
                            <label for="banner_img" class="control-label">Music Banner</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="banner_img" name="banner_img" accept="image/*">
                                <br>
                                <br>
                            </div>
                            <!-- Display current thumbnail path -->
                            <small>Current Thumbnail Path: <?php echo $row['thumbnail_path']; ?></small>
                        </div>

                        <div class="form-group">
                            <label for="video_file" class="control-label">Video File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="video_file" name="video_file" accept="video/*" >
                                <br>
                                <br>
                            </div>
                            <!-- Display current video path -->
                            <small>Current Video Path: <?php echo $row['video_path']; ?></small>
                        </div>



                        <div class="form-group">
                            <label for="added_by" class="control-label">Added By</label>
                            <select name="added_by" id="added_by" class="form-control form-control-sm rounded-0" required>
                                <option value="">Select the user who added the music</option>
                                <?php
                                // Populate users from the database
                                $sql = "SELECT * FROM users";
                                $result = mysqli_query($conn, $sql);
                                while ($user_row = mysqli_fetch_assoc($result)) {
                                    $selected = ($user_row['id'] == $row['added_by']) ? "selected" : "";
                                    echo "<option value='" . $user_row['id'] . "' $selected>" . $user_row['username'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>





                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" name="">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    }
}
include("dash-footer.php");
?>