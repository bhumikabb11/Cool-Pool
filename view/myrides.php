<?php 
include "header.php";

if(!isset($_SESSION['memberId'])){
	{	

		echo '<script> location.replace("index.php");</script>';
	}	
}


?>

<script type="text/javascript">
	
	var htmlString = '<div class="row myRideIterate"><div class="col-md-2"></div><div class="col-md-8"><h4>Congratulations! Your ride has been registered</h4><hr><h3>Traveling From: <span class="myFromHeader myPoints"></span></h3><h3>Traveling To: <span class="myToHeader myPoints"></span></h3><h3>Date: <span class="myDateOfJourney myPoints"></span></h3><h3>Seats Available: <span class="mySeatsAvailable myPoints"></span></h3><h4>Luggage option: <span class="myLuggageSpace myPoints"></span></h4><h4>Weekly Travel option: <span class="myWeeklyTravel myPoints"></span></h4></div><div class="col-md-2"></div></div>';
	(function(){
		var postData = "";
		$.ajax(
	    {
	        url : "../serverAPI/userManagement/myRideList.php",
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	console.log(jqXHR.responseText);
	        	if(jqXHR.responseText){
	        		var myRideArray = JSON.parse(jqXHR.responseText);
	        		console.log(myRideArray);
	        		for(var i=0;i<myRideArray.length;i++){
	        			var htmlString = '<div class="row"><div class="col-md-2"></div><div class="col-md-8 myRideIterate"><h1 style="color:#d35400">MY RIDES</h1><hr><h3>Traveling From: <span class="myFromHeader myPoints">'+myRideArray[i]['SourceLat']+" "+myRideArray[i]['SourceLong']+'</span></h3><h3>Traveling To: <span class="myToHeader myPoints">'+myRideArray[i]['DestinationLat']+" "+myRideArray[i]['DestinationLong']+'</span></h3><h3>Date: <span class="myDateOfJourney myPoints">'+myRideArray[i]['date']+'</span></h3><h3>Seats Available: <span class="mySeatsAvailable myPoints">'+myRideArray[i]['Seats']+'</span></h3><h4>Luggage option: <span class="myLuggageSpace myPoints">'+myRideArray[i]['Luggage']+'</span></h4><h4>Weekly Travel option: <span class="myWeeklyTravel myPoints">'+myRideArray[i]['Weekly']+'</span></h4></div><div class="col-md-2"></div></div>';
	        			$(".myRidesDiv").append(htmlString);
	        		}
	        	}

	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	})();
</script>


<div class="container-fluid myRidesDiv">
	
</div>

<?php 
include "footer.php";
?>