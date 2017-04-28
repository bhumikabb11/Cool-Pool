<?php 
include "header.php";

if(!isset($_SESSION['memberId'])){
	{	

		echo '<script> location.replace("index.php");</script>';
	}	
}
?>

<div class="container-fluid homeDiv">
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-4">
			<div class="userTypeDiv">
				<img src="images/rider.jpg" class="userType">
				<h4>Search Your ride..</h4>
				<h2>I am a Rider</h2>
				<button class="userTypeSelectBtn btn btn-primary" data-user="rider">Select</button>
			</div>	
		</div>
		<div class="col-md-4">
			<div class="userTypeDiv">
				<img src="images/driver.png" class="userType">
				<h4>Register your ride..</h4>
				<h2>I am a Driver</h2>
				<button class="userTypeSelectBtn btn btn-primary" data-user="driver">Select</button>
			</div>
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
</div>

<?php 
include "footer.php";
?>