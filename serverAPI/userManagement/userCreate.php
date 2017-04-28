<?php
if($_POST){
	$userCreateDetails = array('firstName' => $_POST['firstName'],'lastName'=>$_POST['lastName'],'phoneNumber'=>$_POST['phoneNumber'],'email'=>$_POST['email'],'password'=>$_POST['password'],'region'=>$_POST['region']);
	
	/**
	 * [create unique member id for each new member]
	 * @param  [database connection instance: PDO] $con
	 * @return [alphanumberic string] $memberId
	 */
	function createMemberId($con){
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$memberId = '';
		$max = strlen($characters) - 1;
		$random_string_length = 6;
		for ($i = 0; $i < $random_string_length; $i++) {
		    $memberId .= $characters[mt_rand(0, $max)];
		 }

		$sql = "SELECT `member_id` FROM user_data where member_id = '?'";
		$query = $con->prepare($sql);
		$query->execute();
		$result = $query->FETCH(PDO::FETCH_ASSOC);
		if(!$result){ 	
		 	return strtoupper($memberId); //capitalize the string.
		}else{
			createMemberId($con); //call the function untill a unique id is created.
		}
	}

	/**
	 * Create new user entry in the database
	 * @param  [Database connection instance: PDO] $con
	 * @param  [array] $userArray [description]
	 * @return [boolean]
	 */
	function createUser($con,$userArray){
		$memberId = createMemberId($con);
		$sql = "INSERT INTO `user_data`(`member_id`, `First_name`, `Last_name`, `Phone_number`, `email_id`, `password`, `region`) VALUES (:memberId,:firstName,:lastName,:phoneNumber,:email,:password,:region)";
		$stmt = $con->prepare($sql);
		$result = $stmt->execute(array(":memberId"=>$memberId,":firstName"=>$userArray['firstName'],":lastName"=>$userArray['lastName'],":phoneNumber"=>$userArray['phoneNumber'],":email"=>$userArray['email'],":password"=>$userArray['password'],":region"=>$userArray['region']));
		if($result){
			return true;
		}
	}
	createUser($con,$userCreateDetails);

}else{
	echo "Invalid data";
}
?>