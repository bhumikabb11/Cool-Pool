<?php 

require "../config.php";

if($_POST){

	$newUserData = array();

	$newUserData['email'] = $_POST['email'];
	$newUserData['firstName'] = $_POST['firstName'];
	$newUserData['lastName'] = $_POST['lastName'];
	$newUserData['phoneNumber'] = $_POST['phoneNumber'];
	$newUserData['password'] = $_POST['password'];
	if(isset($_POST['driver'])){
		if($_POST['driver'] == 'driver'){
			$newUserData['driver'] = 1;	
		}
	}else{
		$newUserData['driver'] = 0;
	}
	
	$result = createUser($con,$newUserData);
	if($result == 'created'){
		echo "success";
	}else{
		echo $result;
	}
	
}
?>