<?php 
require "../config.php";

session_start();

$memberId = $_SESSION['memberId'];

if(isset($_POST)){

	$searchArray['sourceLat'] = explode(" ",$_POST['source'])[0];
	$searchArray['sourceLong'] = explode(" ",$_POST['source'])[1];

	$searchArray['destinationLat'] = explode(" ",$_POST['destination'])[0];
	$searchArray['destinationLong'] = explode(" ",$_POST['destination'])[1];
	searchRide($con,$searchArray);
}


?>