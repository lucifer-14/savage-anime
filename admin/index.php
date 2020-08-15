<?php
session_start();
if(isset($_SESSION['userId'])){
    header("location:dashboard.php");
    exit();
}
header("location:login.php");
?>