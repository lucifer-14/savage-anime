<?php
include "config.php";

$id = $_POST["id"];

$query ="update episodes set active=0 where id='$id'";

mysqli_query($conn,$query);
header("location:episodes.php?message=Delete successful.");
