<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link href="favicon.ico" rel="shortcut icon"/>
<link rel="stylesheet" href="style.css">
<title>BlissVibe</title>
</head>
<body>

<!-- Header section -->
<header class="header-section clearfix">
    <a href="index.php" class="site-logo">
        <img src="WhatsApp_Image_2024-06-11_at_17.49.30_f96b3857-removebg-preview.png" alt="">
    </a>
    <div class="header-right">
        <a href="logout.php" class="hr-btn">log out</a>
        <span>|</span>
        <div class="user-panel">
            <a href="users.php" class="login">Manage Users</a>
            <a href="profile.php" class="register">Profile</a>
        </div> 
    </div>
    <ul class="main-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Music</a>
            <ul class="sub-menu">
                <li><a href="music.php">Add Music</a></li>
                <li><a href="show_data.php">Manage Music</a></li>
            </ul>
        </li>
        <li><a href="#">Video Music</a>
            <ul class="sub-menu">
                <li><a href="vedio.php">Add Video Music</a></li>
                <li><a href="show_vedio.php">Manage Video Music</a></li>
            </ul>
        </li>
        <li><a href="#">Artist</a>
            <ul class="sub-menu">
                <li><a href="artist.php">Add Artist</a></li>
                <li><a href="show_artist.php">Manage Artist</a></li>
            </ul>
        </li>
        <li><a href="#">Category</a>
            <ul class="sub-menu">
                <li><a href="category.php">Add Category</a></li>
                <li><a href="show_category.php">Manage Category</a></li>
            </ul>
        </li>
    </ul>
    <div class="slicknav_menu">
        <button class="slicknav_btn"><i class="fas fa-bars"></i></button>
        <ul class="slicknav_nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Music</a>
                <ul class="sub-menu">
                    <li><a href="music.php">Add Music</a></li>
                    <li><a href="show_data.php">Manage Music</a></li>
                </ul>
            </li>
            <li><a href="#">Video Music</a>
                <ul class="sub-menu">
                    <li><a href="vedio.php">Add Video Music</a></li>
                    <li><a href="show_vedio.php">Manage Video Music</a></li>
                </ul>
            </li>
            <li><a href="#">Artist</a>
                <ul class="sub-menu">
                    <li><a href="artist.php">Add Artist</a></li>
                    <li><a href="show_artist.php">Manage Artist</a></li>
                </ul>
            </li>
            <li><a href="#">Category</a>
                <ul class="sub-menu">
                    <li><a href="category.php">Add Category</a></li>
                    <li><a href="show_category.php">Manage Category</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>
<!-- Header section end -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.querySelector('.slicknav_btn');
        const nav = document.querySelector('.slicknav_nav');
        
        btn.addEventListener('click', function() {
            nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>


