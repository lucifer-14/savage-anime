<?php
include "admin/config.php";

$deleteIdentifier=$_GET["deleteIdentifier"];
echo $deleteIdentifier;
if($deleteIdentifier=="1"){
	$id = $_POST["id"];
	$query ="delete from watchhistory where id='$id'";
	mysqli_query($conn,$query);
	echo $query;
	header("location:watchhistory.php?message=Delete successful.");
}
if($deleteIdentifier=="2"){
	$id = $_POST["fId"];
	$query ="select * from animes, favouritedanimes where animes.id=favouritedanimes.animeId and favouritedanimes.id=$id";
	$result=mysqli_query($conn,$query);
	$anime= mysqli_fetch_object($result);
	$animeName=$anime->name1;
	$query ="delete from favouritedanimes where id='$id'";
	mysqli_query($conn,$query);
	header("location:profile.php?subNav=true&message2=$animeName has been removed from Favourites.");
}
if($deleteIdentifier=="3"){
	$id = $_POST["tId"];
	$query ="select * from animes, towatchlist where animes.id=towatchlist.animeId and towatchlist.id=$id";
	$result=mysqli_query($conn,$query);
	$anime= mysqli_fetch_object($result);
	$animeName=$anime->name1;
	$query ="delete from towatchlist where id='$id'";
	mysqli_query($conn,$query);
	header("location:profile.php?subNav=true&message3=$animeName has been removed from To Watch List.");
}