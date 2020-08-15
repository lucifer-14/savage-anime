<?php
include "config.php";
include "helper.php";

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
$photo = '';
if (!$_POST['animePhoto_cropped'] == "") {
    $photo = $_POST['animePhoto_cropped'];
}

$query = "insert into animes(name1, name2, name3, season, animeType, description, genre, releasedDate_Month, releasedDate_Year, status, photo, active) values('$name1','$name2','$name3', '$season', '$animeType', '$description', '$genre', '$releasedDate_Month', '$releasedDate_Year', '$status', '$photo', 1)";

mysqli_query($conn, $query);

$query = "select * from animes where name1='$name1' and name2='$name2' and name3='$name3' and season='$season' and animeType='$animeType' and description='$description' and genre='$genre' and releasedDate_Month='$releasedDate_Month' and releasedDate_Year='$releasedDate_Year' and status='$status'";
$result = mysqli_query($conn, $query);
$animeData=mysqli_fetch_object($result);
$animeId=$animeData->id;
$query = "insert into visits(animeId, monthlyVisits) values('$animeId', 0)";
mysqli_query($conn, $query);
header("location:animes.php?message=Saving successful.");
