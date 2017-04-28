<?php 

session_start();

if(isset($_SESSION['memberId'])){
	session_destroy();
	header("location:../../view/index.php");
}

?>