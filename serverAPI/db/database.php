<?php

// database connection variables start
$hostName = "localhost";
$dbName = "carPool";
$userName = "root";
$password = "";
$con;
// end

// database connection

try{
		
		$con = new PDO("mysql:host=".$hostName.";dbname=".$dbName,$userName,$password);

		$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//echo "connected";

	}catch(PDOException $e){
		echo "error";
		die($e->getmessage());
	}




?>