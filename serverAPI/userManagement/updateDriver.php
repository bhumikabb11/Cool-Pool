<?php 
require "../config.php";
session_start();

$thisMemberId = $_SESSION['memberId'];
if($_POST){
	if(isset($_POST['driver'])){
		$driverUpdate = $_POST['driver'];
		updateDriver($con,$thisMemberId);
		echo "success";
	}else{
		echo "failed";
	}
}


?>