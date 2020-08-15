<?php
include "config.php";
include "helper.php";

$id = $_POST["episodesId"];
$episode = $_POST["episode"];
$url = $_POST["url"];
$animeId = $_POST["anime"];
$query = "update episodes set episode='$episode',url='$url',latestDate=now(),animeId='$animeId' where id='$id'";
mysqli_query($conn, $query);
header("location:episodes.php?message=Update successful.");
