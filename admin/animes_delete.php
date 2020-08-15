<?php
include "config.php";

$id = $_POST["id"];

$query ="update animes set active=0 where id='$id'";

mysqli_query($conn,$query);

$query = "delete from visits where animeId='$id'";
mysqli_query($conn, $query);
header("location:animes.php?message=Delete successful.");
