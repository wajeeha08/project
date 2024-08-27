<?php
session_start();

// Check if the user is logged in


if(!isset($_SESSION['AdminLoginId'])){
    header("Location:adminlogin.php");
}

?>

<?php include("dash-header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-8 rounded mx-auto d-block">
            <img src="7.png" alt="">
        </div>
    </div>
</div>

<?php include("dash-footer.php"); ?>
