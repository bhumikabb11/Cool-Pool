<?php
require "../config.php";

session_start();

$memberId = $_SESSION['memberId'];

if(isset($_POST)){
		getMyRides($con,$memberId);
}


?>