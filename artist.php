<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>



<?php
include("dash-header.php");
?>

<h1 class="text-center margin-top-1">Add Artist</h1>
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <form action="add-artist.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="name" class="control-label">Artist Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" required />
                </div>

                <div class="form-group">
                    <label for="bio" class="control-label">Artist Bio</label>
                    <textarea rows="3" name="bio" id="bio" class="form-control form-control-sm rounded-0" required></textarea>
                </div>

                <div class="form-group">
                    <label for="artist_img" class="control-label">Artist Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="artist_img" name="artist_img" accept="image/*" onchange="displayBanner(this)" required>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img src="" alt="" id="BannerViewer" class="img-fluid img-thumbnail bg-gradient-dark border-dark">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
include("dash-footer.php");
?>
