<?php
include "config.php";

$id = $_POST["id"];

$query ="update users set active=0 where id='$id'";

mysqli_query($conn,$query);
header("location:usersmanagement.php");
?>