<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>


<?php include("dash-header.php"); ?>

<h1 class="text-center margin-top-1">Add Category</h1>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-body">
                <form action="add_category.php" method="post">
                    <div class="form-group">
                        <label for="category_name" class="control-label">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required />
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("dash-footer.php"); ?>