<?php
session_start();

// Check if the user is logged in


if (!isset($_SESSION['AdminLoginId'])) {
    header("Location:adminlogin.php");
}

?>






<?php
include("dash-header.php");
?>

<h1 class="text-center margin-top-1">Add Video Music</h1>
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <form action="add-vedio.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" required />
                </div>

                <div class="form-group">
                    <label for="artist_id" class="control-label">Artist</label>
                    <select name="artist_id" id="artist_id" class="form-control form-control-sm rounded-0" required>
                        <option value="">Select an artist</option>
                        <?php
                        // Populate artists from the database
                        require_once('config.php');
                        $sql = "SELECT * FROM Artists";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['artist_id'] . "'>" . $row['artist_name'] . "</option>";
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
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" required></textarea>
                </div>


                <div class="form-group">
                    <label for="banner_img" class="control-label">Thumbnail</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="banner_img" name="thumbnail_img" accept="image/*" required>

                    </div>
                </div>

                <div class="form-group">
                    <label for="video_file" class="control-label">Video File</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="video_file" name="video_file" accept="video/*" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="added_by" class="control-label">Added By</label>
                    <select name="added_by" id="added_by" class="form-control form-control-sm rounded-0" required>
                        <option value="">Select the user who added the music</option>
                        <?php
                        // Populate users from the database
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
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
include("dash-footer.php");
?>