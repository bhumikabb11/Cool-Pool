<?php 

/**
 * create member Id
 * @param  [type] $con [description]
 * @return [type]      [description]
 */
function createMemberId($con){
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$memberId = '';
		$max = strlen($characters) - 1;
		$random_string_length = 6;
		for ($i = 0; $i < $random_string_length; $i++) {
		    $memberId .= $characters[mt_rand(0, $max)];
		 }

		$sql = "SELECT `Member_id` FROM userProfile where Member_id = ':memberId'";
		$query = $con->prepare($sql);
		$query->execute(array(":memberId"=>$memberId));
		$result = $query->FETCH(PDO::FETCH_ASSOC);
		if(!$result){ 	
		 	return strtoupper($memberId); //capitalize the string.
		}else{
			createMemberId($con); //call the function untill a unique id is created.
		}
	}

	function createUser($con,$userArray){
		$memberId = createMemberId($con);	
		if(checkUserExist($con,$userArray['email']) == true){
			return "User already exist";
		}else{
			$sql = "INSERT INTO `userProfile`(`Member_id`, `First_name`, `Last_name`, `Phone_number`, `Email_id`, `Password`, `Driver`) VALUES (:memberId,:firstName,:lastName,:phoneNumber,:email,:password,:driver)";
			$stmt = $con->prepare($sql);
			$result = $stmt->execute(array(":memberId"=>$memberId,":firstName"=>$userArray['firstName'],":lastName"=>$userArray['lastName'],":phoneNumber"=>$userArray['phoneNumber'],":email"=>$userArray['email'],":password"=>$userArray['password'],":driver"=>$userArray['driver']));
			if($result){
				return "created";
			}
		}
	}


	function checkUserExist($con,$email){
		//print_r($email);
		$sql = "SELECT EXISTS(SELECT 1 FROM `userProfile` WHERE `Email_id` = :email)";
		//$sql = "SELECT 1 FROM `userProfile` WHERE `Email_id` = :email";
		$stmt = $con->prepare($sql);
		$stmt->execute(array(":email"=>$email));
		$result = $stmt->fetch();
		if($result[0]){
			return true;	
		}else{
			return false;
		}
		
	}

	function authenticateUser($con,$userArray){
		$sql = "SELECT * FROM `userProfile` WHERE `Email_id` = :email AND `Password` = :password AND active = 1 LIMIT 1";
		$stmt = $con->prepare($sql);
		$stmt->execute(array(":email"=>$userArray['email'],":password"=>$userArray['password']));
		$result = $stmt->FETCH(PDO::FETCH_ASSOC);
		return $result;
	}

	function updateDriver($con,$memberId){
		$sql = 'UPDATE `userProfile` SET `Driver` = 1 WHERE `Member_id`=:memberid';
		$stmt = $con->prepare($sql);
		$result = $stmt->execute(array(":memberid"=>$memberId));
		return $result;
	}

	// function to register ride
	function createRideId($con){
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$memberId = '';
		$max = strlen($characters) - 1;
		$random_string_length = 8;
		for ($i = 0; $i < $random_string_length; $i++) {
		    $memberId .= $characters[mt_rand(0, $max)];
		 }

		$sql = "SELECT `Ride_id` FROM rideTable where Ride_id = ':rideId'";
		$query = $con->prepare($sql);
		$query->execute(array(":rideId"=>$memberId));
		$result = $query->FETCH(PDO::FETCH_ASSOC);
		if(!$result){ 	
		 	return strtoupper($memberId); //capitalize the string.
		}else{
			createRideId($con); //call the function untill a unique id is created.
		}
	}


	function registerRide($con,$rideArray,$memberId){
		$rideId = createRideId($con);
		$sql = "INSERT INTO `rideTable`(`Ride_id`, `Member_id`, `SourceLat`,`SourceLong`, `DestinationLat`,DestinationLong, `Date`,`Seats`, `Luggage`, `Weekly`) VALUES (:rideId,:memberId,:sourcelat,:sourcelong,:destinationlat,:destinationlong,:dateOftravel,:seats,:luggage,:weekly)";
		$stmt = $con->prepare($sql);
		$result = $stmt->execute(array(":rideId"=>$rideId,":memberId"=>$memberId,":sourcelat"=>$rideArray['sourceLat'],":sourcelong"=>$rideArray['sourceLong'],":destinationlat"=>$rideArray['destinationLat'],":destinationlong"=>$rideArray['destinationLong'],":dateOftravel"=>$rideArray['date'],":seats"=>$rideArray['seats'],":luggage"=>$rideArray['luggage'],":weekly"=>$rideArray['weekly']));
		if($result){
			return true;
		}
	}


	function searchRide($con,$searchArray){
		$sql = "select *
				from 
				userProfile U
				INNER join (SELECT *
				FROM rideTable
				where 
				111.045* DEGREES(ACOS(COS(RADIANS(:sourceLat))
				               * COS(RADIANS(`SourceLat`))
				               * COS(RADIANS(:sourceLong) - RADIANS(`SourceLong`))
				               + SIN(RADIANS(:sourceLat))
				               * SIN(RADIANS(`SourceLat`)))) < 5
				and               
				111.045* DEGREES(ACOS(COS(RADIANS(:destinationLat))
				               * COS(RADIANS(`DestinationLat`))
				               * COS(RADIANS(:destinationLong) - RADIANS(`DestinationLong`))
				               + SIN(RADIANS(:destinationLat))
				               * SIN(RADIANS(`DestinationLat`)))) < 5               

				) D
				on U.Member_id = D.`Member_id`  ";

		$stmt = $con->prepare($sql);
		$stmt->execute(array(":sourceLat"=>$searchArray['sourceLat'],":sourceLong"=>$searchArray["sourceLong"],":destinationLat"=>$searchArray["destinationLat"],":destinationLong"=>$searchArray['destinationLong']));
		$count = 0;
		while($results = $stmt->FETCH(PDO::FETCH_ASSOC)){
			$output[$count] = $results;
			$count++;
		};
		print_r(json_encode($output));
		// foreach($results as $result){  
  				
		// }		

	}


	function getMyRides($con,$memberId){
		$sql = "SELECT * FROM `rideTable` WHERE `Member_id` = :memberId";
		$stmt = $con->prepare($sql);
		$stmt->execute(array(':memberId' => $memberId));
		$count = 0;
		while($result = $stmt->FETCH(PDO::FETCH_ASSOC)){
			$output[$count] = $result;
			$count++;
		}
		print_r(json_encode($output));

	}

?>