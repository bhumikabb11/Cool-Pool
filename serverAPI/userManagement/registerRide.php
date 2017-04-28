<?php
require "../config.php";

session_start();

$memberId = $_SESSION['memberId'];

if(isset($_POST)){
	if(isset($_POST['luggage'])){
		$luggage = "Yes";
	}else{
		$luggage = "No";
	}
	if(isset($_POST['weekly'])){
		$weekly = 'Yes';
	}else{
		$weekly = 'No';
	}


	$rideArray = array("sourceLat"=>explode(" ",$_POST['fromAddress'])[0],
						"sourceLong"=>explode(" ",$_POST['fromAddress'])[1],	
						"destinationLat"=>explode(" ",$_POST['toAddress'])[0],
						"destinationLong"=>explode(" ",$_POST['toAddress'])[1],
						"date"=>$_POST['date'],
						"seats"=>$_POST['numberOfSeat'],
						"luggage"=>$luggage,
						"weekly"=>$weekly
				);

	//print_r($rideArray);
	if(registerRide($con,$rideArray,$memberId)){
		echo "success";
	};
}

?>