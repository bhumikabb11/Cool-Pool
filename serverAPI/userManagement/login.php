<?php 
require "../config.php";
session_start();
if($_POST){
	$loginDetails = array("email"=>$_POST['email'],"password"=>$_POST['password']);
	$user = authenticateUser($con,$loginDetails);
	
	$_SESSION['memberId'] = $user['Member_id'];
	$_SESSION['email'] = $user['Email_id'];
	$_SESSION['firstName'] = $user['First_name'];
	$_SESSION['lastName'] = $user['Last_name'];
	$_SESSION['phoneNumber'] = $user['Phone_number'];
	$_SESSION['driver'] = $user['Driver'];
	$_SESSION['rider'] = $user['Rider'];

	if(isset($_SESSION['memberId'])){
		echo "success";
	}
}

?>