<?php
session_start();
$dbhost = "y2w3wxldca8enczv.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user = "wyt46f9gveuregyt";
$pass = "kofls8lbeecgqf65";
$dbname = "cjzfzi8ermiutvkb";
$conn = mysqli_connect($dbhost, $user, $pass);
mysqli_select_db($conn, $dbname);
$imagePath = "../user_img/";
if(isset($_SESSION['role'])&&$_SESSION['role']=='User')
        $imagePath = "user_img/";
$title = 'Home';
$currentUser = $_SESSION['userId'] ?? '';
$pageno = 1;
$limit = 10;
$limit_u = 9;
