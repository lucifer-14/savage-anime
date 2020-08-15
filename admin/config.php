<?php
session_start();
$dbhost = "us-cdbr-east-02.cleardb.com";
$user = "wyt46f9gveuregyt";
$pass = "be9d3bc6ef6d71";
$dbname = "heroku_8306e03e292f018";
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
