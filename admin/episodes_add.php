<?php
include "config.php";
include "helper.php";

$animeId = $_POST["anime"];
$episode = $_POST["episode"];
$url = $_POST["url"];

$query = "insert into episodes(episode,url,latestDate,animeId,active) values('$episode','$url',now(),'$animeId',1)";

mysqli_query($conn, $query);
header("location:episodes.php?message=Saving successful.");
