<?php
session_start();
$dbhost = "localhost";
$user = "root";
$pass = "";
$dbname = "savage_anime_db";
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
