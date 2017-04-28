<?php 
include "header.php";

if(!isset($_SESSION['memberId'])){
	{	

		echo '<script> location.replace("index.php");</script>';
	}	
} 
?>

<div class="container-fluid riderBg">
	<div class="row">
		<div class="col-md-12 searchRide">
			<h2>SEARCH YOUR RIDE...</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-4">
			
			<form id="searchRideFormFrom">
					<div class="form-group">
						 <div class="input-group">
					      <input id="searchTextFieldFrom" type="text" class="form-control riderSearch" size="50" name="address" placeholder="From...">
					    </div><!-- /input-group -->
					</div>
				</form>
		</div>
		<div class="col-md-4">
			<form id="searchRideFormTo">
					<div class="form-group">
						 <div class="input-group">
					      <input id="searchTextFieldTo" type="text" class="form-control riderSearch" size="50" name="address" placeholder="To...">
					    </div><!-- /input-group -->
					</div>
				</form>
		</div>
		<div class="col-md-2">
			
		</div>
		<div class="row riderSearchBtnDiv">
			<div class="col-md-12">
					<button class="btn btn-primary riderSearchBtn" type="button">Set Location</button>
			</div>
		</div>
		<div class="row seachRideDiv">
			<div class="col-md-12">
				<button class="btn btn-primary searchRideBtn">Search For Rides</button>
			</div>
		</div>		
	</div>
	<div id="map"></div>

	<div class="searchResultDiv">
	</div>	
</div>
<?php 
include "footer.php";
?>