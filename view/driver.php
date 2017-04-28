<?php 
include "header.php";

if(!isset($_SESSION['memberId'])){
	{	

		echo '<script> location.replace("index.php");</script>';
	}	
}

?>


<div class="container-fluid driverSection">
	<div class="row">
		<div class="col-md-12">
			<h1>Register your New Ride...</h1>
		</div>
	</div>
	<?php
if($_SESSION['driver'] !== "1"){

	echo '<div class="row driverUpdateMain">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
				<form class="updateDriveForm">
					<div class="form-group">
						<label for="driverUpdate">Register As driver </label>
						<input type="checkbox" name="driverUpdate" value="driver" class="driverCheck">
					</div>
					<div class="form-group">
						<button type="button" id="driverUpdateBtn" class="btn btn-primary">Update</button> 
					</div>
				</form>
			</div>
			<div class="col-md-3">
			</div>
		 </div>';
} 

?>

<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<form class="registerRideForm" action="../serverAPI/userManagement/registerRide.php">
			<div class="form-group">
				<label for="fromAddress">Source</label>
				<input id="riderFieldFrom" type="text" class="form-control riderRegister" size="50" name="fromAddress" placeholder="From...">
			</div>
			<div class="form-group">
				<label for="toAddress">Destination</label>
				<input id="riderFieldTo" type="text" class="form-control riderRegister" size="50" name="toAddress" placeholder="To...">
			</div>
			<div class="form-group">
				<button type="button" class="btn-default btn setLocation">Set Location</button>
			</div>
			<div class="form-group">
				<label for="date">Date of traveling</label>
				<input type="date" class="date form-control" name="date">
			</div>
			<div class="form-group">
				<label for="numberOfSeat">Available seats</label>
				<input type="number" class="numberOfSeat form-control" name="numberOfSeat">
			</div>
			<div class="form-group">
				<label for="luggage">Luggage space available</label>
				<input type="checkbox" class="luggage extra" name="luggage">
				<label for="weekly">Weekly commute</label>
				<input type="checkbox" class="wkly extra" name="weekly">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary" id="registerRideBtn">Submit</button>
			</div>
		</form>
	</div>
	<div class="col-md-3">
	</div>
</div>
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6 summary">
			<h4>Congratulations! Your ride has been registered</h4><hr>	
			<h3>Traveling From: <span class="fromHeader summaryPoints"></span></h3>
			<h3>Traveling To: <span class="toHeader summaryPoints"></span></h3>
			<h3>Date: <span class="dateOfJourney summaryPoints"></span></h3>
			<h3>Seats Available: <span class="seatsAvailable summaryPoints"></span></h3>
			<h4>Luggage option: <span class="luggageSpace summaryPoints"></span></h4>
			<h4>Weekly Travel option: <span class="weeklyTravel summaryPoints"></span></h4>
		</div>
		<div class="col-md-3">
		</div>
	</div>	
</div>
<script type="text/javascript">
	$("#driverUpdateBtn").click(function() {
		if($('.driverCheck').prop("checked")){
			//var driver = true;
			$.ajax(
		    {
		        url : "../serverAPI/userManagement/updateDriver.php",
		        type: "POST",
		        data : {'driver':true},
		        success:function(data, textStatus, jqXHR) 
		        {
		        	if(jqXHR.responseText=='success'){
		        		$('.driverUpdateMain').hide();
		        	}
		        	console.log(jqXHR.responseText);
		            //data: return data from server
		        },
		        error: function(jqXHR, textStatus, errorThrown) 
		        {
		        	console.log("error");
		            //if fails      
		        }
	    	});
		}
	})
</script>
<?php 
include "footer.php";
?>
