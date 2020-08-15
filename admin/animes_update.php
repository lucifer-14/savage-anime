<?php
include "config.php";
include "helper.php";

$id = $_POST["animesId"];
$name1 = $_POST["name1"];
$name2 = $_POST["name2"];
$name3 = $_POST["name3"];
$season = $_POST["season"];
$animeType = $_POST["animeType"];
$description = $_POST["description"];
$genre = $_POST["genre"];
$releasedDate_Month = $_POST["released-date-month"];
$releasedDate_Year = $_POST["released-date-year"];
$status = $_POST["status"];
if($animeType=="-Select Anime Type-")
	$animeType = '';
if($releasedDate_Year=="-Select Year-")
	$releasedDate_Year = '';
if($releasedDate_Month=="-Select Month-")
	$releasedDate_Month = '';
if($status=="-Select Status-")
	$status = '';

$photo = $_POST['animePhoto_cropped'];



$query = "update animes set name1='$name1', name2='$name2', name3='$name3', season='$season', animeType='$animeType', description='$description', genre='$genre', releasedDate_Month='$releasedDate_Month', releasedDate_Year='$releasedDate_Year', status='$status', photo='$photo' where id='$id'";
mysqli_query($conn, $query);
header("location:animes.php?message=Update successful.");
?>
